<template>
    <Form action="www.baidu.com" ref="formCustom" :model="formCustom" :rules="ruleCustom" :label-width="70">
        <Form-item label="账号" prop="number">
            <Input type="text" v-model="formCustom.number"></Input>
        </Form-item>
        <Form-item label="密码" prop="passwd">
            <Input type="password" v-model="formCustom.passwd"></Input>
        </Form-item>
        <Form-item>
            <Button type="success" long @click="handleSubmit('formCustom')">登录</Button>
        </Form-item>
        <forget></forget>
    </Form>
</template>
<style type="text/css">

</style>
<script>
import forget from "../vue/forget.vue";
export default {
        data () {
            const validnumber = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入账号'));
                } else {
                    callback();
                }
            };
            const validpasswd = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    callback();
                }
            };          
            return {
                formCustom: {
                    number:'',
                    passwd: ''
                },
                ruleCustom: {
                    number: [
                        { validator: validnumber, trigger: 'blur' }
                    ],
                    passwd: [
                        { validator: validpasswd, trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            handleSubmit (name) {
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        this.$Message.success('正在登录');
                        this.$http.post("/userload",this.formCustom).then( (d)=>{                           
                            if (d.body == "登录成功"){
                                this.$Notice.success({
                                    title:d.body,
                                    desc:"3秒后跳转至首页"
                                })
                                setTimeout(()=>{
                                    this.$router.push({path:'/'})
                                },3000);
                            } else {
                                this.$Notice.info({
                                    title:d.body
                                })
                            }
                        })
                    } 
                })
            },
            handleReset (name) {
                this.$refs[name].resetFields();
            }
        },
        components:{
            "forget":forget
        }
    }
</script>