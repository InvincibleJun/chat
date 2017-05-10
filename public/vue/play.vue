<template>
    <div>
        <div id="bg">
            <li id="_1"></li>
            <li id="_2"></li>
            <li id="_3"></li>
            <li id="_4"></li>
            <li id="_5"></li>
            <li id="_6"></li>
            <li id="_7"></li>
        </div>
        <div id="btn">
            <ul>
                <li index='0' class="cur"></li>
                <li index='1' ></li>
                <li index='2' ></li>
                <li index='3' ></li>
                <li index='4' ></li>
                <li index='5' ></li>
                <li index='6' ></li>
            </ul>
        </div>
        <div id="order" style="position:absolute;bottom:0">
                <div>
                    <a href='javascript:void(0)'>
                        <span class="glyphicon glyphicon-chevron-left">
                        </span>
                    </a>
                </div>
                <div>
                    <a href='javascript:void(0)'>
                        <span class="glyphicon glyphicon-chevron-right">
                        </span>
                    </a>
                </div>
        </div>
    </div>
</template>
<script>
 //bg部分
function Fade(id,obj){
            this.id = id;
            this.btn = this.getBtn(obj.btn);
            this.li = this.getLis(obj.btn);
            this.order = this.getOrder(obj.order);
            this.time = 0;
            this.index = 0;
            this.opacity = 1;
            this.zIndex = -100;
            this.intelval = obj.intelval*60 || 180;
            this.imgs = this.getImg(this.id);
            this.status = 'wait';
            this.next = -1;
            this.prev = 0;
            this.init();
        }
        Fade.prototype = {
            init:function(){ 
                if (this.btn) this.onBtn();
                if (this.order) this.onOrder();
                this.RAF;
                this.wait();
            },
            RAF:(function() {
                var lastTime = 0;
                var vendors = ['webkit', 'moz'];
                for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
                    window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
                    window.cancelAnimationFrame =
                      window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
                }

                if (!window.requestAnimationFrame)
                    window.requestAnimationFrame = function(callback, element) {
                        var currTime = new Date().getTime();
                        var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                        var id = window.setTimeout(function() { callback(currTime + timeToCall); },
                          timeToCall);
                        lastTime = currTime + timeToCall;
                        return id;
                    };

                if (!window.cancelAnimationFrame)
                    window.cancelAnimationFrame = function(id) {
                        clearTimeout(id);
                    };
            })(),

            getOrder:function(id){
                if (!id) return false
                var order=document.getElementById(id).getElementsByTagName("div");
                return {left:order[0],right:order[1]};
            },

            onOrder:function(){
                var that = this;
                this.addEvent(this.order.left,'click',function(e){
                    var e = e || window.event;   
                    that.prevent(e);
                    if (that.index === 0){
                        that.next = that.imgs.length-1;
                    }else{
                        that.next = that.index-1;
                    }
                    that.time = that.intelval-1;
                })
                this.addEvent(this.order.right,'click',function(e){
                    var e = e || window.event;   
                    that.prevent(e);
                    if (that.index === that.imgs.length-1){
                        that.next=0;
                    }else{
                        that.next=that.index+1;
                    }
                    that.time = that.intelval-1;
                })
            },

            getBtn:function(id){
                if (!id) return false;
                return document.getElementById(id);
            },

            getLis:function(id){
                if (!id) return false; 
                console.log(id);
                console.log(document.getElementById(id))
                var lis = document.getElementById(id).getElementsByTagName('li');
                var temp=[];
                for (var i=0; i<lis.length; i++){
                    temp.push(lis[i]);
                }
                return temp;
            },
            prevent:function(e){
                if (e.preventDefault) {
                    e.preventDefault();
                } else{
                    e.returnValue=false;
                };
            },
            getImg:function(id){
                var imgs = document.getElementById(id).getElementsByTagName('li');
                var temp=[];
                for (var i=0; i<imgs.length; i++){
                    if (i==0){
                        imgs[0].style.cssText = 'display:block;z-index:-100';
                    }else{
                        imgs[i].style.cssText= 'display:none;z-index:'+--this.zIndex;
                    }
                    temp.push(imgs[i]);
                }
                return temp;
            },

            wait:function(){
                var that = this;
                that.opacity = 1;
                that.time=0;
                that.status = 'wait';
                  
                (function(){
                    if(++that.time===that.intelval){
                        that.status = 'play';
                        that.li[that.getnext()].className="cur";
                        that.li[that.prev].className="";
                        that.imgs[that.getnext()].style.cssText='display:inline;z-index:'+--that.zIndex;
                        that.animate();
                    }else{
                        window.requestAnimationFrame(arguments.callee);
                    }
                })();        
            },
            animate:function(){

                var that = this;
                (function(){
                    that.opacity = that.opacity - 0.05;
                    if (document.all) {
                        that.imgs[that.index].style.filter = 'alpha(opacity=' + that.opacity*100+ ')';
                    } else {
                        that.imgs[that.index].style.opacity = that.opacity;
                    }
                    if (that.opacity<=0) {
                        that.imgs[that.index].style.cssText = 'opacity:0;display:none';
                        if (that.next>-1) {
                            that.index = that.next;
                            that.next = -1;
                        }else{
                            if (that.index == that.imgs.length-1 ){
                                that.index = 0;
                            }else{
                                ++that.index;
                            }
                        }
                        that.prev = that.index;
                        that.wait();
                    }else{
                        window.requestAnimationFrame(arguments.callee);
                    }
                })()  
            },
 
            getnext:function(){
 
                if ( this.next>-1) {
                    return this.next
                }
                if (this.index === this.imgs.length-1) {
                     return 0;
                }else{
                     return this.index+1;
                }

            },
            addEvent:function(ele,type,fn){
                if (ele.addEventListener) {
                    ele.addEventListener(type,fn)
                } else if (ele.attachEvent) {
                    ele,addAttachEvent('on'+type, fn);
                } else {
                    ele['on'+type] = fn;
                }
                return this;
            },
            onBtn:function(){
                var btn = this.btn;
                var that = this;
                this.addEvent(btn,'click',function(e){
                    if (that.status === 'play') return 
                    var e = e || window.event;   
                    var target = e.target || e.srcElement;
                    that.prevent(e);
                    if(target.getAttribute("index")){
                        var index = Number(target.getAttribute("index"))
                    }else{
                        return
                    }
                    if (that.index == index){
                        return
                    }
                    that.next = index;
                    that.time = that.intelval-1;

                })
            }         
};
alert(1);
new Fade("bg",{btn:'btn',order:'order',interval:4});
</script>
<style lang="less" scoped>
li{
    display: block;
    width: 100%;
    height: 100%;
}
#bg{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;

}

