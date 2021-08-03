<template>
    <section v-if="!loading && post">
        <h1>{{post.title}}
            <router-link v-if="post.category" class="badge badge-primary" :to="{ name: 'category', params: { slug: post.category.slug } }">{{ post.category.name }}</router-link>
            <span v-else class="badge badge-secondary">Categoria sconosciuta</span>
        </h1>
        <p>{{post.content}}</p>
        <div class="my-3 h5" v-if="post.tags.length > 0">
            <span v-for="tag in post.tags" :key="tag.id" class="badge badge-pill badge-dark mx-1">{{ tag.name }}</span>
        </div>
        <h6 class="my-3" v-else>Nessun tag collegato</h6>    
        <router-link :to="{name: 'blog'}" class="btn btn-primary">Torna all'Elenco</router-link>
    </section>
    <NotFound v-else-if="!loading && !post"/>
    <Loader v-else/>
</template>

<script>
import Loader from '../components/Loader.vue';
import NotFound from './NotFound.vue';

export default {
  components: { 
        Loader,
        NotFound 
    },
    name: 'SinglePost',
    data: function() {
        return {
            post: null,
            loading: true
        }
    },
    methods: {
        getPost: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/posts/${slug}`)
                .then(
                    res => {
                        
                        if (Object.entries(res.data) == 0) {
                            this.post = null;
                        } else {
                            this.post = res.data;
                        }
                        this.loading = false;
                    }
                )
                .catch(
                    err => {
                        console.log(err);
                    }
                )
        }
    },
    created: function() {
        this.getPost(this.$route.params.slug)
    }
}
</script>

<style lang="scss" scoped>

</style>