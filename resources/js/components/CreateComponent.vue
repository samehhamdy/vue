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

    </div>
</template>

<script>
    export default {
        data(){
            return {
                post:{}
            }
        },
        methods:{
            addPost(){
                let uri = '/api/post/create';
                this.axios.post(uri,this.post).then((response) => {
                    this.$router.push({name: 'posts'})
                });
            }
        }

    }
</script>