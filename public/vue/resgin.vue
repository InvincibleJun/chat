<template>
    <Form ref="formValidate" :model="formValidate" :rules="ruleValidate" :label-width="80">
        <Form-item label="昵称" prop="name" class="form_item">
            <Input v-model="formValidate.name" placeholder="请输入姓名"></Input>
        </Form-item>
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
        <Form-item label="确认密码" prop="passwdCheck" class="form_item">
            <Input type="password" v-model="formValidate.passwdCheck"></Input>
        </Form-item>

       <Form-item label="职业" prop="work" class="form_item">
            <Radio-group v-model="formValidate.work">
                <Radio label="1">同学</Radio>
                <Radio label="2">教师</Radio>
                <Radio label="3">游客</Radio>
            </Radio-group>
        </Form-item>
        <Form-item>
            <Button type="primary" long @click="handleSubmit('formValidate')">提交</Button>
        </Form-item>
    </Form>
</template>
<style type="text/css">
.ivu-input-type{
    z-index: 100000;
}
.form_item{
    margin-bottom: 20px;
}

</style>
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
                loading:false,
                loadtext:'点击发送邮件',
                waitingTime:60,
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
        methods: {
            handleSubmit (name) {
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        this.$Message.success('正在注册中!');
                        this.$http.post('/resgin',this.formValidate).then(function(data){
                            if (data.body=="注册成功"){
                                this.$Message.success(data.body,"自动登录中")
                                this.$router.push({"path":'/'});
                            }else{
                                this.$Message.error(data.body);
                            }
                        })
                    } else {
                        this.$Message.error('请认真填写表单');
                    }
                })
            },
            handleReset (name) {
                this.$refs[name].resetFields();
            },
            initEmail (){
                this.loading = false;
                this.waitingTime = 60;
                this.loadtext = "点击发送邮件";
            },
            postEmail () {
                if (this.formValidate.mail === '') {
                    return this.$Message.error('请输入邮箱!')
                }
                this.loading = true;
                this.loadtext = "正在发送";
                this.$http.get("/send?mail="+this.formValidate.mail).then((d)=>
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
            }
        }
    }
</script>