#bg li:nth-child(1){
    background: url("../image/index/1.jpg");
    background-position: cover;
    background-position: center center
}
#bg li:nth-child(2){
    background-position: cover;
    background: url(../image/index/2.jpg); 
    background-position: center center
}
#bg li:nth-child(3){
    background-position: cover;
    background: url(../image/index/3.jpg); 
    background-position: center center   
}
#bg li:nth-child(4){
    background-position: cover;
    background: url(../image/index/4.jpg); 
    background-position: center center   
}
#bg li:nth-child(5){
    background-position: cover;
    background: url(../image/index/5.jpg); 
    background-position: center center   
}
#bg li:nth-child(6){
    background-position: cover;
    background: url(../image/INDEX/6.jpg); 
    background-position: center center   
}
#bg li:nth-child(7){
    background-position: cover;
    background: url(../image/index/7.jpg);  
    background-position: center center       
}
#bg li{
    height: 100%;
    width: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    display: none;
}
#btn{
    position: absolute;
    bottom: 20px;
    width: 100%;
}
#btn ul{
    width: 210px;
    margin: 0 auto
}
#btn li{
    width: 12px;
    height: 12px;
    border-radius: 6px;
    box-shadow: 0px 0px 1px 1px #CCFFCC;
    background: #FFFFCC;
    float: left;
    margin-right: 20px;
    cursor: pointer;
}
#btn .cur{
    background:#336666;
}
#btn li:last-child{
    margin-right: 0px;
}
#btn li:last-child:after{
    visibility:hidden;
    content: ',';
    display:block;
    height:0;        
    clear:both;
}
.page-container {
    margin: 120px auto 0 auto;
}
#order span{
    font-size: 40px;
}
#order{
    position: absolute;
    top:0;
    left: 0;
    bottom: 0;
    right: 0;
    margin:auto;
    height: 40px;
    padding: 0 40px;
}
#order div:nth-child(1){
    float: left;
}
#order div:nth-child(2){
    float: right;
}
#order div a{

    color: rgba(240,240,240,0.1);
}
#order div a:hover{
    color: white;
}


</style>


