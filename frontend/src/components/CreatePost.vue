<template>
  <div>
    <h3 class="text-center">Create Post</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="addPost" enctype="multipart/form-data">
          <div class="form-group">
            <label>Title *</label>
            <input required type="text" class="form-control" v-model="post.title" placeholder="Enter Title">
          </div>
          <div class="form-group">
            <label>Excerpt *</label>
            <textarea required cols="30" rows="3" class="form-control" v-model="post.excerpt"
                      placeholder="Enter Excerpt"></textarea>
          </div>
          <div class="form-group">
            <label>Image *</label>
            <input type="file" required @change="onFileChange" class="form-control">
          </div>
          <div class="form-group">
            <label>Body *</label>
            <textarea required cols="30" rows="3" class="form-control" v-model="post.body" placeholder="Enter Body"></textarea>
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
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreatePost",
  data() {
    return {
      post: {
        status: 'PUBLISHED',
        featured: 1,
      },
      file:null,
      image:''
    }
  },
  methods: {
    onFileChange(event) {
      this.post.image = event.target.files[0];
    },
    addPost() {
      let formData = new FormData();

      formData.append("image", this.post.image);
      formData.append("title", this.post.title);
      formData.append("excerpt", this.post.excerpt);
      formData.append("body", this.post.body);
      formData.append("date", this.post.date);
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

      this.$axios
          .post('/posts/create', formData)
          .then(() => {
            this.$router.push({name: 'posts'})
          })
          .catch(err => {
            console.log(err)
          })
          .finally(() => this.loading = false)
    }
  }
}
</script>

<style scoped>

</style>
