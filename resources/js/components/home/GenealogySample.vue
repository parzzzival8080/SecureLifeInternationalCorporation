<template>
  <v-layout row>
      <v-flex xs12 lg10 md6 offset-md1>
          <v-card>
            <!-- Header -->
              <v-toolbar color="amber darken-3">
                <v-icon color="white" medium>device_hub</v-icon>
                <v-toolbar-title>Genealogy</v-toolbar-title>
                <v-spacer></v-spacer>
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
                                                        <v-card color="amber darken-3" @click="passID(genealogies[0]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[0]['code'] }}</p>
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
                                                                    <v-card :color="changecolor(genealogies[1]['type'])" @click="passID(genealogies[1]['id'])">
                                                                        <v-card-text class="text-xs-center">
                                                                        <v-avatar :size="profilesize">
                                                                            <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                                        </v-avatar>
                                                                        <p class="subtitle-2 ma-0 pa-0">{{ genealogies[1]['code'] }}</p>
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
                                                                    <v-card :color="changecolor(genealogies[2]['type'])" @click="passID(genealogies[2]['id'])">
                                                                        <v-card-text class="text-xs-center">
                                                                        <v-avatar :size="profilesize">
                                                                            <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                                        </v-avatar>
                                                                        <p class="subtitle-2 ma-0 pa-0">{{ genealogies[2]['code'] }}</p>
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
                                                        <v-card :color="changecolor(genealogies[3]['type'])" @click="passID(genealogies[3]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[3]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex  :class="{'xs10 md10': $vuetify.breakpoint.smAndDown, 'xs6 md6': $vuetify.breakpoint.mdAndUp}">
                                                        <v-card :color="changecolor(genealogies[4]['type'])" @click="passID(genealogies[4]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[4]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex  :class="{'xs10 md10': $vuetify.breakpoint.smAndDown, 'xs6 md6': $vuetify.breakpoint.mdAndUp}">
                                                        <v-card :color="changecolor(genealogies[5]['type'])" @click="passID(genealogies[5]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[5]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex  :class="{'xs10 md10': $vuetify.breakpoint.smAndDown, 'xs6 md6': $vuetify.breakpoint.mdAndUp}">
                                                        <v-card :color="changecolor(genealogies[6]['type'])" @click="passID(genealogies[6]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[6]['code'] }}</p>
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
                                                        <v-card :color="changecolor(genealogies[7]['type'])" @click="passID(genealogies[7]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[7]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[8]['type'])" @click="passID(genealogies[8]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[8]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                                <v-layout row wrap align-start>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[9]['type'])" @click="passID(genealogies[9]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[9]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[10]['type'])" @click="passID(genealogies[10]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[10]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                                <v-layout row wrap align-start>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[11]['type'])" @click="passID(genealogies[11]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[11]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[12]['type'])" @click="passID(genealogies[12]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[12]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs3 md3>
                                                <v-layout row wrap align-start>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[13]['type'])" @click="passID(genealogies[13]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[13]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[14]['type'])" @click="passID(genealogies[14]['id'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[14]['code'] }}</p>
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
                </v-img>
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
                                        <v-text-field outline id="sponsor" type="text" label="Pin Code" v-model="sponsor" required prepend-inner-icon="dialpad"/>
                                    </v-flex>
                                     <!-- Activation Code -->
                                    <v-flex xs12 md12>
                                        <v-text-field outline id="sponsor" type="text" label="Activitaion Code" v-model="sponsor" required prepend-inner-icon="dialpad"/>
                                    </v-flex>
                                     <!-- Sponsor ID -->
                                    <v-flex xs12 md12>
                                        <v-text-field outline id="sponsor" type="text" label="Sponsor" v-model="sponsor" required prepend-inner-icon="group_add"/>
                                    </v-flex>
                                    <!-- Placement ID and Position -->
                                    <v-flex xs12 md12>
                                        <v-layout row wrap>
                                            <v-flex xs12 md6>
                                                <v-text-field outline id="placement" type="text" label="Placement-ID" v-model="email" required prepend-inner-icon="device_hub"/>
                                            </v-flex>

                                            <v-flex xs12 md6>
                                                <v-select outline id="position" label="Position" :items="items" required prepend-inner-icon="code"/>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>

                                    <v-flex xs12 md12>
                                        <v-btn large round outline type="submit" color="amber darken-3">Unlock Bronze</v-btn>
                                    </v-flex>
                                </v-container>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-layout>
                <v-layout row justify-center>
                    <v-dialog v-model="ProfileDialog" persistent max-width="600px">
                        <v-card>
                            <v-card-title class="headline">Account Information
                                
                                <v-spacer></v-spacer>
                                <v-btn small fab @click="ProfileDialog=false">
                                <v-icon>close</v-icon>
                                </v-btn>
                            </v-card-title>
                            <v-card-text>
                                <v-container  :grid-list-xl="$vuetify.breakpoint.mdAndUp" :grid-list-xs="$vuetify.breakpoint.smAndDown">
                                        <v-layout row wrap align-start>
                                            <v-flex xs6 md6>
                                            <v-layout row wrap align-center justify-center>
                                                    <v-flex xs12 md12>
                                                        <v-avatar size="250px">
                                                            <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                        </v-avatar>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex xs6 md6>
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
        sponsor: '',
        email: '',
        Bronze: true,
        items: ['Left', 'Right'],
        ProfileDialog: false,
        current_ID: '',
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
          case 'md': return '50px'
          case 'lg': return 'https://res.cloudinary.com/tim0923/image/upload/v1565862603/svg/Lines_qennnz.svg'
          case 'xl': return 'https://res.cloudinary.com/tim0923/image/upload/v1565862603/svg/Lines_qennnz.svg'
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
                console.log(this.genealogies)
            })
            .catch(response => {
                console.log(response)
            })
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
       passID(id){
           this.retrieveGenealogyInformation(id)
           this.ProfileDialog = true
       },
    },

    created() {
        this.retrieveGenealogyTree(sessionStorage.getItem('id'));

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
