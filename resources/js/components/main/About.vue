<template>
    <div>
        <!-- Banner Picure -->
        <section>
            <v-container fluid pa-0>
            <v-img src="img/bg-parallax2.png">
                <v-layout align-center column fill-height justify-center>
                <h1 :class="{'amber--text text--darken-3 display-1 font-weight-thin mb-3 primary--text': $vuetify.breakpoint.smAndDown, 'amber--text text--darken-3 display-3 font-weight-thin mb-3 primary--text': $vuetify.breakpoint.mdAndUp}">Securelife International Corporation</h1>
                <h4 class="amber--text text--darken-3 subheading">We rise by lifting others</h4>
                <!-- <v-btn  :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                    color="amber" bottom center dark round :large="$vuetify.breakpoint.mdAndUp" 
                    :small="$vuetify.breakpoint.smAndDown" href="{{ route('login') }}">
                    Get Started
                </v-btn> -->
                </v-layout>
            </v-img>
            </v-container>
        </section>
        <!-- Sayings With Icon -->
        <section>
            <v-layout column wrap class="my-5" align-center>
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
        <!-- About SecureLife -->
        <section>
            <v-layout column wrap class="my-5" align-center>
                <v-flex xs12 sm4 class="my-3">
                <div class="text-xs-center">
                    <h2 class="display-3 primary--text">About Securelife</h2>
                </div>
                </v-flex>
                <v-flex xs12>
                <div :class="{'title text-xs-center': $vuetify.breakpoint.smAndDown, 'headline text-xs-center': $vuetify.breakpoint.mdAndUp}">
                    SecureLife is registered Multi Level Marketing Company Established in May 2019 based in Zamboanga City<br>The Company is 
                    dedicated to provide great opportunities to everyone.</div>
                </v-flex>
            </v-layout>
        </section>
        <!-- Mission and Vision -->
        <section>
            <v-layout column wrap class="my-5" align-center offset-xs1>
                <v-container grid-list-xl justify-center >
                    <v-layout row wrap>
                        <v-flex xs12 md6 lg6 >
                            <v-card height="250px">
                                <v-card-title class="justify-center">
                                    <span class="display-1 amber--text text--darken-3"> MISSION</span>
                                </v-card-title>
                                <v-card-text :class="{'title text-xs-center': $vuetify.breakpoint.smAndDown, 'headline text-xs-center': $vuetify.breakpoint.mdAndUp}">
                                Securing and Empowering People to achieve their Financial and time Freedom. And to Secure their Life Everyday.
                                </v-card-text>                                           
                            </v-card>
                        </v-flex>
                        <v-flex xs12 md6 lg6>
                        <v-card height="250px">
                            <v-card-title class="justify-center">
                            <span class="display-1 amber--text text--darken-3"> VISION</span>
                            </v-card-title>
                            <v-card-text :class="{'title text-xs-center': $vuetify.breakpoint.smAndDown, 'headline text-xs-center': $vuetify.breakpoint.mdAndUp}">
                            The main goal building a better and Secure financial future.
                            </v-card-text>
                        </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-layout>
        </section>
        <!-- Executive -->
        <section>
            <v-layout column wrap class="my-5 mb-5" align-center>
                <!-- Header -->
                <v-flex xs12 sm4 class="my-3">
                    <div class="text-xs-center">
                    <h2 class="display-2 amber--text text--darken-3">Executive</h2>
                    </div>
                </v-flex>
                <v-flex xs12 lg4 md4 sm4>
                    <v-card class="elevation-0">
                        <!-- Picture -->
                        <v-card-title class="justify-center">
                            <v-avatar size="150px">
                                <img src="img/tops.jpg" alt="Avatar">
                            </v-avatar>
                        </v-card-title>
                        <v-card-text class="text-xs-center">
                            <span class="display-1">President</span>
                        </v-card-text>
                        <v-card-title primary-title class="layout column justify-center">
                            <p class="headline text-xs-center mt-0">Ar-husrhofher Basiri Jadjulie</p>
                            <p class="body-2 text-xs-center mt-1 ">
                                    Being in the industry for 11 years, Ar-husrhofher established himself as a 
                                <br>proof of nothing is impossible. Being Undergraduate and previous Condoctor 
                                <br>and Vendor. This situation never stop him for dreaming Big not just for 
                                <br>himself but for everybody. At his young age he is equipped to spearhead 
                                <br>the Company to a great success.
                            </p>
                        </v-card-title>
                    </v-card>
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