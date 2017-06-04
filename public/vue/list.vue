<template>
	<div>
				<ul>
					<li v-for="item in list" @click="to(item.id)" class="m_list">
							<Tag type="border">{{item.talk}}评论</Tag>
							<Tag color="red" v-if="item.hot==1">热</Tag>
							<Tag color="blue" v-if="item.top==1">置</Tag>
							<Tag color="green" v-if="item.good==1">精</Tag>
							<span class="list_title">{{item.title}}</span>
							<p style="float:right;width:100px;height:80px;overflow:hidden;line-height:20px;padding:20px;text-align:center">
								<span>{{item.auth}}</span>
								<br>
								<span>{{item.time | time}}</span>
							</p>		
					</li>
				</ul>
				<div style="margin:20px 0 10px">
	              <div v-show="more" style="position:relative;height:40px;">
	                <Spin size="large" fix ></Spin>
	              </div>
	              <p  v-show="more" style="text-align:center;font-size:16px;">正在加载</p>
	              <p v-show="!more" style="text-align:center;font-size:16px;">没有更多了</p>
	            </div>	
	</div>	
</template>
<style type="text/css">
.list_title{
	font-size: 16px;
	color:black;
	display: inline-block;
}
.talkName{
	font-size: 20px;
}
.top{
	height: 150px;
}
.m_list{
	padding: 0 20px;
	height: 80px;
	line-height: 80px;
	border-bottom: 1px solid rgb(240,240,240)

}	
</style>
<script type="text/javascript">
	export default {
	data(){
		return {
			more:true,
			status:true,
			imgSrc:'',
			talkName:'',
			talkNum:'',
			talkMes:'',
			page:1,
			list:[]
		}
	},
	methods:{
		to(id){
			this.$router.push({path:this.$route.path+'/'+id})
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
		},
		scroll(){
			let windowHeight = 0;
		　　if(document.compatMode == "CSS1Compat"){
		　　　　windowHeight = document.documentElement.clientHeight;
		　　}else{
		　　　　windowHeight = document.body.clientHeight;
		　　}
			if (document.body.scrollHeight-windowHeight-document.body.scrollTop < 20 ){
				if (this.status === true){
				  this.loadList(this.id);
			    }
			}
		},
		loadList(id){
			this.status = false;
			this.$http.get("/list?id="+id+"&page="+this.page).then((d)=>{
				for (let i=0;i<d.body.length;i++){
					if (d.body[i].title.lenth>15){
						d.body[i].title = d.body[i].title.slice(15);
					}
				}
				if(this.page!=1 & d.body.length!=0){
					this.list.push(d.body)
				} else if (this.page ==1 ){
					this.list=d.body;
				} else{
					this.more=false;
				}
				this.page++;
			    this.status = true;
			})
		},

	},
	mounted(){
		window.addEventListener("scroll",this.scroll);
		var arr = window.location.href.split("/");
		this.id = arr[arr.length-1];
		this.loadList(arr[arr.length-1]);
		 if(document.body.style.overflow!="hidden"&&document.body.scroll!="no"&&
			    document.body.scrollHeight>document.body.offsetHeight)
			{
			    this.more= false;
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