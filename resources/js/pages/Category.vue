<template>
    <section v-if="!loading && category">
        <h1>Post appartenenti alla categoria: <span class="badge badge-primary">{{ category.name }}</span></h1>
        <div class="d-flex flex-wrap" v-if="category.posts.length > 0">
            <PostCard v-for="post in category.posts" :key="post.id" :post="post"/>
        </div>
        <h3 v-else class="my-5">Nessun Post in questa categoria</h3>
        <router-link :to="{name: 'blog'}" class="btn btn-primary">Torna all'Elenco</router-link>
    </section>
    <NotFound v-else-if="!loading && !post"/>
    <Loader v-else/>
</template>

<script>
import Loader from '../components/Loader.vue';
import PostCard from '../components/PostCard.vue';
import NotFound from './NotFound.vue';
export default {
  components: { 
        Loader,
        PostCard,
        NotFound
    },
    name: 'Category',
    data: function() {
        return {
            category: null,
            loading: true
        }
    },
    methods: {
        getCategory: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/categories/${slug}`)
                .then(
                    res => {
                        if (Object.entries(res.data) == 0) {
                            this.category = null;
                        } else {
                            this.category = res.data;
                        }
                        this.loading = false;
                    }
                )
                .catch(
                    err => {
                        console.log(err);
                    }
                );
        }
    },
    created: function() {
        this.getCategory(this.$route.params.slug)
    }
}
</script>

<style>

</style>