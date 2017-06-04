<style type="text/css">
.img{
  height: 300px;
}
</style>
<template>
<div>
	<Row :gutter="16">
      <Col span="3">
          <Affix @on-change="fixed" offset-top="40">
                <ul style="padding:5px;background:rgb(250,250,250)">
                  <router-link to='/'>
                    <li class="item" style="background:#5cadff;color:white">
                    首页
                    </li>
                  </router-link>
                  <router-link to='/talk/1'>
                    <li class="item">
                     学习交流
                    </li>
                  </router-link>
                  <router-link to='/talk/2'>
                    <li class="item">
                      校园生活
                    </li>
                  </router-link>
                  <router-link to='/talk/3'>
                    <li class="item">
                      二手交易
                    </li>
                  </router-link>
                  <router-link to='/talk/4'>
                    <li class="item">
                      就业指导
                    </li>
                  </router-link>
                  <router-link to='/talk/5'>
                    <li class="item">
                      失物招领
                    </li>
                  </router-link>
                  <router-link to='/talk/6'>
                    <li class="item">
                      新生专区     
                    </li>
                  </router-link>    
                </ul>
          </Affix>
          <div  style="color:rgba(255,255,255,0)">
             <div>占位</div>
          </div>
      </Col>
      <Col span="13">
        <Row>
          <Carousel autoplay v-model="value2" height="350px">
            <Carousel-item>
                <img class="img" src="../image/index/1.jpg" width="100%">
            </Carousel-item>
            <Carousel-item>
                <img class="img" src="../image/index/2.jpg" width="100%">
            </Carousel-item>
            <Carousel-item>
                <img class="img" src="../image/index/3.jpg" width="100%">
            </Carousel-item>
            <Carousel-item>
                <img class="img" src="../image/index/4.jpg" width="100%">
            </Carousel-item>
            <Carousel-item>
                <img class="img" src="../image/index/5.jpg" width="100%">
            </Carousel-item>
          </Carousel>
        </Row>
        <br>
        <Row>
            <ul>
              <li class="main_list" v-for="item in mainData" @click="linkTo(item.id,item.area)">
                <p class="l_title">{{item.title}}</p>
                <Row>
                  <Col span="4">
                    <span class="a1_bt" v-if="item.area == 1">学习交流</span>
                    <span class="a2_bt" v-if="item.area == 2">校园生活</span>
                    <span class="a3_bt" v-if="item.area == 3">二手交易</span>
                    <span class="a4_bt" v-if="item.area == 4">就业指导</span>
                    <span class="a5_bt" v-if="item.area == 5">失物招领</span>
                    <span class="a6_bt" v-if="item.area == 6">新生专区</span>
                  </Col>
                   <Col span="4">
                    <span>作者：{{item.auth}}</span>
                  </Col>
                  <Col span="6" >
                    <Icon type="chatbox-working" style="font-size:16px"></Icon>
                    <span>评论数：{{item.talk}}</span>
                  </Col>
                   <Col span="10" >
                   <Icon type="clock"></Icon>
                    <span>{{item.time | time}}</span>
                  </Col>
                </Row>
              </li>
            </ul>
            <div style="margin:20px 0 10px" v-show="more">
              <div style="position:relative;height:40px;">
                <Spin size="large" fix ></Spin>
              </div>
              <p style="text-align:center;font-size:16px;">正在加载</p>
            </div>
            <div style="margin:20px 0 10px" v-show="!more">
              <p style="text-align:center;font-size:16px;">没有更多了</p>
            </div>

        </Row>
      </Col>
      <Col span="8">
        <weather></weather>
        <p style="height:20px;"></p>
        <hot></hot>
      </Col>
  </Row>
</div>
</template>
<style type="text/css">
.item {
  color:#464c5b;
}
.item:hover{
  color: white
}
.demo-spin-col{
        height: 100px;
        position: relative;
        border: 1px solid #eee;
}
.img{
  height: 400px;
}
.main_list{
  padding: 20px 20px;
  height: 90px;
  border-bottom: 1px solid rgb(240,240,240);
  border-left: 1px solid rgb(240,240,240);
  border-right: 1px solid rgb(240,240,240);
}
.main_list:hover{
  box-shadow: 0 0 3px 3px #CCCCCC;
  cursor: pointer;
}
.item{
  font-size: 16px;
  text-align:center;
  height: 40px;
  line-height: 40px;
  margin-bottom: 5px;
  cursor: pointer;
  border-radius: 5px;
}
.item:hover{
  background: #FF3300;
}
.item:hover a{
  color:white;
}
.l_title{
      font-size: 16px;
      color:#464c5b;
      font-weight: bold;
      margin-bottom: 10px;
}
.a1_bt{
      border:1px solid green;
      padding:2px;
      color:green;
}
.a2_bt{
      border:1px solid #CC0000;
      padding:2px;
      color:#CC0000;
}
.a3_bt{
      border:1px solid #999999;
      padding:2px;
      color:#999999;
}
.a4_bt{
      border:1px solid #339933;
      padding:2px;
      color:#339933;
}
.a5_bt{
      border:1px solid #9999CC;
      padding:2px;
      color:#9999CC;
}
.a6_bt{
      border:1px solid #0000CC;
      padding:2px;
      color:#0000CC;
}
</style>
<script>
import weather from '../vue/weather.vue'
import hot from '../vue/hot.vue'
    export default {
        data () {
            return {
                scrolled:false,
                value2: 0,
                fix:false,
                page:1,
                mainData:[],
                status:true,
                more:true
            }
        },
        methods:{
          fixed(status) {
                this.fix = status
          },
          handleScroll () {
                if (!this.status) return
                let windowHeight = 0;
    　　　　    if(document.compatMode == "CSS1Compat"){
    　　　　      windowHeight = document.documentElement.clientHeight;
    　　        }else{
    　　　　      windowHeight = document.body.clientHeight;
    　　        }
                if (document.body.scrollHeight-windowHeight-document.body.scrollTop < 20 ){
                  this.status = false;
                  this.$http.get("/getNew?page="+this.page).then((d)=>{
                    if(d.body.length==0){
                      this.more=false;
                    }else{
                      this.mainData.push(d.body[0]);
                      this.page++;
                      this.status = true;
                    }
                 })
                } 
          },
          linkTo(id,area){
         this.$router.push({path:"/talk/"+area+"/"+id})

          }
        },
        components:{
           "weather":weather,
           "hot":hot
        },
        mounted() {
             this.status = false
            this.$http.get("/getNew?page="+this.page).then((d)=>{
                this.mainData=d.body;
                this.page++;
               this.status = true

            })
            window.addEventListener('scroll', this.handleScroll);
        },
        filters:{
          time:function (value) {
            var value = value*1000;
            function add0(m) {
                return m < 10 ? '0' + m : m
            }
            var time = new Date(parseInt(value));
            var y = time.getFullYear();
            var m = 1+time.getMonth();
            var d = time.getDate();
            var h = time.getHours();
            var l = time.getMinutes();
            return add0(m) + '月' + add0(d)+'日'+add0(h)+":"+add0(l);
        }
      }
    }
</script>