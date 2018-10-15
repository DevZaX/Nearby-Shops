<template>
    <div class="container">
      <nav-component></nav-component>
        <div class="row justify-content-center">
        <div class="col-6">
        <h2>Sign up</h2>
        <div class="container">
            <ul>
                <li class="z-1245" v-for="(error,index) in list_errors" v-bind:key="index">{{error}}</li>
            </ul>
        </div>
          <div class="container">
            <ul>
                <p v-html="success"></p>
            </ul>
        </div>
        <form @submit.prevent="register()">
        <div class="form-group">
        <input  class="form-control" type="text" v-model="user.email" placeholder="mail">
        </div>
        <div class="form-group">
        <input name="password"  v-validate="'confirmed:confirmation'" class="form-control" type="password" v-model="user.password" placeholder="password">
        <span style="color:red;" v-show="errors.has('password')">{{errors.first('password')}}</span>
        </div>
          <div class="form-group">
        <input  name="confirmed_password" ref="confirmation" class="form-control" type="password" v-model="user.confirmed_password" placeholder="confirm password">
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary">Sign up</button>
        </div>
        </form>
        </div>
        </div>
    </div>
 </template>

 <script>
    export default {
        data() { 
            return {
                user : {
                    email : '',
                    password : '',
                    confirmed_password : ''
                },
               list_errors : [],
                success : ""
            }
        },
        methods : {
            register(){ 
                this.list_errors = [];
                this.success = "";
               axios.post('api/register',this.user)
               .then(res => {
                        this.success = "<li class='success'>" + res.data + "</li>";
                        setTimeout( () => { this.$router.push("/login");},2000);
                       
               })
               .catch(err  => {
                   console.log(err);
                   var messages = err.response.data.message;
                   if(messages.email != null){
                       this.list_errors.push(messages.email[0]);
                   }
                   if(messages.password != null){
                       this.list_errors.push(messages.password[0]);
                   }
                  
               });
                   
            }
        }
    }
 </script>

 <style>
    .z-1245{font-size: 2rem;color:red;}
    .success{font-size: 2rem;color:green;}
 </style>
