<template>
  <div>
    <h3 class="text-center">Edit Post</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="updatePost" enctype="multipart/form-data">
          <div class="form-group">
            <label>Title *</label>
            <input required type="text" class="form-control" v-model="post.title" placeholder="Enter Title">
          </div>
          <div class="form-group">
            <label>Slug *</label>
            <input required type="text" class="form-control" v-model="post.slug" placeholder="Enter Unique Slug">
          </div>
          <div class="form-group">
            <label>Excerpt *</label>
            <textarea required cols="30" rows="3" class="form-control" v-model="post.excerpt"
                      placeholder="Enter Excerpt"></textarea>
          </div>
          <div class="form-group">
            <label>Image *</label>
            <img :src="generateImage(post.image)" :alt="post.title">
            <input type="file" @change="onFileChange" class="form-control">
          </div>
          <div class="form-group">
            <label>Body *</label>
            <textarea required cols="30" rows="3" class="form-control" v-model="post.body"
                      placeholder="Enter Body"></textarea>
          </div>
          <div class="form-group">
            <label>Post Date</label>
            <input type="date" class="form-control" v-model="post.date">
          </div>
          <div class="form-group">
            <label>Seo Title</label>
            <input type="text" class="form-control" v-model="post.seo_title">
          </div>
          <div class="form-group">
            <label>Meta Description</label>
            <textarea cols="30" rows="3" class="form-control" v-model="post.meta_description"
                      placeholder="Enter Description"></textarea>
          </div>
          <div class="form-group">
            <label>Meta Keywords</label>
            <textarea cols="30" rows="3" class="form-control" v-model="post.meta_keywords"
                      placeholder="Enter Keywords"></textarea>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select v-model="post.status" class="form-control">
              <option value="PUBLISHED" selected>PUBLISHED</option>
              <option value="DRAFT">DRAFT</option>
              <option value="PENDING">PENDING</option>
            </select>
          </div>
          <div class="form-group">
            <label>Featured</label>
            <input type="checkbox" v-model="post.featured">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "EditPost",
  data() {
    return {
      post: {},
      file: null,
      image: ''
    }
  },
  created() {
    this.$axios
        .get(`/posts/${this.$route.params.id}`)
        .then((res) => {
          this.post = res.data;
        });
  },
  methods: {
    generateImage(val){
      return (val) ? `${process.env.VUE_APP_PUBURL}${val}`: null;
    },
    onFileChange(event) {
      this.image = event.target.files[0];
    },
    updatePost() {
      let formData = new FormData();

      formData.append("image", this.image);
      formData.append("title", this.post.title);
      formData.append("slug", this.post.slug);
      formData.append("excerpt", this.post.excerpt);
      formData.append("body", this.post.body);
      if (this.post.date){
        formData.append("date", this.post.date);
      }
      if (this.post.seo_title){
        formData.append("seo_title", this.post.seo_title);
      }
      if (this.post.meta_description){
        formData.append("meta_description", this.post.meta_description);
      }
      if (this.post.status){
        formData.append("status", this.post.status);
      }
      if (this.post.meta_keywords){
        formData.append("meta_keywords", this.post.meta_keywords);
      }
      formData.append("featured", this.post.featured ? 1 : 0);
      formData.append('_method','put');

      this.$axios
          .post(`/posts/${this.$route.params.id}`, formData)
          .then((res) => {
            console.log(res);
            this.$router.push({name: 'posts'});
          });
    }
  }
}
</script>

<style scoped>
img {
  max-width: 250px;
  display: block;
  margin: 5px 0;
}
</style>
