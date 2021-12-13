<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

      return view('backend.pages.dashboard.index');
    }
}
