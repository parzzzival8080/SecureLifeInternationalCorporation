<template>
    <v-layout row>
        <v-layout xs12 md10 lg10 justify-center>
            <v-card width="600px" :class="{'my-5': $vuetify.breakpoint.mdAndUp}">
                <v-toolbar height="150px" column>
                        <v-img src="img/banner.png"></v-img>
                        <v-icon large>assignment_ind</v-icon>
                        <v-toolbar-title>Login</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <!-- Form -->
                    <v-form>
                        <!-- Username -->
                        <v-flex xs12 md12>
                            <v-text-field outline id="username" type="text" label="Username" v-model="username" required prepend-inner-icon="account_circle" autofocus/>
                        </v-flex>
                        <!-- Password -->
                        <v-flex xs12 md12>
                            <v-text-field outline id="password" :type="show1 ? 'text' : 'password'" @click:append="show1 = !show1" :append-icon="show1 ? 'visibility' : 'visibility_off'" label="Password" v-model="password"  required prepend-inner-icon="lock"/>
                        </v-flex>

                        <v-flex xs12 md12>
                            <v-btn large round outline type="submit" color="amber darken-3" @click="handleSubmit"> Login</v-btn>
                        </v-flex>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-layout>
    </v-layout>
</template>
<script>
    export default {
        data(){
            return {
                username : "",
                password : "",
                show1: false,
            }
        },
        methods : {
            handleSubmit(e){
                e.preventDefault()
                this.$Progress.start();
                if (this.password.length > 0) {
                    axios.post('api/user/login', {
                    username: this.username,
                    password: this.password
                    })
                    // For Dashboard Purpose
                    .then(response => {
                        if (response.data.success){
                                sessionStorage.setItem('id',response.data.success.id)
                                sessionStorage.setItem('type',response.data.success.type)
                                sessionStorage.setItem('photo',response.data.success.photo)
                                sessionStorage.setItem('name',response.data.success.name)
                                sessionStorage.setItem('code',response.data.success.code)
                                sessionStorage.setItem('status',response.data.success.status)

                            if (sessionStorage.getItem('id') != null){
                                this.$Progress.finish();
                                this.$router.go('/dashboard')
                            }
                        }
                        else{
                            this.$Progress.fail();
                            swal.fire("Failed!",
                            "Incorrect Username/Password",
                            "error")
                        }
                    })
                    .catch(function (error) {
                        this.$Progress.fail();
                        swal.fire("Failed!",
                        "Incorrect Username/Password",
                        "error")
                    });
                }
            }
        },
        beforeRouteEnter (to, from, next) { 
            if (sessionStorage.getItem('id')) {
                return next('dashboard');
            }

            next();
        }
    }
</script>