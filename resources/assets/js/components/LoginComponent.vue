 <template>

 	<div class="container">
 	          <nav-component></nav-component>
 		<div class="row justify-content-center">
 		<div class="col-6">
 		<h2>Sign in</h2>
 		<form>
			 <p v-html="msgError"></p>
		
 		<div class="form-group">
 		<input name="email"  v-validate="'required|email'"  class="form-control" type="text" v-model="user.email" placeholder="mail">
		 <span style="color:red;" v-show="errors.has('email')">{{errors.first('email')}}</span>
 		</div>
 		<div class="form-group">
 		<input  name="password" v-validate="'required'" class="form-control"    type="password" v-model="user.password" placeholder="password">
		 <span style="color:red;" v-show="errors.has('password')">{{errors.first('password')}}</span>
 		</div>
 		<div class="form-group">
 		<button type="button" @click="login()" class="btn btn-primary">Sign in</button>
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
				"email" : '',
				"password" : ''
			},
			msgError :  ''
		}
	},
	methods : {
		login() {
			this.$validator.validateAll().then(()=>{
				this.msgErrormsg = "";
				var data = {"client_id":"5b624c2b1ac8750c40006e74",
				"client_secret":"8nTWa27QKJzGk2nHixz88tKkYhxeN0I1AgRKJlQV",
				"grant_type":"password",
				"username":this.user.email,
				"password":this.user.password}
				axios.post("oauth/token",data).then(res => {
				         this.$session.start()
				         this.$session.set("user_email",this.user.email)
					Vue.prototype.$auth.setToken(res.data.access_token,res.data.expires_in+Date.now());
					this.$router.push("/");
				}).catch(err => {
					
					this.msgError = "<li class='error'>The user credentials were incorrect ! </li>"

				});
			});
			
		}
	}
}

 </script>


 <style>
   .error{color:red;}
 </style>