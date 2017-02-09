<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Active;
use Auth;
class HomeController extends Controller
{
    public function index(){
        if (!Auth::guest()){
            Active::where('user_id','=',Auth::user()->id)->update(array('active'=>false));
        }
        return view('home');
    }
    public function login(){
        return view('auth.login');
    }
    public function registration(){
        return view('auth.register');
    }
}
