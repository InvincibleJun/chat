import VueRouter from './vue-router'
import Vue from './vue.min'

import Index from "../vue/index.vue"
import user from "../vue/user.vue"
import main from "../vue/main.vue"

import Load from "../vue/load.vue"
import forget from "../vue/forget.vue"
import resgin from "../vue/resgin.vue"


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
     				component:user
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
     				path:'/load/resgin',
     				component: resgin
     			},
     			{
     				path:'/load/forget',
     				component: forget
     			}
     		]
     	}
     ]
})

const app = new Vue({
	el:"#app",
	router
})






