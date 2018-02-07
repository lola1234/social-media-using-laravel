import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state:{
		
		nots:[],
		posts:[],
		authUser:{}
	},
	
	getters:{
		
		all_nots(state){
			return state.nots
		},
		all_nots_count(state){
			return state.nots.length
		},
		allPosts(state){
			return state.posts
		}
	},
	
	mutations:{
		
		add_not(state, not){
			state.nots.push(not)
		},
		add_post(state, post){
			state.posts.push(post)
		},
		authData(state, user){
			state.authUser = user
		},
		updatePostLike(state, payload){
			var post = state.posts.find((p) =>{
				return p.id === payload.id
			})
			post.likes.push(payload.like)
		},
		unlikePost(state, payload){
			var post = state.posts.find((p) =>{
				return p.id === payload.id
			})
			var like = post.likes.find((l)=>{
				return l.id === payload.like.id 
			})
			var index=post.likes.indexOf(like)
			post.likes.splice(index,1)
		}
	}
	
	
})