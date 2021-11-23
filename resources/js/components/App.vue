<template>
    <div class="container">

        <Header :title="title" />
        <main>
            <PostList />
        </main>
    </div>
</template>

<script>
    import Header from "./Header.vue";
    import PostList from "./Posts/PostList.vue";
    
    export default {
        name: 'App',
        data(){
            return {
                title : "YES! IT WORKS!"
            }
        },
        components:{
            Header,
            PostList
        },        
    }
</script>