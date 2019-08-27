<template>
  <v-layout row>
      <v-flex xs12 lg10 md6 offset-md1>
          <v-card>
            <!-- Header -->
              <v-toolbar color="amber darken-3">
                <v-icon color="white" medium>device_hub</v-icon>
                <v-toolbar-title>Genealogy</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn v-if="current" fab @click="getReferalTree">
                    <v-icon>trending_up</v-icon>
                </v-btn>
              </v-toolbar>
              <v-card-text pa-0 ma-0> 
                <v-img v-if="Bronze" class="white--text" size="100%" :src="imagesrc">
                    <v-container fill-height fluid pa-0 ma-0>
                        <v-layout fill-height pa-0 ma-0>
                        <v-flex xs12 align-end flexbox>
                            <v-layout pa-0 ma-0>
                                <v-flex xs12>
                                    <v-container  :grid-list-xl="$vuetify.breakpoint.mdAndUp" :grid-list-xs="$vuetify.breakpoint.smAndDown">
                                        <v-layout row wrap align-center justify-center>
                                            <v-flex :class="{'xs5 md5': $vuetify.breakpoint.smAndDown, 'xs3 md3': $vuetify.breakpoint.mdAndUp}">
                                                <v-layout row wrap align-center justify-center>
                                                    <v-flex xs6 md6>
                                                        <v-card color="amber darken-3" @click="InfoDialog(genealogies[0]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[0]['code'] !=='None'" :src="genealogies[0]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[0]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                    <v-container  :grid-list-xl="$vuetify.breakpoint.mdAndUp" :grid-list-xs="$vuetify.breakpoint.smAndDown">
                                        <v-layout row wrap align-start>
                                            <v-flex xs6 md6>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex xs12 md12>
                                                        <v-layout row wrap align-center justify-center>
                                                                <v-flex  :class="{'xs5 md5': $vuetify.breakpoint.smAndDown, 'xs3 md3': $vuetify.breakpoint.mdAndUp}">
                                                                    <v-card :color="changecolor(genealogies[1]['type'])" @click="InfoDialog(genealogies[1]['id'],genealogies[0]['code'],'Left')">
                                                                        <v-card-text class="text-xs-center">
                                                                        <v-avatar :size="profilesize">
                                                                            <img v-if="genealogies[1]['code'] !=='None'" :src="genealogies[1]['photo'] " alt="alt">
                                                                            <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">       
                                                                        </v-avatar>
                                                                        <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[1]['code'] }}</p>
                                                                        </v-card-text>
                                                                    </v-card>
                                                                </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs6 md6>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex xs12 md12>
                                                        <v-layout row wrap align-center justify-center>
                                                                <v-flex  :class="{'xs5 md5': $vuetify.breakpoint.smAndDown, 'xs3 md3': $vuetify.breakpoint.mdAndUp}">
                                                                    <v-card :color="changecolor(genealogies[2]['type'])" @click="InfoDialog(genealogies[2]['id'], genealogies[0]['code'],'Right')">
                                                                        <v-card-text class="text-xs-center">
                                                                        <v-avatar :size="profilesize">
                                                                            <img v-if="genealogies[2]['code'] !=='None'" :src="genealogies[2]['photo'] " alt="alt">
                                                                            <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                                        </v-avatar>
                                                                        <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[2]['code'] }}</p>
                                                                        </v-card-text>
                                                                    </v-card>
                                                                </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                    <v-container  :grid-list-xl="$vuetify.breakpoint.mdAndUp" :grid-list-xs="$vuetify.breakpoint.smAndDown">
                                        <v-layout row wrap align-start>
                                            <v-flex xs3 md3>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex  :class="{'xs10 md10': $vuetify.breakpoint.smAndDown, 'xs6 md6': $vuetify.breakpoint.mdAndUp}">
                                                        <v-card :color="changecolor(genealogies[3]['type'])" @click="InfoDialog(genealogies[3]['id'], genealogies[1]['code'],'Left')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[3]['code'] !=='None'" :src="genealogies[3]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[3]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex  :class="{'xs10 md10': $vuetify.breakpoint.smAndDown, 'xs6 md6': $vuetify.breakpoint.mdAndUp}">
                                                        <v-card :color="changecolor(genealogies[4]['type'])" @click="InfoDialog(genealogies[4]['id'], genealogies[1]['code'],'Right')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[4]['code'] !=='None'" :src="genealogies[4]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[4]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex  :class="{'xs10 md10': $vuetify.breakpoint.smAndDown, 'xs6 md6': $vuetify.breakpoint.mdAndUp}">
                                                        <v-card :color="changecolor(genealogies[5]['type'])" @click="InfoDialog(genealogies[5]['id'], genealogies[2]['code'],'Left')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[5]['code'] !=='None'" :src="genealogies[5]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[5]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex  :class="{'xs10 md10': $vuetify.breakpoint.smAndDown, 'xs6 md6': $vuetify.breakpoint.mdAndUp}">
                                                        <v-card :color="changecolor(genealogies[6]['type'])" @click="InfoDialog(genealogies[6]['id'], genealogies[2]['code'],'Right')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[6]['code'] !=='None'" :src="genealogies[6]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[6]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                    <v-container  :grid-list-xl="$vuetify.breakpoint.mdAndUp" :grid-list-xs="$vuetify.breakpoint.smAndDown" class="hidden-sm-and-down">
                                        <v-layout row wrap align-start>
                                            <v-flex xs3 md3>
                                                <v-layout row wrap align-start>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[7]['type'])" @click="InfoDialog(genealogies[7]['id'], genealogies[3]['code'],'Left')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[7]['code'] !=='None'" :src="genealogies[7]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[7]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[8]['type'])" @click="InfoDialog(genealogies[8]['id'], genealogies[3]['code'],'Right')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[8]['code'] !=='None'" :src="genealogies[8]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[8]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                                <v-layout row wrap align-start>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[9]['type'])" @click="InfoDialog(genealogies[9]['id'], genealogies[4]['code'],'Left')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[9]['code'] !=='None'" :src="genealogies[9]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[9]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[10]['type'])" @click="InfoDialog(genealogies[10]['id'], genealogies[4]['code'],'Right')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[10]['code'] !=='None'" :src="genealogies[10]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[10]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                                <v-layout row wrap align-start>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[11]['type'])" @click="InfoDialog(genealogies[11]['id'], genealogies[5]['code'],'Left')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[11]['code'] !=='None'" :src="genealogies[11]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[11]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[12]['type'])" @click="InfoDialog(genealogies[12]['id'], genealogies[5]['code'],'Right')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[12]['code'] !=='None'" :src="genealogies[12]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[12]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                                <v-layout row wrap align-start>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[13]['type'])" @click="InfoDialog(genealogies[13]['id'], genealogies[6]['code'],'Left')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[13]['code'] !=='None'" :src="genealogies[13]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                            <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[13]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[14]['type'])" @click="InfoDialog(genealogies[14]['id'], genealogies[6]['code'],'Right')">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img v-if="genealogies[14]['code'] !=='None'" :src="genealogies[14]['photo'] " alt="alt">
                                                                <img v-else src="https://res.cloudinary.com/tim0923/image/upload/v1566806195/SecureLife/profile_pictures/32360_g0xnk9.svg" alt="alt">
                                                            </v-avatar>
                                                             <p :class="{'phonesize ma-0 pa-0': $vuetify.breakpoint.smAndDown, 'subtitle-2 ma-0 pa-0': $vuetify.breakpoint.mdAndUp}">{{ genealogies[14]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        </v-layout>
                    </v-container>
                    <!-- Profile Dialog -->
                    <v-layout row justify-center>
                        <v-dialog v-model="ProfileDialog" persistent max-width="600px">
                            <v-card>
                                <v-card-title :class="{'body-1': $vuetify.breakpoint.smAndDown, 'headline': $vuetify.breakpoint.mdAndUp}">Account Information
                                    <v-spacer></v-spacer>
                                    <v-btn small fab @click="ProfileDialog=false">
                                    <v-icon>close</v-icon>
                                    </v-btn>
                                </v-card-title>
                                <v-card-text>
                                    <v-container  :grid-list-xl="$vuetify.breakpoint.mdAndUp" :grid-list-xs="$vuetify.breakpoint.smAndDown">
                                            <v-layout row wrap align-start>
                                                <v-flex xs12 md6>
                                                <v-layout row wrap align-center justify-center>
                                                        <v-flex xs12 md12>
                                                            <v-avatar size="250px">
                                                                <img :src="genealogiesInfo.photo" alt="alt">
                                                            </v-avatar>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                <v-layout row wrap align-center justify-center>
                                                        <v-flex xs12 md12>
                                                            <v-layout column wrap align-start>
                                                                    <p>{{genealogiesInfo.code}}</p>
                                                                    <p>{{genealogiesInfo.name}}</p>
                                                                    <p>{{genealogiesInfo.email}}</p>
                                                                    <!-- <p>{{genealogiesInfo.downline.left}}</p>
                                                                    <p>{{genealogiesInfo.downline.right}}</p> -->
                                                            </v-layout>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn primary flat @click="retrieveGenealogyTree(genealogiesInfo.id);">Genealogy Tree</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-layout>
                    <!-- Add new Bronze Dialog -->
                    <v-layout row justify-center>
                        <v-dialog v-model="NewDialog" persistent max-width="600px">
                            <v-card flat>
                                <v-card-title :class="{'body-1': $vuetify.breakpoint.smAndDown, 'headline': $vuetify.breakpoint.mdAndUp}">New Account
                                    <v-spacer></v-spacer>
                                    <v-btn small fab @click="NewDialog=false">
                                    <v-icon>close</v-icon>
                                    </v-btn>
                                </v-card-title>
                                <v-card-text>
                                    <v-form>
                                        <v-container grid-list-sm bt-0>
                                            <!-- Name -->
                                            <v-layout row wrap>
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent id="lname" type="text" label="Last Name" v-model="lastname" required autofocus prepend-inner-icon="account_circle"/>
                                                        </v-flex>
                                                        <v-flex xs12 md5>
                                                            <v-text-field outline small transparent id="fname" type="text" label="First Name" v-model="firstname" required />
                                                        </v-flex>
                                                        <v-flex xs12 md1>
                                                            <v-text-field outline small transparent id="mi" type="text" label="M.I" v-model="mi" />
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Password -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline small transparent  id="password" :type="show1 ? 'text' : 'password'" @click:append="show1 = !show1" :append-icon="show1 ? 'visibility' : 'visibility_off'" label="Password" v-model="password" required prepend-inner-icon="lock"/>
                                                </v-flex>
                                                <!-- Confirm Password -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline small transparent  id="password-confirm" :type="show2 ? 'text' : 'password'" @click:append="show2 = !show2" :append-icon="show2 ? 'visibility' : 'visibility_off'" label="Confirm Password" v-model="password_confirmation" required prepend-inner-icon="lock"/>
                                                </v-flex>
                                                <!-- Address -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline small transparent  id="address" type="text" label="Address" v-model="address" required prepend-inner-icon="location_on"/>
                                                </v-flex>
                                                <!-- Email and Contact -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent  id="email" type="email" label="Email Address" v-model="email" required prepend-inner-icon="alternate_email"/>
                                                        </v-flex>

                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent  id="contactno" type="text" label="Contact Number" v-model="contact" required prepend-inner-icon="phone" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Birthdate and Sponsor Id -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent  id="sponsor" type="text" label="Sponsor" v-model="sponsor" required disabled prepend-inner-icon="group_add"/>
                                                        </v-flex>
                                                        
                                                        <v-flex xs12 md6>
                                                            <v-dialog ref="dialogfrom" v-model="modal" :return-value.sync="birthdate" persistent lazy full-width width="290px">
                                                                <template v-slot:activator="{ on }">
                                                                    <v-text-field outline small transparent  v-model="birthdate" label="Birthdate" prepend-inner-icon="event" v-on="on"></v-text-field>
                                                                </template>
                                                                <v-date-picker v-model="birthdate" scrollable>
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                                                                    <v-btn flat color="primary" @click="$refs.dialogfrom.save(birthdate)">OK</v-btn>
                                                                </v-date-picker>
                                                            </v-dialog>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Placement ID and Position -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent  id="placement" type="text" label="Placement-ID" v-model="placement" disabled required prepend-inner-icon="device_hub"/>
                                                        </v-flex>

                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent  id="position" type="text" label="Position" v-model="position" disabled required prepend-inner-icon="code"/>
                                                                <!-- <v-select :items="items" label="Outline small transparent style" outline small transparent  required prepend-inner-icon="code"></v-select> -->
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                       <!-- Pin Code -->
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent  id="sponsor" type="text" label="Pin Code" v-model="sponsor" required prepend-inner-icon="dialpad"/>
                                                        </v-flex>
                                                        <!-- Activation Code -->
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline small transparent  id="sponsor" type="text" label="Activitaion Code" v-model="sponsor" required prepend-inner-icon="dialpad"/>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                        <v-flex xs12 md12>
                                            <v-btn large round outline small transparent  type="submit" color="amber darken-3" @click=""> Register</v-btn>
                                        </v-flex>
                                    </v-form>
                                </v-card-text>
                            </v-card>
                        </v-dialog>
                    </v-layout>
                </v-img>
                <!-- Else if Account is not Bronze -->
                <v-layout v-else xs12 md10 lg10 justify-center>
                    <v-card width="600px">
                        <v-toolbar color="amber darken-3">
                            <v-icon color="white" medium>lock</v-icon>
                            <v-toolbar-title>Unlock Bronze Account</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <v-form>
                                <v-container grid-list-sm bt-0>
                                    <!-- Pin Code -->
                                    <v-flex xs12 md12>
                                        <v-text-field outline small transparent  id="sponsor" type="text" label="Pin Code" v-model="sponsor" required prepend-inner-icon="dialpad"/>
                                    </v-flex>
                                     <!-- Activation Code -->
                                    <v-flex xs12 md12>
                                        <v-text-field outline small transparent  id="sponsor" type="text" label="Activitaion Code" v-model="sponsor" required prepend-inner-icon="dialpad"/>
                                    </v-flex>
                                     <!-- Sponsor ID -->
                                    <v-flex xs12 md12>
                                        <v-text-field outline small transparent id="sponsor" type="text" label="Sponsor" v-model="sponsor" disabled required prepend-inner-icon="group_add"/>
                                    </v-flex>
                                    <!-- Placement ID and Position -->
                                    <v-flex xs12 md12>
                                        <v-layout row wrap>
                                            <v-flex xs12 md6>
                                                <v-text-field outline small transparent id="placement" type="text" label="Placement-ID" v-model="email" disabled required prepend-inner-icon="device_hub"/>
                                            </v-flex>

                                            <v-flex xs12 md6>
                                                <v-select outline small transparent id="position" label="Position" :items="items" disabled required prepend-inner-icon="code"/>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>

                                    <v-flex xs12 md12>
                                        <v-btn large round outline small transparent type="submit" color="amber darken-3">Unlock Bronze</v-btn>
                                    </v-flex>
                                </v-container>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-layout>
              </v-card-text>
          </v-card>
      </v-flex>
  </v-layout>
</template>

<script src="/js/app.js"></script>
<script>
  export default {
    data: () => ({
        genealogies: [],
        genealogiesInfo: [],
        name : "",
        lastname : "",
        firstname : "",
        mi : "",
        email : "",
        password : "",
        password_confirmation : "",
        address: "",
        sponsor: sessionStorage.getItem('code'), //who invited this user
        contact: "(+63)",
        birthdate: "",
        position: '',
        placement: '',
        show1: false, //hide password text
        show2: false, //hide confirm password text
        modal: false, //for birthday modal
        Bronze: true,
        items: ['Left', 'Right'],
        ProfileDialog: false,
        NewDialog: false,
        current_layer: sessionStorage.getItem('id'),

    }),

    computed: {
      imagesrc () {
        switch (this.$vuetify.breakpoint.name) {
          case 'xs': return 'https://res.cloudinary.com/tim0923/image/upload/v1565863389/svg/Lines_Mobile_lmh91l.svg'
          case 'sm': return 'https://res.cloudinary.com/tim0923/image/upload/v1565860306/svg/Lines_Tablet_mmvo76.svg'
          case 'md': return 'https://res.cloudinary.com/tim0923/image/upload/v1565847646/svg/Lines_ertkbj.svg'
          case 'lg': return 'https://res.cloudinary.com/tim0923/image/upload/v1565862452/svg/Lines_Laptop_tgfmjx.svg'
          case 'xl': return 'https://res.cloudinary.com/tim0923/image/upload/v1565862603/svg/Lines_qennnz.svg'
        }
      },
      profilesize () {
        switch (this.$vuetify.breakpoint.name) {
          case 'xs': return '2em'
          case 'sm': return '4em'
          case 'md': return '7em'
          case 'lg': return '7em'
          case 'xl': return '7em'
        }
      },
      current(){
        if (this.current_layer == sessionStorage.getItem('id')){
            return false
        }
        else{
            return true
        }
      },
      
    },
    
    methods:{
        retrieveGenealogyInformation(user_id) {
            axios.get('/api/bronze/genealogy/information', {params: {user_id: user_id}})
            .then(response => {
                var data = response.data
                this.genealogiesInfo = data
            })
            .catch(response => {
                console.log(response)
            })
        },

        retrieveGenealogyTree(user_id) {
            this.ProfileDialog = false;
            axios.get('/api/bronze/genealogy', {params: {user_id: user_id}})
            .then(response => {
                var data = response.data
                this.genealogies = data.genealogy_tree
                this.current_layer = user_id
            })
            .catch(response => {
                console.log(response)
            })
        },
        getReferalTree(){
            this.retrieveGenealogyTree(this.genealogiesInfo.reference);
            this.retrieveGenealogyInformation(this.genealogiesInfo.reference);
            this.current_layer(this.genealogiesInfo.reference);
            

        },
        changecolor (details) {
            if (details == "None"){
                return 'grey darken-3'
            }
            else if(details == "active"){
                return 'amber darken-3'
            }
            else if(details == "cd"){
                return 'red darken-3'
            }
            else{
                return 'blue darken-3'
            }
       },
       InfoDialog(id, reference, position){
           if (id =='None') {
               if (reference !== 'None') {
                   this.placement = reference
                   this.position = position
                   this.NewDialog = true
               }
           } else {
               this.retrieveGenealogyInformation(id)
               this.ProfileDialog = true
           }
       },
    },

    created() {
        this.retrieveGenealogyTree(sessionStorage.getItem('id'));
        this.retrieveGenealogyInformation(sessionStorage.getItem('id'));

        if (sessionStorage.getItem('type') == "admin"){
          this.admin = true
        }
        else{
          this.admin =  false
        }
        
    },
    
    beforeRouteEnter (to, from, next) {
        if(sessionStorage.getItem('type') == "admin"){
          return next('/numbers')
        }
        next();
    }
}
</script>
