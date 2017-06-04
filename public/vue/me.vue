<template>
	<div>
		<Row class="row">
			<Col span="4" offset="2">
				<p class="title">头像</p>
			</Col>
			<Col span="18">
				<upload></upload>
			</Col>
		</Row>
		<Row class="row">
			<Col span="4" offset="2">
				<p class="title">性别</p>
			</Col>
			<Col span="18">
				<p class="mes" v-if="! showSix">
					<span>{{user.six}}</span>
					<Button type="text" class="button" @click="showSix=true">
						<Icon type="android-create"></Icon>
						修改
					</Button>
				</p>
				<p v-else>
					 <Form :model="formItem" >
						 <Form-item class="form">
				            <Radio-group v-model="formItem.radio">
				                <Radio label="男">男</Radio>
				                <Radio label="女">女</Radio>
				            </Radio-group>
				        </Form-item>
				        <Button type="primary" @click="postSix">确认</Button>
				        <Button type="ghost" @click="showSix=true">取消</Button>
				      </Form>
				</p>
			</Col>
		</Row>

		<Row class="row">
			<Col span="4" offset="2">
				<p class="title">个性签名</p>
			</Col>
			<Col span="18">
				<p class="mes" v-if="!showMes">
					<span>{{user.Mes}}</span>
					<Button type="text" class="button" @click="showMes=true;formItem.desc=user.Mes">
						<Icon type="android-create"></Icon>
						修改
					</Button>
				</p>
				<p v-else>
					 <Form :model="formItem" >
						 <Form-item class="form">
				            <Input v-model="formItem.desc" type="textarea" :autosize="{minRows: 2,maxRows: 5}"></Input>
				        </Form-item>
				        <Button type="primary" @click="postMes">确认</Button>
				        <Button type="ghost" @click="showMes=false">取消</Button>
				     </Form>
				</p>
			</Col>
		</Row>

		<Row class="row">
			<Col span="4" offset="2">
				<p class="title">生日</p>
			</Col>
			<Col span="18">
				<p class="mes">
					<Row>
						<Col span='6'>
							<Form :model="formItem" >
					             <Form-item>
					                 <Date-picker type="date" placeholder="选择日期" v-model="formItem.date" @on-change="postTime" @on-clear="postTime">
					                 </Date-picker>
					            </Form-item>
					        </Form>
				        </Col>
			        </Row>
				</p>
			</Col>
		</Row>

		<Row class="row">
			<Col span="4" offset="2">
				<p class="title">兴趣爱好</p>
			</Col>
			<Col span="18">
				<p class="mes" v-if="!showMes">
					<Tag v-for="item in count" type="border" closable :color="item.color" :key="item.text" :name="item.text" closable @on-close="handleClose2">{{ item.text }}</Tag>
    				<Button icon="ios-plus-empty" type="dashed" size="small" @click="hobbyShow=true" v-show="!hobbyShow">添加标签</Button>
    				<Form :model="formItem" style="display:inline-block;width:100px" v-show="hobbyShow" onsubmit="return false">
						  <Form-item class="form">
				            <Input v-model="hobby" type="text"></Input>
				          </Form-item>
				    </Form>
				    <Button type="success" @click="postHobby" v-show="hobbyShow">确认</Button>
				</p>
			</Col>
		</Row>

	</div>
</template>
<style type="text/css">
.button{
	font-size: 14px;
	color:white;
}
.row{
	border-bottom: 1px solid #c3cbd6;
	padding: 20px 0px;
}
.title{
	font-size: 16px;
	font-weight: bold;
	height: 40px;
}
.mes{
	font-weight: normal;
	font-size: 16px;
}
.form{
	margin-bottom: 0px;
}

