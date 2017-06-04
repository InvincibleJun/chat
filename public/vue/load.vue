<template>
	<div id="main">
	    <h1 class="title">西邮论坛</h1>
	    <p class="title2">分享快乐，一起交流</p>
	    <Tabs :animated="false" :value="index" @on-click="to">
	        <Tab-pane label="登陆" name='load'>
	        	 <load></load>
	        </Tab-pane>
	        <Tab-pane label="注册" name='resgin'>
				 <resgin></resgin>
	        </Tab-pane>
	    </Tabs>
	</div>
</template>
<style type="text/css">
#main{
	width: 300px;
    position: fixed;
    top:10%;
    left:50%;
    transform: translate(-50%);
}
.title{
	text-align: center;
	font-size: 50px;
	margin-bottom: 30px;
}
.title2{
	text-align: center;
	font-size: 20px;
	margin-bottom: 20px;
}

</style>
<script type="text/javascript">
import loadTab from "../vue/loadTab.vue"
import resgin from "../vue/resgin.vue"
export default {
	data() {
		return {
			index:'load'
		}
	},
	created:function(){
		this.index = this.$route.name
	},
	methods:{
		to(name){
			this.$router.push({path:'/load/'+name})
		}
	},
	components:{
		"load":loadTab,
		"resgin":resgin
	}
}

</script>
