<template>
    <header class="bg-primary">
        <div class="container">
            <nav class="navbar navbar-dark">
                <router-link to="/">WordPress</router-link>
                
                <div>
                    <router-link :to="{name: 'blog'}">Elenco Post</router-link>
                    <router-link :to="{name: 'about'}" class="mx-3">Chi Siamo</router-link>
                    <router-link :to="{name: 'support'}">Supporto</router-link>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;

        div {
            display: flex;
            align-items: center;
        }

        a {
            font-size: 16px;
            color: white;

            &:hover {
                text-decoration: none;
                scale: 1.1;
            }
        }
    }
</style>