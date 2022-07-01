<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCarnival extends Model
{
    use HasFactory;

    public $timestamps = true;

    public static function randStr($len) {
        $arr = [
            'a', 'b', 'c', 'd', 'e','f','g','h','i', 'j', 'k', 'm', 'l', 'n','o','p','q','r', 's', 't', 'u', 'v', 'w','x','y','z'
        ];

        $res_str = '';
        for($i = 0; $i < $len; $i++) {
            $res_str .= $arr[rand(0, count($arr) - 1)];
        }

        return $res_str;

    }
}
