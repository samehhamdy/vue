<template>
    <div>
        <h1>Create Post</h1>
        <form @submit.prevent = 'addPost'>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Post Title</label>
                        <input v-model="post.title" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Post Body</label>
                        <textarea v-model="post.body" class="form-control" type="text"></textarea>
                    </div>
                </div>
            </div>
            <br />
            <div class="form-group">
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
        <h1>Posts</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{name: 'create'}" class="btn btn-primary">Create new post</router-link>
            </div>
        </div> <br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts" v-bind:key="post.id">
                <td>{{post.id}}</td>
                <td>{{post.title}}</td>
                <td>{{post.body}}</td>
                <td>
                    <router-link :to="{name: 'edit', params: {id: post.id}}" class="btn btn-dark">Edit</router-link>
                </td>
                <td><button class="btn btn-danger" @click.prevent="deletePost(post.id)">Delete</button></td>

            </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                posts: [],
                post:{},
            }
        },
        created() {
            let uri = '/api/posts';
            this.axios.get(uri).then(response => {
                this.posts = response.data.data;

            });
        },
        methods: {
            deletePost(id)
            {
                let uri = `/api/post/delete/${id}`;
                this.axios.delete(uri).then(response => {
                    this.posts = response.data;
                });
            },
            addPost(){
                let uri = '/api/post/create';
                this.axios.post(uri,this.post).then((response) => {
                    console.log(response.data);
                    this.posts.unshift(response.data);
                });
            }
        },

    }
</script>