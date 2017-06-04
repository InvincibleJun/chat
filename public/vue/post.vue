<template>
	<div style="border-right:1px solid #e9eaec">
	    <div class="a_title">{{article.title}}</div>
		<div style="display:flex;border-bottom:1px solid #e9eaec">
			<div class="_left" @mouseenter="show" @mouseleave="mesShow=false">
				<div>
					<a class="thumbnail head" style="width: 100px;height:100px;margin: 0 20px;overflow:hidden">
				      <img :src="auth.user_img" style="width:90px">
				    </a>
				    <p style="margin-top:10px;color:#ff9900;font-size: 16px;text-align: center;">{{article.auth}}</p>
				</div>
			    <div style="width:400px;height:200px;position:absolute;background:white;top:205px;z-index:1000;left:-100px;border-radius:5px;box-shadow:0 0 2px 1px #FFCC99" v-show="mesShow">
			        <Button type="success" style="position:absolute;top:40px;right:30px" @click="modal1=true">私信</Button>
			    	<div style="height:80px;background:url(/image/top/1.jpg);background-size:cover"></div>
			          <div style="float:left;margin:-30px 20px">
				    		<div style="width:130px;height:130px;overflow:hidden;padding:10px;" class="thumbnail head">
				    			<img :src="auth.user_img" style="width:130px">
				    		</div>
			    	   </div>
			    	   <div style="float:left;margin:20px;">
			    	   		<div>
			    	   			<p style="font-size:20px;">
			    	   			<Icon type="male" style="color:#3399CC" v-if="auth.user_six==1"></Icon>
			    	   			<Icon type="female" style="color:#FF3333" v-if="auth.user_six==0"></Icon>
			    	   			{{article.auth}}
			    	   			</p>
			    	   			<p>爱好：{{auth.user_hobby}}</p>
			    	   			<p>签名：{{auth.user_desc}}</p>
			    	   		</div>
			    	   </div>

			    </div>
			</div>
			<Modal
		        v-model="modal1"
		        title="私信"
		        ok-text="发送"
		        cancel-text="取消"
		        @on-ok="ok"
		        @on-cancel="cancel">
				<Input v-model="value" placeholder="请输入..." style="width: 100%"></Input>
		    </Modal>
			<div class="_right">
				<div style="font-size: 16px" v-html="article.text">	
				</div>
				<div style="height:100px"></div>
				<div class="bot">
					 <span style="font-size:16px">作者:{{article.auth}}</span>
					 <span style="font-size:16px">{{article.time | time}}</span>
					 <Icon type="chatbox-working" style="font-size:18px;margin:0 4px 0 10px;"></Icon>
					 <span style="font-size:14px">评论({{article.talk}})</span>
					 <div style="display:inline-block">
					    <report :act="id"></report>			 		
					 </div>
				</div>
				<div v-if="article.file==1">
					<h6>附件下载(点击文件名下载)</h6>
					<p v-for="item in fileList">
						<Button type="ghost" size="small" @click='load(item.fileUrl)'>{{item.filename}}</Button>	
					</p>
				</div>
			</div>
		</div>
		<div style="display:flex;border-bottom:1px solid #e9eaec" v-for="item in list">
				<div class="_left">
						<div>
							<a class="thumbnail head" style="width: 100px;height:100px;margin: 0 20px;overflow:hidden">
						      <img :src="item.user_img" style="width:90px">
						    </a>
						    <p style="margin-top:10px;color:#ff9900;font-size: 16px;text-align: center;">{{article.auth}}</p>
						</div>
				</div>
				<div class="_right">
						<div style="font-size: 16px" v-html="item.text">
						</div>
						<div height="100px"></div>
						<div class="bot">
						  <span class="time">{{item.time | time}}</span>
						</div>
				</div>				
		</div> 
	</div>
</template>
<style type="text/css">

.bot{
	position: absolute;
	bottom: 20px;
	right: 50px;
	
}
.time{
	font-size: 16px;
}

.a_title{
	height: 50px;
	line-height: 50px;
	font-size: 22px;
	color:#464c5b;
	padding: 0 50px;
	border-bottom:1px solid #e9eaec;
	background: white;
}
._left{
	padding: 50px 0;
	width:140px;
	background: #f8f8f9;
}
._right{
	position:relative;
	padding: 20px;
	flex:1;
	background: white;
	overflow: hidden;
}
._right img{
	width:400px;
}
</style>
<script type="text/javascript">
import report from "../vue/report.vue";
export default {
	data(){
		return {
			modal1:false,
			value:'',
			article:{
				title:'',
				auth:'',
				talk:'',
				time:'',
				text:''
			},
			auth:{

			},
			id:'',
			list:[],
			mesShow:false,
			fileList:[]
		}
	},
	methods:{
		getArticle(id) {
			this.$http.get("/getArticle?id="+id).then((d)=>{
				this.article = d.body[1];
				this.auth = d.body[0];
				if(d.body[1].fileName){
					let name = d.body[1].fileName.split(";");
					let url = d.body[1].fileUrl.split(";");
					for (let i =0; i<name.length;i++){
						this.fileList[i]={
							filename:name[i],
							fileUrl:url[i]
						}
					}	
				}
					
			})
		},
		load(url){
			window.location.href="/download?url="+url;
		},
		getReport(id){
			this.$http.get("/getReport?id="+this.id).then((d)=>{
				this.list = d.body;			
			})
		},
		show(){
			this.mesShow = true;
		},
		ok(){
			if (!this.value){ 
				this.$Message.warning("内容不能为空!");
			}else if(!document.cookie){
				this.$Message.warning("请登录!");
			}else{
				let obj = {
					to:this.article.auth,
					text:this.value
				}
				this.$Message.info("正在提交");
				this.$http.post("/message",obj).then((d)=>{
					console.log(d.body);
				})
				this.$Message.success("私信成功");
			}
		},
		report(){			
		}
	},
	created(){
		 let arr = window.location.href.split("/");
		 this.id = arr[arr.length-1];
	     this.getArticle(arr[arr.length-1]);
	     this.getReport();
	},
	components:{
		"report":report
	},
	watch: {
		'$route':function(){
			 let arr = window.location.href.split("/");
			 this.id = arr[arr.length-1];
		     this.getArticle(arr[arr.length-1]);
		     this.getReport();
		 }
	},
	filters:{
          time:function (value) {
          	var value = value*1000;
            function add0(m) {
                return m < 10 ? '0' + m : m
            }
            var time = new Date(parseInt(value));
            var y = time.getFullYear();
            var m = time.getMonth() + 1;
            var d = time.getDate();
            var h = time.getHours();
            var l = time.getMinutes();
            return add0(m) + '月' + add0(d)+'日'+add0(h)+":"+add0(l);
        }
     }
}
</script>
