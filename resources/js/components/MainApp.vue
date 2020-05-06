<template>
    <div>
        <div id="main">
            <Header></Header>
        </div>

        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Header from './Header.vue'
    export default {
        name: 'main-app',
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            Header
        }
    }
</script>
