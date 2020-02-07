<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Service\LDAP;

class UserController extends Controller
{
    public function index(){
    	if(!Session::has('login')){
    		return view('login.login');
    	}
    	else{
            return view('app');
        }
    }

    public function login(Request $request){
    	$this->validate($request,[
            'user' => 'required',
            'password' => 'required'
        ]);

    	if(LDAP::authenticate($request->user,$request->password)){
            Session::put('login', 'true');
            Session::put('user', $request->user);
            return redirect('/');
        }
        else{
            $erros_bd = ['Usuário ou senha incorreta'];
            return view('login.login', compact('erros_bd'));
        }
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }
}
