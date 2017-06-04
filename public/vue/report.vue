<template>
	<div>
		<span @click="show" class="report">回复</span>
	    <Modal width="600"
          height="300"
	        title="发布新帖"
	        v-model="modal10"
	        class-name="vertical-center-modal" 
	        :mask-closable="false"
	        ok-text="发表"
        	cancel-text="取消"
        	loading='true'
			    @on-ok="ok">
		   		<quill-editor  ref="myTextEditor" v-model="content"></quill-editor>
	    </Modal>
	 </div>
</template>
<style type="text/css">
.report{
  font-size: 14px;
  margin-left:10px;
  color:#3399ff;
  cursor: pointer;
}
.vertical-center-modal{
        display: flex;
        align-items: center;
        justify-content: center; 
    }
.ivu-modal{
            top: 0;
 }
.ql-editor{
	height: 300px !important;
}
</style>
<script type="text/javascript">
	export default {
       data () {
            return {
                value:"",
                label:"",
            	  content:"请输入内容",
                modal10: false,
                title:"",
                model1:''
            }
      },
      methods:{
        	ok(){
        		this.$Notice.warning({
                    title: '正在发布'
                });
            let obj = {
                 content:this.content,
                 auth:this.auth,
                 index:this.index,
                 id:this.act
            } 
            this.$http.post("/report",obj).then((data)=>{
                if (data.body == '回复成功'){
                  this.modal10 = false;
                  this.$Notice.success({
                         title:"发布成功"
                  })
                  setTimeout(()=>{location.reload()},500) 
                }else{
                  this.$Notice.error({
                         title:data.body
                     })
                }
               
            })
        	},
          show(){
              if (this.auth=="undefined") return this.$Notice.info({title:"请你先登录"});
                  this.modal10 = true;
          }

      },
      created(){
         this.auth = decodeURI(document.cookie.split("=")[1]);
      },
      computed: {
  	    	editor() {
  	      		return this.$refs.myTextEditor.quillEditor
  	    	}
  		},
      props: ['index',"act"],
  		watch:{
    			
  		}
    }
</script>