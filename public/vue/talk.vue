<template>
	<div>
		<Row>
			<Col span="24">
				<Row class="line">
					<Col span="24" style="overflow:hidden;position:relative">
						<div class="top">
							<img :src="imgSrc">
							<br>
						</div>
						<p style="position:absolute;top:50px;right:50px;font-size:30px;color:#00cc66;text-shadow:rgb(240,240,240) 0 0 2px">{{txt}}</p>
					</Col>
					<br>
					<div style="height:160px;padding-top:115px">
						<Col span="4" offset="3">
							<p class="talkName">{{talkName}}</p>
						</Col>
						<Col span="4">
							<p class="talkName">贴数：{{talkNum}}</p>
						</Col>
						<Col span="4">
							<p class="talkName">评论：{{talkMes}}</p>
						</Col>
						<Col span="4">
							<pulish  :index="Id"></pulish>
						</Col>
					</div>
				</Row>
			</Col>
		</Row>

		<Row>
			<Col span="16">
				<router-view></router-view>
			</Col>
			<Col span="8">
				<hot></hot>
			</Col>
		</Row>
	</div>
</template>
<style type="text/css">
.line{
	background: #F2F4F7
}

.talkName{
	font-size: 20px;
}
.top{
	height: 120px;
}
</style>
<script type="text/javascript">
import pulish from "../vue/pulish.vue"
import hot from "../vue/hot.vue"
export default {
	data(){
		return {
			Id:'',
			imgSrc:'',
			talkName:'',
			talkNum:'',
			talkMes:'',
			page:1,
			txt:'',
			list:[]
		}
	},
	methods:{
		init(id) {
			this.Id=id;
			this.imgSrc="//localhost/image/top/"+id+".jpg";
			this.talkName=this.talk(id);
			switch(id){
				case '1': this.txt="共同进步";break;
				case '2': this.txt="分享生活中的乐趣";break;
				case '3': this.txt="闲置物品交易";break;
				case '4': this.txt="就业信息指导";break;
				case '5': this.txt="寻找丢失物品";break;
				case '6': this.txt="新同学，新生活";break;
				default: return;
			}
		},
		talk(id){			
			switch(id) {
				case '1': return "学习交流";break;
				case '2': return "校园生活";break;
				case '3': return "二手交易";break;
				case '4': return "就业指导";break;
				case '5': return "失物招领";break;
				case '6': return "新生专区";break;
				default: return;
			}
		}
	},
	mounted(){
		let arr = window.location.href.split("/");
		this.init(arr[4]);
		this.$http.get("/getCount?id="+arr[4]).then((d)=>{
			let arr = d.body.split("-");
			this.talkNum = arr[1];
			this.talkMes = arr[0];
		})
	},
	components:{
		pulish,
		hot
	}
}
</script>