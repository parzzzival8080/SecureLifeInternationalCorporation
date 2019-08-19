<template>
    <div>
        <router-view></router-view>
    </div>
</template>
<script src="/js/app.js"></script>
<script>
    export default {
        data(){
            return {
                isLoggedIn : null,
                name : null,
            }
        },
        mounted(){
            this.isLoggedIn = localStorage.getItem('id')
            this.name = localStorage.getItem('name')
        }
    }
</script>
