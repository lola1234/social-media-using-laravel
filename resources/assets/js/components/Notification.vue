<template>
	<div>
	
	</div>
</template>

<script>
	export default{
		mounted(){
			this.listen()
		
		},
		props:['id'],
		methods:{
			listen(){
				Echo.private('App.User.' + this.id)
					.notification((notification)=>{						
						toastr.success(notification.message)
						this.$store.commit('add_not', notification)
						document.getElementById("toast-audio").play()
					})
					
			}
			
		}	
	}
</script>