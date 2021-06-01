<template>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-5 col-md-3">
        <form @submit.prevent="register" class="form-login">
          <h4>Register</h4>
          <input type="text" id="userName" class="form-control input-sm chat-input" v-model="formData.name"
                 placeholder="Name"/>
          <br>
          <input type="email" id="userEmail" class="form-control input-sm chat-input" v-model="formData.email"
                 placeholder="Email"/>
          <br>
          <input type="password" id="userPassword" class="form-control input-sm chat-input" v-model="formData.password"
                 placeholder="Password"/>
          <br>
          <input type="password" id="userPasswordConfirm" class="form-control input-sm chat-input"
                 v-model="formData.password_confirmation"
                 placeholder="Confirm password"/>
          <br>
          <div class="wrapper">
            <span class="group-btn">
                <button type="submit" class="btn btn-primary btn-md">Register <i class="fa fa-sign-in"></i></button>
            </span>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      formData: {}
    }
  },
  methods: {
    register(){
      this.$store
          .dispatch('register', this.formData)
          .then(() => {
            this.$router.push({ name: 'posts' })
          })
          .catch(err => {
            console.log(err)
          })
    }
  }
}
</script>

<style scoped>

</style>