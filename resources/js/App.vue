<template>
    <div>    
        <Header/>
        <main class="container">

        </main>
        <Footer/>
    </div>
</template>

<script>
import Header from './components/partials/Header.vue'
import Footer from './components/partials/Footer.vue'
export default {
    name : 'App',
    components: {
        Header,
        Footer
    },
    data: function() {
        return {
            posts: [],
            current_page: 1,
            last_page: 1,
        }
    },
    methods: {
        getPost: function(page = 1) {
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
        this.getPost()
    }

}
</script>

<style>

</style>