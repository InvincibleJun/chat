<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class WeatherController extends Controller
{
    public function wea(){
        $reIP=$_SERVER["REMOTE_ADDR"]; 
        if($reIP="::1") {
            $reIP = '124.89.2.87';
        };
        $city = json_decode(file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$reIP));
        $arr = file_get_contents("https://free-api.heweather.com/v5/weather?city=".$city->data->city."&key=6cbd660dcbdb4dbc908c459d2f0b76b6"); 
        echo $arr;
    }
}				