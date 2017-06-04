import VueRouter from './vue-router'

import "../css/iview.css"

import Index from "../vue/index.vue"
import user from "../vue/user.vue"
import main from "../vue/main.vue"

import Load from "../vue/load.vue"
import talk from "../vue/talk.vue"
import myPost from "../vue/myPost.vue"
import message from "../vue/message.vue"
import post from "../vue/post.vue"
import list from "../vue/list.vue"
// user\
import me from "../vue/me.vue"

import ajax from "vue-resource"

import Editor from "vue-quill-editor"

// import editor from "vue-html5-editor"
// Vue.use(editor);

Vue.use(Editor); 
Vue.use(ajax); 
Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
     routes: [
     	{
     		path: '/',
     		component: Index,
     		children:[
     			{
     				path:'/user',
     				component:user,
                         children:[
                                   {
                                        path:'/user/me',
                                        component:me
                                   },
                                   {
                                        path:'/user/myPost',
                                        component:myPost
                                   },
                                   {
                                        path:'/user/message',
                                        component:message
                                   }
                              ]
     			},
                    {
                         path:"/talk/:id",
                         component:talk,
                         children:[
                              {    
                                   name:"1",
                                   path:"/talk/1",
                                   component:list
                              },
                              {    
                                   name:"2",
                                   path:"/talk/2",
                                   component:list
                              }, 
                              {    
                                   name:"3",
                                   path:"/talk/3",
                                   component:list
                              },
                              {
                                   name:"4",    
                                   path:"/talk/4",
                                   component:list
                              },
                              {    
                                   name:"5",
                                   path:"/talk/5",
                                   component:list
                              },
                              {    
                                   name:"6",
                                   path:"/talk/6",
                                   component:list
                              },
                              {
                                   path:"/talk/:id/:ID",
                                   component:post,
                              }
                         ]
                    },
     			{
     				path:'/',
     				component:main
     			}
     		]
     	},
     	{
     		path: '/load',
     		component: Load,
     		children: [
     			{      
                         name:"resgin",
     				path:'/load/resgin'
     			},
     			{
     				path:'/load/load'
     			}
     		]
     	}
     ]
})

const app = new Vue({
	el:"#app",
	router
     
})







