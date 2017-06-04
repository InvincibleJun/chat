<template>
	<div>
		<div style="margin-bottom:10px">
			<h1>
			<Icon type="android-star-half" style="color:#FF0000"></Icon>
			我共发出{{l}}篇帖子
			</h1>
		</div>
		<div>

			<Card v-for="item in post">
	            <p @click="to(item.id,item.area)">
	            <Row>
	            	<Col span="12" style="font-size:16px;">
	            	{{item.title}}
	            	</Col>
	            	<br>
	            	<Col offset="12" span="3">
	            	<Icon type="chatbox-working"></Icon>
	            	回复{{item.talk}}					
	            	</Col>
	            	<Col span="8">
	            	<Icon type="clock"></Icon>
	            	时间{{item.time | time}}
	            	</Col>
	            </Row>
	            </p>
        	</Card>
		</div>
	

	</div>
</template>
<script>
export default {
	data(){
		return {
			l:'',
			post:[]
		}
	},
	methods:{
		to(id,area){
			this.$router.push({path:"/talk/"+area+"/"+id})
		}
	},
	created(){
		this.$http.get("/userArticle").then((d)=>{
			this.post = d.body;
			this.l = this.post.length;
		});
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