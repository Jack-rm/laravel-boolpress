<template>
    <div class="card">
        <div class="card-header"> {{ user.name }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'UserCard',
    props: ['user']
}
</script>

<style>
</style>