<template>
	<div>


	</div>
</template>
<script>
	export default{
		mounted(){
			this.getAuthData();
				
		},
		methods:{
			getAuthData(){
				this.$http.get('/getAuthData')
					.then((resp)=>{
						this.$store.commit('authData', resp.body)
					})
			}
		}
	
	
	}
</script>