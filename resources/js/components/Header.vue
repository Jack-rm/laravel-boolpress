<template>
    <header class="p-4">
        <h1 class="text-center"> {{ title }} </h1>
    </header>
</template>

<script>
export default {
    name: 'Header',
    props: {
        'title' : String,
    },
}
</script>