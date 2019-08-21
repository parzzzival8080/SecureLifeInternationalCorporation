<template>
    <v-app id="inspire">
        <div class="container-fluid pa-0">
            <v-toolbar  fixed app color="transparent" scroll-off-screen scroll-target="#scrolling-techniques">
            <!-- <v-toolbar-side-icon href="/"></v-toolbar-side-icon> -->
                <v-layout row justify-start align-center>
                    <v-avatar href="/" size="40">
                        <a href="/" style="color: white; text-decoration:none"><img src="img/logo.png" alt="avatar"></a>
                    </v-avatar>
                </v-layout>
                <v-spacer></v-spacer>
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn flat href="/about"><v-icon color="amber darken-3" left>home</v-icon>ABOUT</v-btn>
                    <v-btn flat href="/login" v-show='!this.$parent.isLoggedIn'><v-icon color="amber darken-3" left>assignment_ind</v-icon>LOGIN</v-btn>
                    <v-btn flat href="/register" v-show='!this.$parent.isLoggedIn'><v-icon color="amber darken-3" left>person_add</v-icon>REGISTER</v-btn>
                    <v-btn flat href='dashboard' v-show='this.$parent.isLoggedIn'><v-icon color="amber darken-3" left>dashboard</v-icon>MY DASHBOARD</v-btn>
                    <v-btn flat @click="logout" v-show='this.$parent.isLoggedIn'><v-icon color="amber darken-3" left>exit_to_app</v-icon>LOGOUT</v-btn>
                </v-toolbar-items>
                <v-menu class="hidden-md-and-up" transition="slide-x-reverse-transition">
                    <v-toolbar-side-icon slot="activator"></v-toolbar-side-icon>
                    <v-list dense primary>
                    <v-list-tile ripple="ripple" href="/about">
                        <v-list-tile-content>
                        <v-list-tile-title>ABOUT</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile ripple="ripple" href="/login" v-show='!this.$parent.isLoggedIn'>
                        <v-list-tile-content>
                        <v-list-tile-title>LOGIN</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile ripple="ripple" href="/register" v-show='!this.$parent.isLoggedIn'>
                        <v-list-tile-content>
                        <v-list-tile-title>REGISTER</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile ripple="ripple" href='dashboard' v-show='this.$parent.isLoggedIn'>
                        <v-list-tile-content>
                        <v-list-tile-title>MY DASHBOARD</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile ripple="ripple" @click="logout" v-show='this.$parent.isLoggedIn'>
                        <v-list-tile-content>
                        <v-list-tile-title>LOGOUT</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    </v-list>
                </v-menu>
            </v-toolbar>
            <main class="pt-4 mt-5 pb-0">
            <router-view name="main"></router-view>
            <vue-progress-bar></vue-progress-bar>
            </main>
        </div>
    </v-app>
</template>
<script>
    export default {
        data: () => ({
        }),
        methods:{
            logout(){
                localStorage.clear();
                window.location.replace('/')
            },
            refresh(){
                setTimeout(function()
                {
                    localStorage.clear();
                    window.location.replace('/')
                },30000)
            }
        },
        created(){
            axios.post('api/roles');
            // this.refresh()
            // document.addEventListener('click', this.refresh)
            // document.addEventListener('mousemove', this.refresh)
        }
    }
</script>
