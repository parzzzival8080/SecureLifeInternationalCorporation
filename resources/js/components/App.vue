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
            this.isLoggedIn = sessionStorage.getItem('id')
            this.name = sessionStorage.getItem('name')
        }
    }
</script>
