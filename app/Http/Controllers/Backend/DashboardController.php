<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
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

    public function index(){

      //Permission with user
      if(is_null($this->user) || !$this->user->can('dashboard.view')){
        abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
    }

    $total_roles =  count(Role::select('id')->get());
    $total_admin =  count(Admin::select('id')->get());
    $total_permissions =  count(Permission::select('id')->get());
      return view('backend.pages.dashboard.index',compact('total_roles','total_admin','total_permissions'));
    }
}
