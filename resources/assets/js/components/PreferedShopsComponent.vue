<template>
   
    <div class="container">
    	<nav-component></nav-component>
        <h1>My Prefered Shops</h1>
       <div class="container">
       	<div class="row">
       		 
       		<div  class="col-3" v-for="shop in shops" v-bind:key="shop.id">
       			<p>{{shop.name}}</p>
       			<div class="card">
       				<img class="card-img-top" :src="shop.picture" />
       				<div class="card-body">
       					<button @click="remove(shop)" class="btn btn-danger">Remove</button>
       					
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
      url:"/api/prefered_shops",
      pagination:{}
    }
  },
  created(){
    this.getShops(this.$session.get("user_email"));
  },
  methods : {
    getShops(_user_email){
      var data = {user_email :_user_email }
      axios.post(this.url,data).then(res => {
        this.shops = res.data.shops.data;
        this.makePagination(res.data.shops);

      }).catch(err => {
        console.log(err)
      })

    },
    remove(shop){
      var data = {
        id : shop._id,
        shop_id : shop.id 
      }
      axios.post("/api/remove",data).then(res=>{
        console.log(res);
      }).catch(err=>{
        console.log(err);
      })
      this.getShops(this.$session.get("user_email"))
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
    this.getShops(this.$session.get("user_email"));
  }
  
    
  }
}
</script>

<style>
  .col-3{margin-top:30px;}
  .top2{margin-top:30px;text-align: center;margin-bottom: 20px;}
</style>