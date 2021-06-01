<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav" v-if="isLogged">
          <router-link to="/posts" class="nav-item nav-link">Posts List</router-link>
          <router-link to="/create" class="nav-item nav-link">Create Post</router-link>
        </div>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" v-if="!isLogged">
          <router-link to="/login" class="nav-item nav-link">login</router-link>
          <router-link to="/register"  class="nav-item nav-link">Register</router-link>
        </ul>
        <button type="button" class="btn btn-danger" @click="logout" v-else>
          Logout
        </button>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'App',
  computed: {
    ...mapGetters([
      'isLogged'
    ])
  },
  methods: {
    logout () {
      this.$store.dispatch('logout')
    }
  }
}
</script>

<style>

</style>
