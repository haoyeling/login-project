<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //登录
  public function doLogin($email,$password){
    $result=$this->where('email',$email)->exists();//判断email在表中是否存在
    if($result){
        $pwd=$this->where('email',$email)->value('password');//查询出密码
        if($pwd==$password){
            return ['msg'=>'登录成功','code'=>1];
        }else{
            return ['msg'=>'密码错误','code'=>0];
        }
    }else{
        return ['msg'=>'账号不存在','code'=>0];
    }
}
//注册
use Illuminate\Support\Facades\Crypt;
protected $table='user';
//添加用户
    public function setUser($name,$pwd){
        //将数据存储进数据库表，并将密码加密
        $pwd=Crypt::encryptString($pwd);
        $result=$this->insert(['email'=>$name,'password'=>$pwd]);
        if($result>0){
            return ['code'=>1,'msg'=>'注册成功!'];
        }else{
            return ['code'=>0,'msg'=>'注册失败！'];
        }
    }
}
  
