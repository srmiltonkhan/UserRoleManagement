<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
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
        if(is_null($this->user) || !$this->user->can('admin.view')){
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }


        // Find All admin username without superadmin
        $admins = Admin::whereNotIn('name', ['superAdmin'])->get();

      
        return view('backend.pages.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        $roles  = Role::all();
        return view('backend.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
       
        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'username' => 'required|max:100|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create New Admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        return redirect()->route('admins.index')->with('success', 'Data created successfully');
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $admin = Admin::find($id);
        $roles  = Role::all();
        return view('backend.pages.admins.edit', compact('admin','roles'));
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $admin = Admin::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,' . $id, // only update take the email textfield value for change
            'password' => 'nullable|min:6|confirmed',
        ]);
        

        // Update  Admin
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        // if password get then update
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();


        // First time delete roles by detach() method
        $admin->roles()->detach();
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }



        return back()->with('success', 'Data update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.delete')){
            abort(403, 'Sorry !! You are Unauthorized to delete any admin !');
        }

        $admin = Admin::find($id);
        if (!is_null($admin)) {
            $admin->delete();
        }

        return back()->with('success', 'Data deleted successfully');
    }
}
