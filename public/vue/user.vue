<template>
	<Row>
		<Col span="24">
			<div class="main">
				<div class="__left">                      
                    <Menu  active-name="1" width="200">
                            
                            <Menu-item name="1" @click="to('me')">
                                <router-link to="/user/me">

                                    <Icon type="document-text"></Icon>
                                    个人信息
                                </router-link>
                                
                            </Menu-item>

                            <Menu-item  name="2">
                                <router-link to="/user/message">

                                    <Icon type="chatbubbles"></Icon>
                                    最新消息
                                </router-link>

                            </Menu-item>  

                            <Menu-item name="3">
                                <router-link to="/user/myPost">

                                    <Icon type="chatbubbles"></Icon>
                                    我的帖子
                                </router-link>

                            </Menu-item> 

                    </Menu>
				</div>
				<div class="__right">
					<router-view></router-view>
				</div>
			</div>
		</Col>
	</Row>
</template>
<style type="text/css">
.main{
	display: flex;
    margin:0px  !important;
    border: none !important;
}
.__left{
	width: 200px;

}
.__right{
    padding:50px 50px;
	flex: 1;
}
a{
    color: inherit;
}
</style>

<script>
    export default {
        data () {
            return {
               
            }
        },
        to (url){
            alert(url)
        }
    }
</script>