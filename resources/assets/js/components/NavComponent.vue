<template>

<div >
<router-link v-show="!isAuth" to="/login" class="btn btn-primary">Sign in</router-link>
 <router-link  v-show="!isAuth" to="/register" class="btn btn-primary">Sign up</router-link>
 <button @click="logout()" v-show="isAuth" to="/logout" class="btn btn-danger">Log out</button>

</div>



</template>             


<script>
export default {
 data(){
    return {
        isAuth : Vue.prototype.$auth.isAuth() ? true : false 
    }
 },
    methods : {
        logout(){
            Vue.prototype.$auth.destroyToken();
            this.$session.destroy();
            this.$router.push("/login");
        }
      
    }
}
</script>