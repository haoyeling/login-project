<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Register extends Controller
{
    public function index(){
        return view('register.index');
}
}
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class Register extends Controller
{
    //
    public function index(){
        return view('register.index');
    }
    public function doRegister(Request $request){
        //1.获取用户的数据    2.验证用户名是否已经存在  3.在model中做相应数据处理   4.返回信息
 
        $name=$request->post('name');
        $pwd=$request->post('psw');
        
        $messages = [
            'name.unique' => '该邮箱已注册!',
        ];
        $validator=Validator::make(request()->all(),
            ['name'=>'unique:user,email'],$messages
        );
        if($validator->fails()){
            return ['code'=>0,'msg'=>$validator->errors()->first()];
        }
        $m=new User();
        $model=$m->setUser($name,$pwd);//添加用户
        return $model;
    }
}