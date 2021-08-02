<template>
    <section v-if="post">
        <h1>{{post.title}}
            <a href="" class="badge badge-info" v-if="post.category">{{post.category.name}}</a>
            <span v-else class="badge badge-secondary">Categoria sconosciuta</span>
        </h1>
        <p>{{post.content}}</p>
        <div class="my-3 h5" v-if="post.tags.length > 0">
            <span v-for="tag in post.tags" :key="tag.id" class="badge badge-pill badge-dark mx-1">{{ tag.name }}</span>
        </div>
        <h6 class="my-3" v-else>Nessun tag collegato</h6>    
        <router-link :to="{name: 'blog'}" class="btn btn-primary">Torna all'Elenco</router-link>
    </section>
    <Loader v-else/>
</template>

<script>
import Loader from '../components/Loader.vue';

export default {
  components: { 
      Loader 
    },
    name: 'SinglePost',
    data: function() {
        return {
            post: null
        }
    },
    methods: {
        getPost: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/posts/${slug}`)
                .then(
                    res => {
                        this.post = res.data;
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