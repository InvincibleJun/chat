<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Support\Facades\Session;  


class MailController extends Controller
{
    public function send(Request $request)
    {
        $code = rand(100000,999999);
        // session(['key' => $code]);
        $str="你的验证码是".$code;
        session(['code' =>  $code]);
        $mail = $request->input('mail');
        $flag = Mail::raw($str,function($message) use($mail){
            $to = $mail;
            $message ->to($to)->subject('验证码');
        });
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }
}