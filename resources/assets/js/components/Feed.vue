<template>
	<div class="row">
		
		<div class="panel panel-default" v-for="post in posts">
			<div class="panel-heading">				
				<img :src="post.user.avatar" alt="" width="40px" height="40px" class="avatarFeed">
				{{ post.user.name }}
				<span class="pull-right">{{ post.created_at }}</span>
			</div>
			
			<div class="panel-body">
				{{ post.content }}
				 <Like :id="post.id"></Like> 
			</div>
		</div>
				
	</div>
</template>

<script>
	import Like from './Like.vue';
	export default{
		mounted(){
			this.getFeed()
		},	
		
		components:{Like },
		
		methods:{
			getFeed(){
				this.$http.get('/feed')
					.then((response)=>{
						response.body.forEach((post)=>{
							this.$store.commit('add_post', post)
						})
					})
			}
		},
		
		computed:{
			posts(){
				return this.$store.getters.allPosts
			}
		}
	
	}
</script>

<style>
.avatarFeed{
	border-radius: 50px;
}
</style>