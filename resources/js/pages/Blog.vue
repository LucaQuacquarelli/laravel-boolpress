<template>
    <section>
        <h1>Elenco Post</h1>
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
</template>

<script>
import PostCard from '../components/PostCard.vue'
export default {
    name : 'App',
    components: {
        PostCard
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