<template>
   
    <div class="container">
    	<nav-component></nav-component>
        shops
       <div class="container">
       	<div class="row">
       		 
       		<div  class="col-3" v-for="shop in shops" v-bind:key="shop._id">
       			<p>{{shop.name}}</p>
       			<div class="card">
       				<img class="card-img-top" :src="shop.picture" />
       				<div class="card-body">
       					<button @click="dislike(shop)" class="btn btn-danger">Dislike</button>
       					<button  @click="like(shop)" class="btn btn-success float-right">Like</button>
       				</div>
       			</div>
       		</div>
     
       	</div>
    
       </div>

       <div class="top2">
       <button class="btn btn-primary" @click="fetchPagination(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">prev</button>

<button class="btn btn-primary"  @click="fetchPagination(pagination.next_page_url)" :disabled="!pagination.next_page_url">next</button>
</div>

    </div>
    
</template>

<script>
export default {
	data(){
		return {
			shops : [],
			url:"/api/shops",
			pagination:{}
		}
	},
	created(){
		this.getShops()
	},
	methods : {
		getShops(){
			axios.post(this.url).then(res => {
				console.log(res.data.shops);
				this.shops = res.data.shops.data;
				this.makePagination(res.data.shops);

			}).catch(err => {
				console.log(err)
			})

		},
		dislike(shop){
			var data = {
				id : shop._id,
				time :  Date.now()

			}
			axios.post("/api/dislike",data).then(res=>{
				console.log(res.data.shop);
			}).catch(err=>{
				console.log(err);
			})
			this.getShops()
		},
		like(shop){
			var data = {shop_id:shop._id,user_email:this.$session.get("user_email")}
			axios.post("/api/like",data).then(res=>{
				console.log(res);
				this.$router.push("/prefered_shops");
			}).catch(err=>{
				console.log(err);
			})
		},
		
		makePagination(data){
	   	          let pagination = {
			current_page : data.current_page,
			last_page : data.last_page,
			next_page_url : data.next_page_url,
			prev_page_url : data.prev_page_url,
		}
		
		this.pagination = pagination
	},
	fetchPagination(url){
		this.url = url,
		this.getShops()
	}
		
	}
}
</script>

<style>
	.col-3{margin-top:30px;}
	.top2{margin-top:30px;text-align: center;margin-bottom: 20px;}
</style>

