<template>
	<Card>
        <p slot="title">
            <Icon type="flame" style="color:#ff3300"></Icon>
            热帖排行
        </p>
        <ul>
            <li v-for="item in hot" class="hot_a" @click="to(item.id,item.area)">
            	<span :class="{'first':item.index==1, 'second':item.index==2 ,'third':item.index==3, 'order':item.index>3}">{{item.index}}</span>
				<span style="margin-left:10px;color:#3399ff">{{item.title}}</span>
				<span style="margin-left:5px;font-size:12px;">{{item.auth}}</span>
				<span style="float:right;color:#FF0000">
				<Icon type="fireball"></Icon>

				{{item.talk}}</span>
            </li>
        </ul>
    </Card>
</template>
<style type="text/css">
.first{
	line-height: 16px;
	display: inline-block;
	width: 16px;
	height: 16px;
	text-align: center;
	background: red;
	border-radius: 1px;
	color: white;
	box-shadow: 0 0 1px 1px rgb(200,200,200)
}
.second{
	line-height: 16px;
	display: inline-block;
	width: 16px;
	height: 16px;
	text-align: center;
	background: #ff9900;
	border-radius: 1px;
	color: white;
	box-shadow: 0 0 1px 1px rgb(200,200,200)
}
.third{
	line-height: 16px;
	display: inline-block;
	width: 16px;
	height: 16px;
	text-align: center;
	background: #3399ff;
	border-radius: 1px;
	color: white;
	box-shadow: 0 0 1px 1px rgb(200,200,200)
}
.order{
	line-height: 16px;
	display: inline-block;
	width: 16px;
	height: 16px;
	text-align: center;
	background: #657180;
	border-radius: 1px;
	color: white;
	box-shadow: 0 0 1px 1px rgb(200,200,200)
}
.hot_a{
	height: 30px;
	line-height: 30px;
	cursor: pointer;
}
.hot_a:hover{
	background: rgb(240,240,240)
}
.hot_title{
	font-size:20px;
	border-bottom: 1px solid rgb(240,240,240);
	line-height: 40px;

}

.main{
	margin-top: 20px;
	border: 1px solid black;
	height: 600px;
}
</style>
<script type="text/javascript">
export default {
	data() {
		return {
			i:0,
			hot:[]
		}
	},
	methods:{
		to(id,area){
			this.$router.replace({path:"/talk/"+area+"/"+id})
		}
	},
	created(){
		this.$http.get('/getHot').then((d)=>{
			for (let i = 0 ;i<d.body.length;i++){
				if (d.body[i].title.length>10){
					d.body[i].title = d.body[i].title.slice(0,10)+'...';
				}
				d.body[i].index=i+1;
			}
			this.hot=d.body;
		})
	}
}
</script>