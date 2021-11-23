<template>
    <div class="container">
        <main>
            <PostList />
        </main>
    </div>
</template>

<script>
    import PostList from "./Posts/PostList.vue";
    
    export default {
        name: 'App',
        data(){
            return {
            }
        },
        components:{
            PostList
        },        
    }
</script>