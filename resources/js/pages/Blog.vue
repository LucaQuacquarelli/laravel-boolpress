<template>
    <section v-if="posts.length > 0">
        <div class="d-flex justify-content-between">
            <h1>Elenco Post</h1>
            <router-link :to="{name: 'categories'}" class="btn btn-primary align-self-center">Categorie</router-link>
        </div>
        <div class="post-container d-flex">
            <div class="btn btn-primary align-self-center prev" v-show="current_page > 1" @click="getPosts(current_page - 1)">
                <span>PREV</span>
            </div>
            <div class="d-flex flex-wrap">
                <PostCard v-for="post in posts" :key="post.id"
                :post="post"/>
            </div>
            <div class="btn btn-primary align-self-center next" v-show="current_page < last_page" @click="getPosts(current_page + 1)">
                <span>NEXT</span>
            </div>
        </div>
    </section>
    <Loader v-else/>
</template>

<script>
import Loader from '../components/Loader.vue';
import PostCard from '../components/PostCard.vue'
export default {
    name : 'App',
    components: {
        PostCard,
        Loader
    },
    data: function() {
        return {
            posts: [],
            current_page: 1,
            last_page: 1,
        }
    },
    methods: {
        getPosts: function(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then(
                    res => {
                        this.posts = res.data.data;
                        this.current_page = res.data.current_page;
                        this.last_page = res.data.last_page;
                        this.posts.forEach(
                            element => {
                                element.excerpt = this.excerpt(element.content, 150);
                            }
                        );
                    }
                )
                .catch(
                    err => {
                    console.log(err);
                }
            );
        },
        excerpt: function(string, charsNumber = 100) {
            if(string.length > charsNumber) {
                return string.substr(0, charsNumber) + '...';
            } else {
                return string;
            }
        },
    },
    created: function() {
        this.getPosts()
    }

}
</script>

<style lang="scss" scoped>

</style>