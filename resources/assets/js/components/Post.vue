<template>
	<div class="row">
		<div class="panel panel-default">               
			<div class="panel-body">                  
				<textarea rows="5" class="form-control" v-model="content"></textarea>
				<br>
				<button class="btn btn-success pull-right" :disabled="notWorking" @click="createPost">Create</button>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		mounted(){
			
			
			
		},
		data(){
			return{
				content:'',
				notWorking: true
			}
		},
		methods:{
			createPost(){
				this.$http.post('/create/post', { content:this.content})
					.then((resp) =>{
						this.content=''
						toastr.success("Post created")
						console.log(resp)
					})
			}
		},
		watch: {
			content(){
				if(this.content.length > 0)
					this.notWorking = false
				else
					this.notWorking = true
			}
		},
		http:{
			root:'/root',
			headers: {
				'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
			}
        }  
	}



</script>