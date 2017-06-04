<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;  
session_start();

class AdminController extends Controller
{
	public function login(Request $request){
		 $name = $request->input("u");
		 $password = $request->input("p");
		 $result = DB::select("SELECT root_name from chat_root WHERE root_email = '$name' AND root_pwd = '$password' ");
		 if ( !$result ){

		 	$result = DB::select("SELECT admin_name from chat_admin WHERE admin_email = '$name' AND admin_pwd = '$password'");
		 	if ( !$result){
		 		return 0;
		 	} else {
		 	    $a = $result[0]->admin_name;
		 		session(['name' =>  $a]);
		        return 1;
		 	}
		 } else {
		 	$a = $result[0]->root_name;
		 	session(['name' =>  $a]);
		    return 1;
		 }
	}
	public function admin(Request $request){
		if (!session("name")) return view("welcome");
		$user = DB::select("SELECT count(*) from chat_user");
		$article = DB::select("SELECT count(id) from chat_article");
		$message = DB::select("SELECT count(*) from chat_message");
		$a = json_decode(json_encode($article), True);
		$b = json_decode(json_encode($user), True);
		$c = json_decode(json_encode($message), True);
		$article = $a[0]['count(id)'];
		$user = $b[0]['count(*)'];
		$message = $c[0]['count(*)'];

		$users = DB::select("SELECT user_name,user_mail,no_talk from chat_user");
		$roots = DB::select("SELECT root_name,root_email from chat_root");
		$admins = DB::select("SELECT admin_name,admin_email from chat_admin");
		$talks = DB::select("SELECT user_name, text, time, id from chat_talk ORDER BY id desc");
		$articles = DB::select("SELECT id, auth, time, good, top, title from chat_article ORDER BY id desc");
		foreach($articles as $v){
			$v->time = date("Y-m-d H:i:s", $v->time);
		}

		foreach($users as $u){
			if(!$u->no_talk || $u->no_talk<time())
			{
				$u->status="正常";
			}else
			{
				$u->status="禁言中";
			}
		}

		return view("administration",[
			"name" => session("name"),
			'article'=>$article,
			"user"=>$user,
			"message"=>$message,
			"today"=>15,
			"users"=>$users,
			"admins"=>$admins,
			"articles"=>$articles,
			"roots"=>$roots,
			"talks"=>$talks
		]);
	}
	public function index(){
		return view("admin");
	}

	public function count(){
		$user = DB::select("SELECT count(*) from chat_user");
		$article = DB::select("SELECT count(id) from chat_article");
		$message = DB::select("SELECT count(*) from chat_message");
		$a = json_decode(json_encode($article), True);
		$b = json_decode(json_encode($user), True);
		$c = json_decode(json_encode($message), True);
		$article = $a[0]['count(id)'];
		$user = $b[0]['count(*)'];
		$message = $c[0]['count(*)'];
		$arr = array('article'=>$article,"user"=>$user,"message"=>$message,"today"=>15);
		echo json_encode($arr);
	}
	public function del(Request $request){
		$name = $request->input("name");
		$result = DB::delete("DELETE FROM chat_user WHERE user_name='$name'");
		if ($result) {
			return 1;
		} else {
			return 0;
		}
	}

	public function changePwd(Request $request){
		 $pwd = md5($request->input("pwd"));
		 $name = $request->input("name");
		 $result = DB::update("UPDATE chat_user set user_password='$pwd' WHERE user_name='$name'");
		if ($result) {
			return 1;
		} else {
			return 0;
		}

	}
	public function close(Request $request){
		$name = $request->input("name");
		$T = time();
		$t = $T+60*60*24*7;
		$text = '由于你违反发言约定，现将你禁言七天，请遵守规矩';
		$insert = DB::insert("INSERT INTO chat_message(class, time, is_read, target, user, text) VALUES('系统', '$T', 0, '$name', '系统', '$text')");
		$result = DB::update("UPDATE chat_user set no_talk='$t' WHERE user_name='$name'");
		if ($result) {
			return 1;
		} else {
			return 0;
		}
	}

	public function cancelTop(Request $request){
		$id = $request->input("id");
		$update = DB::update("UPDATE chat_article set top=0 WHERE id='$id'");
		if ($update) {
			return 1;
		} else {
			return 0;
		}

	}

	public function toTop(Request $request){
		$id = $request->input("id");
		$update = DB::update("UPDATE chat_article set top=1 WHERE id='$id'");
		if ($update) {
			return 1;
		} else {
			return 0;
		}

	}

	public function toGood(Request $request){
		$id = $request->input("id");
		$update = DB::update("UPDATE chat_article set good=1 WHERE id='$id'");
		if ($update) {
			return 1;
		} else {
			return 0;
		}

	}

	public function cancelGood(Request $request){
		$id = $request->input("id");
		$update = DB::update("UPDATE chat_article set good=0 WHERE id='$id'");
		if ($update) {
			return 1;
		} else {
			return 0;
		}

	}

	public function delart(Request $request){
		$id = $request->input("id");
		$delete = DB::delete("DELETE FROM chat_article WHERE id='$id'");
		if ($delete) {
			return 1;
		} else {
			return 0;
		}

	}

	public function delAdmin(Request $request){
		if (session("name")!='陈君'){
			return 0;
		}
		$id = $request->input("id");
		$delete = DB::delete("DELETE FROM chat_admin WHERE admin_name='$id'");
		if ($delete) {
			return 1;
		} else {
			return 0;
		}
	}

	public function newAdmin(Request $request){
		if (session("name")!='陈君'){
			return 0;
		}
		$s = $request->input("s");
		$m = $request->input("m");
		$p = $request->input("p");

		$insert = DB::insert("INSERT INTO chat_admin(admin_name, admin_email,admin_pwd) VALUES('$m','$s','$p')");
		if($insert){
			return 1;
		}
	}

	public function delre(Request $request){
		$id = $request->input("id");
		$a = DB::select("SELECT from_id FROM chat_talk WHERE id='$id'");
		$b = $a[0]->from_id;
		$del = DB::delete("DELETE FROM chat_talk WHERE id='$id'");
		if($del){
			$u = DB::update("UPDATE chat_article SET talk=talk-1 WHERE id='$b'");
			return 1;
		}

	}
}