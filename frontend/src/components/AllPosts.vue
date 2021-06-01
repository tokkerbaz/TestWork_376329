<template>
  <div>
    <modal v-if="modalVisible" @close="modalVisible = false" @deletePost="deletePost" :data="modalData"/>
    <h2 class="text-center">Posts List</h2>
    <table class="table">
      <thead>
      <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Excerpt</th>
        <th>Image</th>
        <th>Status</th>
        <th>Date</th>
        <th>Featured</th>
        <!-- <th>Actions</th> -->
      </tr>
      </thead>
      <tbody v-if="posts.length > 0">
      <tr v-for="post in posts" :key="post.id">
        <td>{{ post.id }}</td>
        <td>{{ post.author.name }}</td>
        <td>{{ post.title }}</td>
        <td>{{ post.excerpt }}</td>
        <td><img :src="generateImage(post.image)" :alt="post.title"></td>
        <td>{{ post.status }}</td>
        <td>{{ post.date }}</td>
        <td>{{ post.featured ? 'Yes' : 'No' }}</td>
        <td>
          <div class="btn-group" role="group">
            <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-success">Edit</router-link>
            <button class="btn btn-danger" @click="showModal(post.id)">Delete</button>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import modal from './modalDelete'

export default {
  name: "AllPosts",
  components:{modal},
  data() {
    return {
      posts: [],
      modalVisible: false,
      modalData: null
    }
  },
  created() {
    this.$axios
        .get('/posts')
        .then(response => {
          this.posts = response.data;
        });
  },
  methods: {
    generateImage(val) {
      let path;
      if (val) {
        path = `${process.env.VUE_APP_PUBURL}${val}`
      } else {
        path = `${process.env.VUE_APP_PUBURL}/images/placeholder.jpg`;
      }
      return path;
    },
    deletePost(id) {

      this.$axios
          .delete(`/posts/${id}`)
          .then(response => {
            console.log(response);
            let i = this.posts.map(data => data.id).indexOf(id);
            this.posts.splice(i, 1);
            this.modalData = null;
            this.modalVisible = false;
          });
    },
    showModal(postId) {
      this.modalData = postId;
      this.modalVisible = true;
    },
    closeModal(postId) {
      let post = this.posts.filter(post => {
        return (post.id === postId)
      });
      post.isModalVisible = false;
    }
  }
}
</script>

<style scoped>
img {
  max-width: 100px;
}
</style>
