<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {

        return view('user.register', ['carnival_title' => config('carnival.title')]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|alpha_num|between:6,30|regex:/^[a-zA-Z0-9_]*$/',
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'password' => 'required|between:6,16|confirmed'
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return view('info', ['url' => url('user/login'), 'message' => '注册成功', 'jump_time' => 3]);
    }

    public function login(Request $request)
    {
        //已登录跳转首页
        if (Auth::check()) {
            return redirect('/');
        }
        return view('user.login', ['carnival_title' => config('carnival.title')]);
    }

    public function login2(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return view('info', ['url' => url('/'), 'message' => '登录成功', 'jump_time' => 3]);
        }


        return view('info', ['url' => url('user/login'), 'message' => '登录失败，请重新登录', 'jump_time' => 3]);
    }
}