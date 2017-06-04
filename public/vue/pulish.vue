<template>
	<div>
		<Button @click="show">发帖</Button>
	    <Modal width="800"
	        title="发布新帖"
	        v-model="modal10"
	        class-name="vertical-center-modal" 
	        :mask-closable="false"
	        ok-text="发表"
        	cancel-text="取消"
        	loading='true'
			    @on-ok="ok">
	        <div style="font-size:18px;margin:10px">
		         <label>标题</label>
		         <i-input v-model="title" placeholder="请输入..." style="width: 400px"></i-input>
             <Select v-model="model1" :placeholder="value" disabled style="width:100px">
                <Option v-for="item in aList" :value="item.value" :key="item">{{ item.label }}</Option>
            </Select>
	        </div>
	        <div style="overflow:auto;padding:20px">
		   		  <quill-editor  ref="myTextEditor" v-model="content"></quill-editor>
			    </div>
          <div style="padding:0 40px;">
            <Upload 
            action="/uploadFile" 
            name="file"
            :format="['jpg','jpeg','png','pdf','docx','doc']"
            :on-format-error="handleFormatError"
            :on-success='success'
            >
              <Button type="ghost" icon="ios-cloud-upload-outline">上传附件</Button>
              <span>仅支持PDF,WORD文件格式</span>
            </Upload>
          </div>
	    </Modal>
	 </div>
</template>
<style type="text/css">
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
                model1:'',
                aList: [
                    {
                        value: '1',
                        label: '学习交流'
                    },
                    {
                        value: '2',
                        label: '校园生活'
                    },
                    {
                        value: '3',
                        label: '二手交易'
                    },
                    {
                        value: '4',
                        label: '就业指导'
                    },
                    {
                        value: '5',
                        label: '失物招领'
                    },
                    {
                        value: '6',
                        label: '新生专区'
                    }
                ],
                fileList:[]
            }
      },
      methods:{
        	ok(){
            if (this.title=='') {
               this.$Notice.warning({
                    title: '标题为空'
                });
               return
            }
            if (this.content==''){
               this.$Notice.warning({
                    title: '内容为空'
                });
               return
            }
        		this.$Notice.warning({
                    title: '正在发布'
                });
             let obj = {
                 a:this.label,
                 title:this.title,
                 content:this.content,
                 auth:this.auth,
                 file:0
            } 
            if (this.fileList.length>0){
                let urlArr = [];
                let name = [];
                for (let i=0; i<this.fileList.length;i++){
                    urlArr.push(this.fileList[i].url);
                    name.push(this.fileList[i].name);
                }
                obj.file = 1;
                obj.fileUrl = urlArr.join(";");
                obj.fileName = name.join(";");
            }
            this.$http.post("/pulish",obj).then((data)=>{
                if (data.body == 1){
                  this.modal10 = false;
                  this.$Notice.success({
                         title:"发布成功"
                  })
                }else{
                  this.$Notice.error({
                         title:"图片过大"
                     })
                }
               
            })
        	},
          show(){
              if (this.auth=="undefined") return this.$Notice.info({title:"请你先登录"});
                  this.modal10 = true;
                   for (let i = 0; i<this.aList.length;i++){
                      if (this.aList[i].value == this.index){
                       this.value = this.aList[i].label;
                       this.label = i+1;
                       break;
                      }
                  }
          },
          handleFormatError (file) {
                this.$Notice.warning({
                    title: '文件格式不正确',
                    desc: '文件 ' + file.name + ' 格式不正确，请上传图片，word或者pdf格式的文件。'
                });
          },
          success (a,b,c){
             let o ={
                 name:b.name,
                 url:a
             };
             this.fileList.push(o);
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
         this.auth = this.get("user_name");
      },
      computed: {
  	    	editor() {
  	      		return this.$refs.myTextEditor.quillEditor
  	    	}
  		},
      props: ['index'],
  		watch:{
    			
  		}
    }
</script>