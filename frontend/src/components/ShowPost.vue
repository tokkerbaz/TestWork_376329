<template>
  <div>
    <h3 class="text-center">Show Post</h3>
    <div class="row">
      <div class="col-md-6">
          <div class="form-group">
            <label>Title </label>
            <h1>{{post.title}}</h1>
          </div>
          <div v-if="post.excerpt && post.excerpt.length > 0" class="form-group">
            <label>Excerpt </label>
            <p>{{post.excerpt}}</p>
          </div>
          <div v-if="post.image && post.image.length > 0" class="form-group">
            <label>Image</label>
            <img :src="generateImage(post.image)" :alt="post.title">
          </div>
          <div v-if="post.body && post.body.length > 0" class="form-group">
            <label>Body</label>
            <div>{{post.body}}</div>
          </div>
          <div v-if="post.date && post.date.length > 0" class="form-group">
            <label>Post Date</label>
            <p>{{post.date}}</p>
          </div>
          <div v-if="post.seo_title && post.seo_title.length > 0" class="form-group">
            <label>Seo Title</label>
            <p>{{post.seo_title}}</p>
          </div>
          <div v-if="post.meta_description && post.meta_description.length > 0" class="form-group">
            <label>Meta Description</label>
            <p>{{post.meta_description}}</p>
          </div>
          <div v-if="post.meta_keywords && post.meta_keywords.length > 0" class="form-group">
            <label>Meta Keywords</label>
            <p>{{post.meta_keywords}}</p>
          </div>
          <div class="form-group">
            <label>Status</label>
            <p>{{post.status}}</p>
          </div>
          <div class="form-group">
            <label>Featured</label>
            <p>{{post.featured ? 'yes': 'no'}}</p>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: "AllPosts",
  data() {
    return {
      post: {},
      file: null,
      image: ''
    }
  },
  created() {
    this.$axios
        .get(`/posts/${this.$route.params.slug}`)
        .then((res) => {
          this.post = res.data;
        });
  },
  methods: {
    generateImage(val){
      return (val) ? `${process.env.VUE_APP_PUBURL}${val}`: null;
    }
  }
}
</script>

<style scoped>
  label {
    color: grey;
    font-style: italic;
    width: 100%;
    display: block;
  }
  img {
    max-width: 300px;
  }
</style>
