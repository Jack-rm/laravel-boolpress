<template>
    <section id="post-list" class="my-3 p-2">
        <h2 class="text-center">Available Posts</h2>
        
        <div class="loader" v-if="isLoading">
            <div class="spinner-border text-info " role="status">
                <span class="sr-only">Loading...</span>        
            </div>
        </div>
        
        <PostCard v-else v-for="post in posts" :key="post.id" :post="post" class="p-2 my-4"/>

    </section>
</template>

<script>
import PostCard from './PostCard.vue';

export default {
    name: 'PostList',
    components : {
        PostCard
    },
    data(){
        return{
            posts : [],
            users : [],
            baseUri : 'http://127.0.0.1:8000',
            isLoading: false,
        }
    }, 
    methods:{
        getPostList(){
            this.isLoading = true;
            
            axios.get(`${this.baseUri}/api/posts/`)
            .then((res) => { this.posts = res.data.posts })
                .catch((err)=> { console.error(err) })
                    .then(()=>{
                        this.isLoading = false;
                    });
        },

        getUserList(){
            this.isLoading = true;
            axios.get(`${this.baseUri}/api/users/`)
            .then((res) => { this.users = res.data.users })
                .catch((err)=> { console.error(err) })
                    .then(()=>{
                        this.isLoading = false;
                    });
        }
    },
    created() {
        this.getPostList();
        // this.getUserList();
        // console.log(this.users);
    }
}
</script>