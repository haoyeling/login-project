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
use App\Models\UserCarnival;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $list = UserCarnival::where('user_id', $user['id'])->orderBy('date', 'DESC')->get();
        return view('index', ['carnival_title' => config('carnival.title'), 'user' => $user, 'list' => $list]);
    }
}