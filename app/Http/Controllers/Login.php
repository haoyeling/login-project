<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    //登陆页面的展示
    public function index(){
        return view('login.index');
    }

    public function doLogin(Request $request){
        $email=$request->post('email');
        $password=$request->post('passWord');
 
        $model=new User();
        $response=$model->doLogin($email,$password);
        return $response;
    }
}
