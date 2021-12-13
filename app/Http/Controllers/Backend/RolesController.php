<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();  // cath Auth Class er gurad admin user gholo dora
            //back request in $next
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            // IF not have permission of user and no then not permission
        if(is_null($this->user) || !$this->user->can('role.view')){
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        // $roles = Role::all();

    
        $roles = Role::whereNotIn('name', ['superAdmin'])->get();
        // compact role data into index view page
        return view('backend.pages.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Unauthorized Access to create any role');
        }

        $permissions = Permission::all();

        // dd($permissions);
    //    Get Permission Group_name by group_order
        $permission_groups = User::getPermissionGroup();
  
        return view('backend.pages.roles.create',compact('permissions','permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
       
        $request->validate([
            'name' => 'required|max:100|unique:roles',
            'permissions' => 'required',
        ],[
            'name.required' => 'Please give a role number'
        ]);

       

       $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);

       $permission = $request->input('permissions');
  
        

        if(!empty($permission)){
            $role->syncPermissions($permission); 
        }
        return redirect()->route('roles.index')->with('success', 'Data created successfully');
        // return redirect()->back()->with('success', 'Data created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }

        $role = Role::findById($id, 'admin');
        $all_permissions = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('backend.pages.roles.edit',compact('role','all_permissions','permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'name' => 'required|max:100|unique:roles,name,'. $id,
            'name' => 'required|max:100',
           
            'permissions' => 'required',
        ],[
            'name.required' => 'Please give a role number'
        ]);

       

        $role = Role::findById($id, 'admin');

       $permission = $request->input('permissions');
  
        

        if(!empty($permission)){
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permission); 
        }

        return back()->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('role.delete')){
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

        $role = Role::findById($id, 'admin');
        if (!is_null($role)) {
            $role->delete();
        }

        return back()->with('success', 'Data deleted successfully');
    }
}
