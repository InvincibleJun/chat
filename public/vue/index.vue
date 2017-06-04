<template>
<div>
<banner>
<nav class="navbar navbar-default" style="margin-bottom:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <router-link class="navbar-brand" to="/">西邮论坛</router-link>
    </div>   
    <div class="navbar-header" style="margin-left:100px;">
      <a class="navbar-brand">爱国 求是 奋进</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li v-if="!user_name==''"><router-link to="/user/me">欢迎你！{{user_name}}</router-link></li>

        <li v-if="!user_name==''"><router-link to="/user/me">个人信息</router-link></li>
        <li v-if="user_name==''"><router-link to="/load">登录</router-link></li>
        <li v-if="!user_name==''"><a @click="quit">退出</a></li>

      </ul>
    </div>
  </div>
</nav>
</banner>
<div style="background:white;width:980px;margin:10px auto;box-shadow:0px 0px 5px #657180">
    <router-view></router-view>
</div>
<footer></footer>
</div>
</template>
<script type="text/javascript">
  export default {
      data(){
          return {
            user_name:''
          }
      },
      methods:{
         quit(){
           this.$Message.info("正在退出");
           var keys=document.cookie.match(/[^ =;]+(?=\=)/g);
            if (keys) {
               for (var i = 0;i<=keys.length; i++){
               document.cookie=keys[i]+'=0;expires=' + new Date( 0).toUTCString()
               }
            }
            location.reload(); 
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
      created(){
         if (document.cookie.length>0){
             this.user_name = this.get("user_name");
         }
      }
  }
</script>