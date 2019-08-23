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
                                                        <v-card color="amber darken-3">
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
                                                                    <v-card :color="changecolor(genealogies[1]['code'])">
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
                                                                    <v-card :color="changecolor(genealogies[2]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[3]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[4]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[5]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[6]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[7]['code'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[7]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[8]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[9]['code'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[9]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[10]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[11]['code'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[11]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[12]['code'])">
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
                                                        <v-card :color="changecolor(genealogies[13]['code'])">
                                                            <v-card-text class="text-xs-center">
                                                            <v-avatar :size="profilesize">
                                                                <img src="https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png" alt="alt">
                                                            </v-avatar>
                                                            <p class="subtitle-2 ma-0 pa-0">{{ genealogies[13]['code'] }}</p>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs6 md6>
                                                        <v-card :color="changecolor(genealogies[14]['code'])">
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
              </v-card-text>
          </v-card>
      </v-flex>
  </v-layout>
</template>

<script src="/js/app.js"></script>
<script>
  export default {
    data: () => ({
        genealogies: '',
        sponsor: '',
        email: '',
        Bronze: true,
        items: ['Left', 'Right']
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
        retrieveGenealogyTree() {
            axios.get('/api/bronze/genealogy', {params: {user_id: localStorage.getItem('id')}})
            .then(response => {
                this.genealogies = response.data.genealogy_tree
                // console.log(this.genealogies)
            })
            .catch(response => {
                console.log(response)
            })
        },
        changecolor (details) {
        if (details == "None"){
          return 'grey darken-3'
        }
        else{
          return 'amber darken-3'
        }
      },
    },

    created() {
        this.retrieveGenealogyTree();

        if (localStorage.getItem('type') == "admin"){
          this.admin = true
        }
        else{
          this.admin =  false
        }
        
    },
    
    beforeRouteEnter (to, from, next) {
        if(localStorage.getItem('type') == "admin"){
          return next('/numbers')
        }
        next();
    }
}
</script>
