<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB; 

class MessageController extends Controller
{
    public function userMessage(Request $request){
        $user = $_COOKIE['user_name'];
        $text = $request->input("text");
        $to = $request->input("to");
        $t = time();
        $insert = DB::insert("INSERT INTO chat_message(time, is_read, target, user, text, class) VALUES('$t','0','$to','$user','$text','私信')");
        if (!$insert){
        	return "false";
        }else{
        	return "true";
        }
    }

    public function getMessage(Request $request){
    	$user = $_COOKIE["user_name"];
    	$select = DB::select("SELECT * FROM chat_message WHERE target='$user' ORDER BY time desc");
    	return $select;
    }

    public function delMessage(Request $request){
    	$id = $request->input("id");
    	$del = DB::delete("DELETE FROM chat_message WHERE id='$id'");
    	if(!$del){
    		return "false";
    	}else{
    		return "true";
    	}
    }

    public function messagePost(Request $request){
        $user = $request->input("user");
        $text = $request->input("text");
        if ($user == 'all'){
            $select = DB::select("SELECT user_name FROM chat_user");
            foreach ($select as $u){
                $use = $u->user_name;
                $t = time();
                $insert = DB::insert("INSERT INTO chat_message(class, time, is_read, target, user, text) VALUES('管理员', '$t', 0, '$use', '管理员', '$text')");
            }        
        } else {
            $users=explode(";",$user);
            foreach ($users as $k=>$v){
                $insert = DB::insert("INSERT INTO chat_message(class, time, is_read, target, user, text) VALUES('管理员', '$t', 0, '$k', '管理员', '$text')");
            }
        }
    }
}				