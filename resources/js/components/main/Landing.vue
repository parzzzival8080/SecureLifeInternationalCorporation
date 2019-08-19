<template>
    <div>
         <!-- Banner -->
        <section>
            <v-container fluid xs12 md12 lg12 ma-0 pa-0>
            <v-carousel height="100%" width="100%" interval="3500" hide-controls hide-delimiters>
                <!-- <v-carousel-item><img src="https://drive.google.com/uc?id=1KL-0tIWo4rbyJpiA4ksUJEJyo5AjFuw1" alt="img"></v-carousel-item>
                <v-carousel-item><img src="https://drive.google.com/uc?id=1GBezlp1C7DHCqYI91PZv6xS_DmzB1_Wl" alt="img"></v-carousel-item>
                <v-carousel-item><img src="https://drive.google.com/uc?id=1YbONJrlNKqzAPB4213-fTXfOyF2IeTji" alt="img"></v-carousel-item>
                <v-carousel-item><img src="https://drive.google.com/uc?id=1ohTdLzktBdO2LqdVmktZfwMtGOzJPp-g" alt="img"></v-carousel-item> -->
                <v-carousel-item><img src="/img/Banner4.5.png" alt="img"></v-carousel-item>
                <v-carousel-item><img src="/img/Banner4.6.png" alt="img"></v-carousel-item>
                <v-carousel-item><img src="/img/Banner4.7.png" alt="img"></v-carousel-item>
                <v-carousel-item><img src="/img/Banner4.8.png" alt="img"></v-carousel-item>
            </v-carousel>
            </v-container>
        </section>
        <!-- Sayings With Icon -->
        <section>
            <v-layout  column wrap class="my-5" align-center>
                <!-- Header -->
                <v-flex xs12 sm4 class="my-3">
                    <div class="text-xs-center">
                        <h2 class="display-3 primary--text">SecureLife International Corporation</h2>
                        <span class="title">We rise by lifting others</span>
                    </div>
                </v-flex>
                <v-flex xs12>
                    <v-container grid-list-xl>
                        <v-layout row wrap align-start>
                            <v-flex xs12 md4>
                            <v-card class="elevation-0 transparent">
                                <v-card-text class="text-xs-center">
                                <v-icon size="60px" class="amber--text text--darken-3">linear_scale</v-icon>
                                </v-card-text>
                                <v-card-title primary-title class="layout justify-center">
                                <div class="headline text-xs-center">It simply first come first earn system. Which allow every one to enjoy commission</div>
                                </v-card-title>
                            </v-card>
                            </v-flex>
                            <v-flex xs12 md4>
                            <v-card class="elevation-0 transparent">
                                <v-card-text class="text-xs-center">
                                <v-icon size="60px" class="amber--text text--darken-3">person_add_disabled</v-icon>
                                </v-card-text>
                                <v-card-title primary-title class="layout justify-center">
                                <div class="headline text-xs-center">No Invite required</div>
                                </v-card-title>
                            </v-card>
                            </v-flex>
                            <v-flex xs12 md4>
                            <v-card class="elevation-0 transparent">
                                <v-card-text class="text-xs-center">
                                <v-icon size="60px" class="amber--text text--darken-3">sort</v-icon>
                                </v-card-text>
                                <v-card-title primary-title class="layout justify-center">
                                <div class="headline text-xs-center">A Perfect auto-fill system lead to all client enjoy earnings with ease and no pressure</div>
                                </v-card-title>
                            </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
            </v-layout>
        </section>

        <!-- Footer -->
        <div id="footer" height="350px" padless absolute style="background: linear-gradient(#FF8F00, #FFC107);">
            <v-flex xs12>
                <v-container grid-list-xl fluid class="hidden-sm-and-down">
                    <v-layout row wrap align-start>
                        <v-flex xs12 md4>
                        <v-card class="elevation-0 transparent">
                            <v-card-text class="subtitle-2">
                                Company Information<br>
                                Tel Nos. :<br>
                                +639 000 0000<br>
                                Email Address :<br>
                                ask@securelifeintlcorp.com<br>
                                Address :<br>
                                Nunez Ext, Zamboanga City, Philippines<br>
                            </v-card-text>
                        </v-card>
                        </v-flex>
                        <v-flex xs12 md4>
                        <v-card class="elevation-0 transparent">
                            <v-card-text class="subtitle-2">
                                Quick Links<br>
                                Home<br>
                                Terms & Conditions<br>
                                Privacy Policy<br>
                                Contact Us<br>
                                About Us<br>
                                Frequently Asked Questions<br>
                            </v-card-text>
                        </v-card>
                        </v-flex>
                        <v-flex xs12 md4>
                        <v-card class="elevation-0 transparent">
                            <v-card-text class="subtitle-2">
                                Send us an email<br>
                                <v-text-field small outline id="email" type="email" label="Email Address" v-model="email" prepend-inner-icon="alternate_email"/>
                                <v-btn medium round outline type="submit" @click="handleSubmit">
                                    Send
                                    <v-icon medium>send</v-icon>
                                </v-btn>
                            </v-card-text>
                        </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-divider></v-divider>
                <!-- Bottom Part -->
                <v-layout row wrap align-start>
                    <v-flex xs12 md12>
                        <v-card class="elevation-0 transparent">
                            <v-card-text class="text-xs-center">
                                <v-btn class="mx-2" href="https://www.facebook.com/securelifeintlcorp" icon>
                                    <v-icon size="22px">fab fa-facebook</v-icon>
                                </v-btn>
                                <v-btn class="mx-2" icon>
                                    <v-icon size="22px">fab fa-twitter</v-icon>
                                </v-btn>
                                <v-btn class="mx-2" icon>
                                    <v-icon size="22px">fab fa-instagram</v-icon>
                                </v-btn>
                                <v-btn class="mx-2" icon>
                                    <v-icon size="22px">fab fa-youtube</v-icon>
                                </v-btn>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                     <v-flex xs12 md12>
                         <v-card class="elevation-0 transparent">
                            <v-card-text class="text-xs-center">
                                <span>&copy; SecureLife International Corporation 2019</span><br>
                                <p>Made With <v-icon class="red--text">favorite</v-icon> by <a href="https://www.dreamersinfo.com" target="_blank">Dreame.rs</a></p>
                            </v-card-text>
                        </v-card>
                     </v-flex>
                </v-layout>
            </v-flex>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                email : "",
            }
        },
        methods : {
            handleSubmit(){
                
            }
        }
    }
</script>
