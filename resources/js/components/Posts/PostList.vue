<template>
    <section id="post-list" class="my-3 p-2">
        <h2 class="text-center">Available Posts</h2>
        
        <div class="loader" v-if="isLoading">
            <div class="spinner-border text-info " role="status">
                <span class="sr-only">Loading...</span>        
            </div>
        </div>
        
        <PostCard v-else v-for="post in posts" :key="post.id" :post="post" class="p-2 my-4"/>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-if="currentPage > 1" @click="getPostList(currentPage - 1)" class="page-item">
                    <a class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li v-for="n in lastPage" :key="n" @click="getPostList(n)" :class="{ active: n === currentPage }" class="page-item">
                    <a class="page-link" >{{ n }}</a>
                </li>
                <li v-if="currentPage < lastPage" @click="getPostList(currentPage + 1)" class="page-item">
                    <a class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>

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
            isLoading : false,
            currentPage : 1,
            lastPage : null,
        }
    }, 
    methods:{
        getPostList( page ){
            this.isLoading = true;
            
            axios.get(`${this.baseUri}/api/posts/?page=${page}`)
            .then((res) => {
                
                this.posts = res.data.data

                this.currentPage = res.data.current_page;
                this.lastPage = res.data.last_page;

                })
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