<template>
    <div>
        <h3 class="text-center">Create Post</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addPost" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="post.title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label>Excerpt</label>
                        <textarea cols="30" rows="3" class="form-control" v-model="post.excerpt" placeholder="Enter Excerpt"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea cols="30" rows="3" class="form-control" v-model="post.body" placeholder="Enter Body"></textarea>
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
                        <textarea cols="30" rows="3" class="form-control" v-model="post.meta_description" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea cols="30" rows="3" class="form-control" v-model="post.meta_keywords" placeholder="Enter Keywords"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select v-model="post.status" class="form-control">
                            <option value="PUBLISHED">PUBLISHED</option>
                            <option value="DRAFT">DRAFT</option>
                            <option value="PENDING">PENDING</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Featured</label>
                        <input type="checkbox" checked v-model="post.featured">
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
            post: {}
        }
    },
    methods: {
        addPost() {
            this.$axios
                .post('http://127.0.0.1:8000/api/posts', this.post)
                .then(response => (
                    console.log(response)
                    // this.$router.push({ name: 'home' })
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>

<style scoped>

</style>
