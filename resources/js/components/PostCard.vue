<template>
    <div class="col-4 my-3 d-flex">
        <div class="post-card w-100">
            <div class="card-body">
                <h4 class="card-title">{{ post.title }}</h4>
                <p>{{ post.excerpt }}</p>
                <router-link :to="{name: 'single-post', params: {slug: post.slug} }">Leggi</router-link>
            </div>
        </div>      
    </div>
</template>

<script>
export default {
    name: 'PostCard',
    props: {
        post : Object,
    }
}
</script>

<style lang="scss" scoped>

    .post-card {
        margin: 10px;
        padding: 10px;
        border: 3px solid royalblue;
    }


</style>