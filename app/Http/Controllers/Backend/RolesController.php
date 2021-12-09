<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $roles = Role::all();
        $roles = Role::whereNotIn('name', ['superAdmin'])->get();
  

        $roles->filter( function($item){ return $item->name != 'superAdmin'; });
        
        return view('backend.pages.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
       
        $request->validate([
            'name' => 'required|max:100|unique:roles',
            'permissions' => 'required',
        ],[
            'name.required' => 'Please give a role number'
        ]);

       

       $role = Role::create(['name' => $request->name]);

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
        $role = Role::findById($id);
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
        $request->validate([
            // 'name' => 'required|max:100|unique:roles,id,'.$this->id,
            'name' => 'required|max:100',
           
            'permissions' => 'required',
        ],[
            'name.required' => 'Please give a role number'
        ]);

       

        $role = Role::findById($id);

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
        $role = Role::findById($id);
        if (!is_null($role)) {
            $role->delete();
        }

        return back()->with('success', 'Data deleted successfully');
    }
}
