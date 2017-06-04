<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Support\Facades\DB; 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;  

class ArticleController extends Controller
{

	public function pulish(Request $request){
		$title = $request->input("title");
		$a = $request->input("a");
		$auth= $request->input("auth");
		$content= $request->input("content");
		$t = time();
		$content = $request->input("content");
		$file = $request->input("file");
		if ($file == '0'){
			$result = DB::insert("INSERT INTO chat_article(auth,area,text,time,title,talk,hot,good,top,file) VALUES('$auth','$a','$content','$t','$title','0','0','0','0','0')");
			echo $result;
		} else{
			$url = $request->input("fileUrl");
			$name = $request->input("fileName");
			$result = DB::insert("INSERT INTO chat_article(auth,area,text,time,title,talk,hot,good,top,file,fileUrl,fileName) VALUES('$auth','$a','$content','$t','$title','0','0','0','0','1','$url','$name')");
			print_r($result);
		}
		
	}

	public function getlist(Request $request){
		$area = $request->input("id");
		$page = ($request->input("page")-1)*10;
		$result = DB::select("SELECT id,auth,time,title,talk,hot,good,top FROM chat_article WHERE area='$area' ORDER BY top,time desc LIMIT $page ,10");
		echo json_encode($result);
	}

	public function getOne(Request $request){
		$id = $request->input("id");
		$result = DB::select("SELECT id,auth,time,title,talk,hot,good,top,fileName,fileUrl,file,text FROM chat_article WHERE id = '$id'");
		$auth = $result[0]->auth;
		$a = DB::select("SELECT user_img,user_hobby,user_desc,user_six FROM chat_user WHERE user_name='$auth'");
		$r = array_merge(json_decode(json_encode($a)),json_decode(json_encode($result)));
		echo json_encode($r);
	
	}

	public function report(Request $request){
		$user_name = $request->input("auth");
		$content = $request->input("content");
		$id = $request->input("id");
		$t = time();
		//查询用户ID
		$result = DB::select("SELECT user_id,user_img FROM chat_user WHERE user_name='$user_name'");
		if (!$result) {
			return "非法用户";
		} 
		$user_id = $result[0]->user_id;
		$user_img = $result[0]->user_img;

		$result = DB::insert("INSERT INTO chat_talk(text,time,from_id,user_name,user_id,user_img) VALUES('$content','$t','$id','$user_name','$user_id','$user_img')");
		if (!$result) {
			return "回复失败";
		} else {
			$result = DB::UPDATE("UPDATE chat_article set talk=talk+1 WHERE id='$id'");
			$t = time();
			$txt = $user_name."评论了你的文章";
			$a = DB::select("SELECT auth FROM chat_article WHERE id='$id'");
			$u = $a[0]->auth;
			$b = DB::insert("INSERT INTO chat_message(class, time, is_read, target ,user, text) VALUES('私信','$t',0,'$u','$user_name','$txt')");
			return "回复成功";
		}
	}

	public function getReport(Request $request){
		$id = $request->input("id");
		$result = DB::select("SELECT * FROM chat_talk WHERE from_id='$id' ORDER BY time");
		echo json_encode($result);
	}

	public function getHot(Request $request){
		$result = DB::select("SELECT * FROM chat_article ORDER BY talk desc LIMIT 0,10");
		echo json_encode($result);
	}

	public function userArticle(Request $request){
        $user = $_COOKIE['user_name'];
		$result = DB::select("SELECT * FROM chat_article WHERE auth = '$user'");
		return $result;
	}

	 public function uploadFile(Request $request){
        $user = $_COOKIE['user_name'];
        if ( empty($user) ) return false;
        $file = $request->file('file');
        $name=time().rand(100000,999999);
        $e= $file -> getClientOriginalExtension();
        $path = $request->file('file')->move("/file/",$name.'.'.$e);
        return "/file/".$name.".".$e;
    }

    public function download(Request $request){
    	$url = $request->input("url");
  		return Response::download($url);
    }

    public function getCount(Request $request){
    	$id = $request->input("id");
    	$s = DB::select("SELECT count(*) FROM chat_article WHERE area='$id'");
    	$d =DB::select("SELECT talk FROM chat_article WHERE area='$id'");
    	$a =0;
    	foreach ($d as $v) {
    		$a+=$v->talk;
    	}
    	$array = json_decode(json_encode($s[0]), True);
    	echo ($array["count(*)"])."-".$a;
    }

    public function getNew(Request $request){
    	$page = $request->input("page");
    	$a = ($page-1)*6;
    	$select = DB::select("SELECT * FROM chat_article ORDER BY time desc LIMIT $a,6");
    	return $select;
    }
}