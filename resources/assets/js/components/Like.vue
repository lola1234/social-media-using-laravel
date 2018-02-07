<template>
	<div>
		<hr>
			<p class="text-center" v-for="like in post.likes">
				<img :src="like.user.avatar" alt="" height="20px" width="20px" class="avatarLike">
			</p>
		<hr>
		<button class="btn btn-primary btn-xs" v-if="!authLikesPost" @click="like()">Like</button>
		<button class="btn btn-danger btn-xs"  v-else @click="unlike()">UnLike</button>
	</div>

</template>

<script>
	export default{
		mounted(){
			
		},
		props:['id'],
		computed:{
			likers(){
				var likers=[]
				this.post.likes.forEach((like)=>{
					likers.push(like.user.id)
				})
				return likers
			},			
			authLikesPost(){
				var checkIndex = this.likers.indexOf(
					this.$store.state.authUser.id
				);
				if(checkIndex === -1)
					return false;
				else
					return true;
			},
			post(){
				return this.$store.state.posts.find((post)=>{
					return post.id === this.id
				});
			}
		},
		
		methods:{
			like(){
				this.$http.get('/like/' + this.id)
					.then((resp) =>{
						this.$store.commit('updatePostLike', {
							id: this.id,
							like: resp.body
						})
						toastr.success('success','Post Liked');
					})
			},
			
			unlike(){
				this.$http.get('/unlike/' + this.id)
					.then((resp) =>{
						this.$store.commit('unlikePost', {
							id: this.id,
							like: resp.body
						})
						toastr.success('success','Post unLiked');
					})
			}
			
		}
		
	}

</script>

<style>
.avatarLike{
	border-radius: 50px;
}
</style>