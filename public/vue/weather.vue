<template>
	<div class="weather" style="font-size:15px;color:white;text-align:center;padding:10px;background:url('image/bg/night.png');background-size:cover">
		<div v-if="status=='T'">
			<p style="text-align:center;font-size:14px;margin-bottom:5px;">{{t}}</p>
			<div style="width:100px;margin:0 auto 5px">
				<img :src="image" height="70px">
			</div>
			<p style="text-align:center;margin-bottom:2px;font-size:18px">{{tem}}℃
				<span style="font-size:18px;">{{wea}}</span>
				<span style="font-size:15px">{{city}}</span>
			</p>
			<p style="margin-bottom:2px;">
				<span>{{s_tep}}℃</span>
				~
				<span>{{b_tep}}℃</span>
			</p>
			<p>
				<span>{{f_wind}}</span>
				<span>{{s_wind}}</span>
			</p>
		</div>
		<div v-else>
			<p style="margin-top:50px">正在获取数据...</p>
		</div>
	</div>
</template>
<style type="text/css">
.weather{
	background: black;
	height: 200px;
	border-radius: 5px;
}
</style>
<script>
import date from'../js/date'
export default {
	data(){
		return {
			t:'',
			image:'',
			tem:'',
			wea:'',
			city:"",
			s_tep:'',
			b_tep:'',
			status:'F'
		}
	},
	methods:{
		getTime(){
			let t = new Date();
			let m = t.getMonth();
			let r = t.getDate();
			let d = t.getDay();
			switch(d){
				case 0 :d='日';break;
				case 1 :d='一';break;
				case 2 :d='二';break;
				case 3 :d='三';break;
				case 4 :d='四';break;
				case 5 :d='五';break;
				case 6 :d='六';break;
			}
			this.t = m+1 +"月"+r+"日"+' '+'星期'+d+' '+date();		
		},
		weather(data){
			this.wea =  data.HeWeather5[0].now.cond.txt;
			switch(this.wea){
				case "阴":this.image = "/image/weather/overcast.png";break;
				case "阵雨":this.image = "/image/weather/lightRain.png";break;
				case "中雨":this.image = "/image/weather/midRain.png";break;
				case "大雨":this.image = "/image/weather/midRain.png";break;
				case "小雨":this.image = "/image/weather/midRain.png";break;
				case "晴":this.image = "/image/weather/sunny.png";break;
				case "多云":this.image = "/image/weather/cloud.png";break;
			}

			this.tem = data.HeWeather5[0].now.tmp;
			this.city = data.HeWeather5[0].basic.city;
			this.s_tep =  data.HeWeather5[0].daily_forecast[0].tmp.min;
			this.b_tep =  data.HeWeather5[0].daily_forecast[0].tmp.max;
			this.s_wind =  data.HeWeather5[0].daily_forecast[0].wind.dir;
			this.f_wind =  data.HeWeather5[0].daily_forecast[0].wind.sc;
		} 
	},
	mounted(){
		this.getTime();
		this.$http.get("/weather").then(function(data){
			this.weather(data.body);
			this.status='T'
		})
	}
}
</script>
