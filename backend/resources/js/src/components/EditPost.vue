<template>
    <div>
        <h3 class="text-center">Edit Post</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatePost">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="post.name">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="post.detail">
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
            post: {}
        }
    },
    created() {
        this.$axios
            .get(`http://127.0.0.1:8000/api/posts/${this.$route.params.id}`)
            .then((res) => {
                this.post = res.data;
            });
    },
    methods: {
        updatePost() {
            this.$axios
                .patch(`http://127.0.0.1:8000/api/posts/${this.$route.params.id}`, this.post)
                .then((res) => {
                    this.$router.push({ name: 'home' });
                });
        }
    }
}
</script>

<style scoped>

</style>
