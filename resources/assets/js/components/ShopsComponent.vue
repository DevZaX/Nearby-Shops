 <template>
 	<div class="container">
 		 <nav class="navbar navbar-expand-lg navbar-light bg-light container">
       <a class="navbar-brand text-primary" href="/">shops nearby</a>
       <ul class="navbar-nav ml-auto nav-right">
      <li class="nav-item">
        <router-link class="nav-link text-dark" to="/">Nearby Shops</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link  text-dark " to="/prefered_shops">My Prefered Shops</router-link>
      </li>
     
    
    </ul>
        </nav> 
	     	
		    <router-view></router-view>
 	</div>
 </template>

 <script>
 export default {
	
  }
	
 

 </script>	
