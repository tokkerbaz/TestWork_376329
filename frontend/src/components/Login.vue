<template>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-5 col-md-3">
        <form @submit.prevent="login" class="form-login">
          <h4>Welcome back.</h4>
          <input type="text" id="userName" class="form-control input-sm chat-input" v-model="formData.email"
                 placeholder="email"/>
          <br>
          <input type="password" id="userPassword" class="form-control input-sm chat-input" v-model="formData.password"
                 placeholder="password"/>
          <br>
          <div class="wrapper">
            <span class="group-btn">
              <button type="submit" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
            </span>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      formData:{}
    }
  },
  methods: {
    login () {
      this.$store
          .dispatch('login', this.formData)
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