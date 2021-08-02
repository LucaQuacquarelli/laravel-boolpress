<template>
    <div class="col-4 my-3 d-flex">
        <div class="post-card w-100">
            <div class="card-body">
                <h4 class="card-title">{{ post.title }}
                    <a href="" class="badge badge-info" v-if="post.category">{{post.category.name}}</a>
                </h4>
                <p>{{ post.excerpt }}</p>
                <router-link :to="{name: 'single-post', params: {slug: post.slug} }">Leggi</router-link>
                <div class="my-3 h5" v-if="post.tags.length > 0">
                    <span v-for="tag in post.tags" :key="tag.id" class="badge badge-pill badge-dark mx-1 post-tag">{{ tag.name }}</span>
                </div>
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

        .post-tag {
            font-size: 10px;
        }
    }


</style>