</style>
<script type="text/javascript">
import upload from "../vue/upload.vue";
export default{
	data(){
		return {
			formItem:{
				radio:"男",
				desc:"",
				date:''
			},
			user:{
				six:"未知",
				Mes:""
			},
			count: [],
			color:["red","blue","black","green","yellow"],
			hobby:'',
			showSix:false,
			showMes:false,
			hobbyShow:false,
			head:''
		}
	},
	methods:{
		postSix () {
			 this.user.six = this.formItem.radio;
			 const msg = this.$Message.loading("正在修改",0);
			 setTimeout(msg, 1000);
			 let six = '';
			 if (this.user.six == '男'){
			 	six = 1;
			 }else if(this.user.six == '女'){
			 	six = 0;
			 }
			 this.$http.get("/postSix?six="+six).then((d)=>{
			 	if( d.body == 'true'){
			 		this.$Message.success("修改成功");
			 		this.showSix = false
			 	}else{
			 		this.$Message.success("修改失败");
			 		this.showSix = false
			 	}
			 })
		},
		postMes () {
			 this.user.Mes = this.formItem.desc;
			 const msg = this.$Message.loading("正在修改",0);
			 setTimeout(msg, 1000);
			 this.$http.get("/postDesc?desc="+this.user.Mes).then((d)=>{
			 	if( d.body == 'true'){
			 		this.$Message.success("修改成功");
			 		this.showMes = false
			 	}else{
			 		this.$Message.success("修改失败");
			 		this.showMes = false
			 	}
			 })
		},
		postTime (t) {
			const msg = this.$Message.loading("正在修改",0);
			setTimeout(msg, 1000);
			this.$http.get("/postDate?date="+t).then((d)=>{
			 	if( d.body == 'true'){
			 		this.$Message.success("修改成功");
			 		this.showMes = false
			 	}else{
			 		this.$Message.success("修改失败");
			 		this.showMes = false
			 	}
			})
		},
		postHobby () {
			this.hobbyShow = false;
			if (this.hobby == ''){
				return this.$Message.warning("未添加任何爱好");
			}else if (this.count.length>10 ){
				return this.$Message.warning("爱好不能大于10个");
			}
			this.count.push({
				text:this.hobby,
				color:this.color[Math.floor(Math.random()*5)]
			});
			let hobby=[];
			for (let i = 0 ;i<this.count.length;i++){
				hobby.push(this.count[i].text);
			}
			hobby = hobby.join(",");
			const msg = this.$Message.loading("正在添加",0);
			this.$http.get("/postHobby?hobby="+hobby).then((d)=>{

			})
			setTimeout(msg, 1000);
			 setTimeout(()=>{
			 	this.$Message.success("添加成功");
			},1000);
			this.hobby = '';
        },
        handleClose2 (event, name) {
             const index = this.count.indexOf(name);
             this.count.splice(index, 1);
             let hobby=[];
			 for (let i = 0 ;i<this.count.length;i++){
					hobby.push(this.count[i].text);
		     }
			 hobby = hobby.join(",");
			 this.$http.get("/postHobby?hobby="+hobby).then((d)=>{

			 })

        },
         get(name){
            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
            if(arr=document.cookie.match(reg)){
              return decodeURIComponent(arr[2]);
            }else{
              return null;
            }
         }
	},
	watch:{

	},
	created(){
		let user = this.get("user_name");
		this.$http.get("/userAll?user="+user).then((d)=>{
			this.user.Mes = d.body[0].user_desc;
			this.formItem.date = d.body[0].user_date;
			this.head = d.body[0].user_img;
			if(d.body[0].user_hobby){
				let hobby = d.body[0].user_hobby.split(",");

				for (let i = 0; i<hobby.length;i++){
					this.count.push({
						text:hobby[i],
						color:this.color[Math.floor(Math.random()*5)]
					})
				}
			}
			if (d.body[0].user_six==1){
				this.user.six="男"
			} else if (d.body[0].user_six==0){
				this.user.six="女"
			}else {
				this.user.six="未知"

			}


		})
	},
	components:{
		"upload":upload
	}
}

// </script>
