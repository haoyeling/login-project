<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\UserCarnival;
use App\Models\User;

class UserCarnivalController extends Controller
{
    public function add(Request $request)
    {
        $user = $request->user();
        
        //达到上限
        if (UserCarnival::where('user_id', $user['id'])->count() >= config('carnival.count'))
            return view('info', ['url' => url('/'), 'message' => '您的预约已达上限', 'jump_time' => 3]);

        $time = strtotime(config('carnival.start_date'));
        $end_time = strtotime(config('carnival.end_date')) + 24 * 3600;
        if ($time < time()) {
            $time = time();
        }
        $date = [];
        while(true) {
            if ($time > $end_time) {
                break;
            }

            //预约过的
            if (UserCarnival::where('user_id', $user['id'])->where('date', date('Y-m-d', $time))->exists()) {
                $time += 24 * 3600;
                continue;
            }

            $date[] = date('Y-m-d', $time);
            $time += 24 * 3600;
        }

        return view('user-carnival/add', ['date' => $date, 'carnival_title' => config('carnival.title'), 'user' => $user]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|before:'.config('carnival.end_date').'|after:'.config('carnival.start_date')
        ]);

        $user = $request->user();

        if (UserCarnival::where('date', $request->date)->count() >= config('carnival.carnival_count'))
            return view('info', ['url' => url('/'), 'message' => '预约已满', 'jump_time' => 3]);

        if (UserCarnival::where('user_id', $user['id'])->where('date', $request->date)->exists())
            return view('info', ['url' => url('/'), 'message' => '当天您已预约', 'jump_time' => 3]);

        if (UserCarnival::where('user_id', $user['id'])->count() >= config('carnival.count'))
            return view('info', ['url' => url('/'), 'message' => '您的预约已达上限', 'jump_time' => 3]);

        $code = UserCarnival::randStr(6);
        while(true) {
            if (!UserCarnival::where('code', $code)->exists())
                break;

            $code = UserCarnival::randStr(6);
        }

        UserCarnival::insert([
            'user_id' => $user['id'],
            'date' => $request->date,
            'code' => $code,
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return view('info', ['url' => url('/'), 'message' => '操作成功', 'jump_time' => 3]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        $errors = $validator->errors();
        if ($errors->any())
            return view('info', ['url' => url('/'), 'message' => '参数错误', 'jump_time' => 3]);

        $user = $request->user();
        UserCarnival::where(['user_id' => $user['id'], 'status' => 0, 'id' => $request->id])->delete();
        return view('info', ['url' => url('/'), 'message' => '操作成功', 'jump_time' => 3]);
    }

    public function signIn(Request $request)
    {
        return view('user-carnival/sign-in', ['carnival_title' => config('carnival.title')]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'password' => 'required'
        ]);

        $uc = UserCarnival::where('code', $request->code)->first();
        if (empty($uc)) {
            return view('info', ['url' => url('sign'), 'message' => '没有找到该邀请码', 'jump_time' => 3]);
        }
        if ($uc['status'] == 1) {
            return view('info', ['url' => url('sign'), 'message' => '该邀请码已使用', 'jump_time' => 3]);
        }
        if ($uc['date'] != date('Y-m-d')) {
            return view('info', ['url' => url('sign'), 'message' => '该邀请码不在使用期内', 'jump_time' => 3]);
        }

        $user = User::find($uc['user_id']);
        if (Auth::attempt(['email' => $user['email'], 'password' => $request->password])) {
            $request->session()->regenerate();

            UserCarnival::where('id', $uc['id'])->update(['status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

            return view('info', ['url' => url('/'), 'message' => '签到成功', 'jump_time' => 3]);
        }

        return view('info', ['url' => url('sign'), 'message' => '密码错误', 'jump_time' => 3]);
    }
}
