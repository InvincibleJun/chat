<style lang="less">
    .vertical-center-modal{
        display: flex;
        align-items: center;
        justify-content: center;

        .ivu-modal{
            top: 0;
        }
    }
</style>
<template>
	<div>
	    <Button @click="modal10 = true" type="ghost" style="float:right">忘记密码</Button>
	    <Modal
	        title="对话框标题"
	        v-model="modal10"
            width="400"
            okText="提交"
            cancelText='取消'
            @on-ok="forget"
            loading='true'
	        class-name="vertical-center-modal">
            <Form ref="formValidate" :model="formValidate" :rules="ruleValidate" :label-width="80">
    	       <Form-item label="邮箱" prop="mail" class="form_item">
                  <Input v-model="formValidate.mail" placeholder="请输入邮箱"></Input>
               </Form-item>
               <Form-item label="验证码" prop="vcode" class="form_item">
                <Row>
                    <Col span="12">
                        <Input v-model="formValidate.vcode" placeholder="/请输入邮箱验证码"></Input>
                    </Col>
                    <Col>
                        <Button type="primary" :loading="loading" @click="postEmail">
                            <span>{{loadtext}}</span>
                        </Button>
                    </Col>
                </Row>
                </Form-item >
                <Form-item label="密码" prop="passwd" class="form_item">
                   <Input type="password" v-model="formValidate.passwd"></Input>
                </Form-item >
            </Form>
   		 </Modal>
    </div>
</template>
<script>
    export default {
        data () {
             const validatePassCheck = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'));
                } else if (value !== this.formValidate.passwd) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
             };
            return {
                loadtext:"点击发送验证码",
                waitingTime:60,
                modal10: false,
                formValidate: {
                    name: '',
                    mail: '',
                    vcode: '',
                    work: [],
                    passwd:'',
                    passwdCheck:''
                },
                ruleValidate: {
                    name: [
                        { required: true, message: '姓名不能为空', trigger: 'blur' },
                        { pattern:/^[\u4E00-\u9FA5]{2,6}$/,message:"请输入名称2-6位汉字",trigger: "blur" }
                    ],
                    mail: [
                        { required: true, message: '邮箱不能为空', trigger: 'blur' },
                        { type: 'email', message: '邮箱格式不正确', trigger: 'blur' }
                    ],

                    vcode: [
                       { required: true, message: '验证码不能为空', trigger: 'blur' }
                       
                    ],
                    passwd: [
                       { required: true, message: '请输入密码', trigger: 'blur' },
                       { pattern:/^[0-9a-zA-Z]{6,12}$/, message: '请输入6-12位密码', trigger: 'blur' }
                    ],
                    passwdCheck:[
                       {required: true, message: '请输入密码',trigger: 'blur' },
                       {validator: validatePassCheck, trigger: 'blur' }
                    ],
                    work: [
                        { required: true , message:"请选择职业", trigger:"change"}
                    ]            
                }
            }
        },
        methods:{
            postEmail () {
                if (this.formValidate.mail === '') {
                    return this.$Message.error('请输入邮箱!')
                }
                this.loading = true;
                this.loadtext = "正在发送";
                this.$http.get("//localhost/send?mail="+this.formValidate.mail).then((d)=>
                {
                    this.waiting();          
                    console.log(d.body)
                });
            },
            waiting () {
                setTimeout(()=>{
                    if (this.waitingTime == 0) return this.initEmail();
                    this.loadtext = this.waitingTime+"秒后点击重新发送"; 
                    this.waitingTime--;
                    this.waiting();
                },1000)
            },
            forget () {
                let obj = {
                    password:this.formValidate.passwd,
                    mail:this.formValidate.mail,
                    code:this.formValidate.vcode
                }
                this.$http.post("/forget",obj).then((d)=>{
                    if (d.body == "false"){
                      this.$Message.success("验证码错误");
                      return
                    }
                      this.modal10 = false;
                      this.$Message.success("修改成功");
                })
 
            }
        }
    }
</script>