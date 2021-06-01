<template>
    <div>
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
            <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.id }}</td>
                <td>{{ post.author.name }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.excerpt }}</td>
                <td>{{ post.image }}</td>
                <td>{{ post.status }}</td>
                <td>{{ post.date }}</td>
                <td>{{ post.featured ? 'Yes' : 'No' }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "AllPosts",
    data() {
        return {
            posts: []
        }
    },
    created() {
        this.$axios
            .get('http://127.0.0.1:8000/api/posts/')
            .then(response => {
                this.posts = response.data;
            });
    },
    methods: {
        deleteProduct(id) {
            this.$axios
                .delete(`http://127.0.0.1:8000/api/posts/${id}`)
                .then(response => {
                    let i = this.posts.map(data => data.id).indexOf(id);
                    this.posts.splice(i, 1)
                });
        }
    }
}
</script>

<style scoped>

</style>
