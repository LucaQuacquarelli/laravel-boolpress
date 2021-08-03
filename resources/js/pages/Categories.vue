<template>
    <section v-if="categories.length > 0">
        <h1>Tutte le categorie:</h1>
        <div class="d-flex h2 my-4">
            <router-link v-for="category in categories" :key="category.id" class="badge badge-primary mx-4" :to="{ name: 'category', params: { slug: category.slug } }">{{ category.name }}</router-link>
        </div>
        <router-link :to="{name: 'blog'}" class="btn btn-primary">Torna all'Elenco</router-link>
    </section>
    <Loader v-else/>
</template>

<script>
import Loader from '../components/Loader.vue';

export default {
    name: 'Categories',
    components: {
        Loader
    },
    data: function() {
        return {
            categories: []
        }
    },
    methods: {
        getCategories: function() {
            axios
                .get('http://127.0.0.1:8000/api/categories')
                .then(
                    res => {
                        this.categories = res.data
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
        this.getCategories()
    }
}
</script>

<style>

</style>