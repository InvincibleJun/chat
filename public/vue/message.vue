<template>
	<div>
		<h2>我的消息</h2>
		<div v-for="item in message" style="margin-bottom:5px;">
			<Card class="clearfix">
				<p style="margin-bottom:20px">
					<Badge dot>
			            <p style="height:20px;font-size:18px;" v-if="item.class=='私信'">
				            <Icon type="chatboxes" style="color:#99CCFF" ></Icon>
				            {{item.class}}    
				        </p>
				        <p style="height:20px;font-size:18px;" v-if="item.class=='系统'">
				            <Icon type="flag" style="color:#ed3f14" ></Icon>
				            {{item.class}}    
				        </p>
				    </Badge>
				    <span style="float:right">
				    	<!-- <Button type="success" @click="report(item.id)">回复</Button> -->
				   		<Button type="info" @click="del(item.id)">删除</Button>
				    </span>
			    </p>
			    <p style="font-size:16px">&nbsp&nbsp&nbsp&nbsp{{item.text}}</p>
			    <p style="margin-top:20px;float:right">发信人:{{item.user}}&nbsp&nbsp&nbsp&nbsp   时间:{{item.time|time}}</p>
	        </Card>
		</div>
		<div style="height:400px;padding:150px 220px" v-if="message.length==0" >
			<h1>消息列表为空</h1>
		</div>
	</div>
</template>
<style type="text/css">
.clearfix:after{
	  content:".";        
     display:block;        
     height:0;        
     clear:both;        
     visibility:hidden;        
}
</style>
<script type="text/javascript">
export default{
	data() {
		return {
			message:[]
		}
	},
	methods:{
		getMessage() {
			this.$http.get("/getMessage").then((d)=>{
				this.message = d.body;
			})
		},
		del(id) {
			this.$http.get("/delMessage?id="+id).then((d)=>{
				if (d.body == 'true'){
					for (let i=0; i<this.message.length; i++){
						if(this.message[i].id == id){
							this.message.splice(i,1);
							break;
						}
					}
					this.$Message.success("删除成功");
				}
			})
		}
	},
	created(){
		this.getMessage();
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
            var min = time.getMinutes();
            var s = time.getSeconds();
            return y + '年' + add0(m) + '月' + add0(d)+"日  "+add0(h)+":"+add0(min)+":"+add0(s);
        }
	}
}
</script>
