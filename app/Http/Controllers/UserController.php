<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;  

class UserController extends Controller
{
    public function login(Request $request){
    	$num = $request->input('number');
    	$pwd = md5($request->input('passwd'));
    	$name = DB::select("SELECT user_mail from chat_user WHERE user_mail='$num'");
    	if (empty($name)){
    		exit("用户不存在");
    	}else{
    		$name = DB::select("SELECT user_mail from chat_user WHERE user_mail='$num' AND user_password='$pwd'");
    		if (empty($name)){
    			exit("密码错误");
    		}else{
    			$name = DB::select("SELECT user_name from chat_user WHERE user_mail='$num' AND user_password='$pwd'");
    			echo "登录成功";
    		}
    	}
    	setcookie("user_name",$name[0]->user_name);
    }
    public function resgin(Request $request){
    	$password = md5($request->input('passwd'));
        $name = $request->input('name');
    	$mail = $request->input('mail');
    	if (empty($name)) {
    		exit("用户名为空");
    	} else {
    	    $nameIn = DB::select("SELECT user_name FROM chat_user WHERE user_name='$name'");
    	    if (!empty($nameIn)){
    	    	exit("用户名已存在");
    	    }
    	} 
        $vcode = $request->input('vcode');
        if ($vcode != session("code")) {
            exit("验证码错误");
        }


    	$work = $request->input("work");
    	if (empty($work)){
    		exit("职业为空");
    	}
    	$id=rand(100000,999999).time();
    	$nameIn = DB::insert("INSERT INTO chat_user (user_name,user_password,user_work,user_id,user_mail) VALUES ('$name','$password','$work','$id','$mail')");
    	// sql插入
    	echo "注册成功";
        setcookie("user_name",$name);

    }

    public function upload(Request $request){
        $user = $_COOKIE['user_name'];
        if ( empty($user) ) return false;
        $file = $request->file('img');;
        $name=time().rand(100000,999999);
        $path = $request->file('img')->move("./image/head",$name.".png");
        $p = "/image/head/".$name.".png";
        $UPDATE = DB::update("UPDATE chat_user SET user_img='$p'WHERE user_name='$user'");
        if(!$UPDATE){
            return false;
        }
        return "/image/head/".$name.".png";
    }

    public function postSix(Request $request){
        $six = $request->input("six");
        $user = $_COOKIE['user_name'];
        if ( empty($user) ) return 'false';
        $UPDATE = DB::update("UPDATE chat_user SET user_six='$six' WHERE user_name='$user'");
        if(!$UPDATE){
            return 'false';
        }else{
            return 'true';
        }

    }

    public function postDesc(Request $request){
        $desc = $request->input("desc");
        $user = $_COOKIE['user_name'];
        if ( empty($user) ) return 'false';
        $UPDATE = DB::update("UPDATE chat_user SET user_desc='$desc' WHERE user_name='$user'");
        if(!$UPDATE){
            return 'false';
        }else{
            return 'true';
        }
    }


    public function postDate(Request $request){
        $date = $request->input("date");
        $user = $_COOKIE['user_name'];
        if ( empty($user) ) return 'false';
        $UPDATE = DB::update("UPDATE chat_user SET user_date='$date' WHERE user_name='$user'");
        if(!$UPDATE){
            return 'false';
        }else{
            return 'true';
        }

    }

    public function postHobby(Request $request){
        $hobby = $request->input("hobby");
        $user = $_COOKIE['user_name'];
        $h = DB::update("UPDATE chat_user set user_hobby='$hobby' WHERE user_name='$user'");
        // echo "UPDATE chat_user set user_hobby='$hobby' WHERE user_name='$user'";
        if(!$h){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function forget(Request $request){
        $vcode = $request->input('code');
        $password = md5($request->input('password'));
        $user_mail = $request->input('mail');
        if ($vcode != session("code")) {
            exit("false");
        }
        $UPDATE = DB::update("UPDATE chat_user SET user_password='$password' WHERE user_mail='$user_mail'");
    }

    public function getUserAll(Request $request){
        $user = $request->input("user");
        $result = DB::select("SELECT user_desc, user_img, user_six, user_date ,user_hobby FROM chat_user WHERE user_name='$user'");
        return json_encode($result);
    }

    public function Head(){
        $user = $_COOKIE['user_name'];
        $r = DB::select("SELECT user_img FROM chat_user WHERE user_name='$user'");
        return json_encode($r);
    }
}