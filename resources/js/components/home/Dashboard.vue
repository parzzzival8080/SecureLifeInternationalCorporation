<template>
  <v-layout row>
      <v-flex xs12 lg10 md6 offset-md1>
          <v-card>
            <!-- Header -->
              <v-toolbar color="amber darken-3">
                <v-icon color="white" medium>dashboard</v-icon>
                <v-toolbar-title>Dashboard</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-layout>
                  <v-flex xs12>
                    <v-container grid-list-xl>
                        <v-layout row wrap align-start>
                            <v-flex xs12 md4>
                              <v-card color="blue darken-1">
                                  <v-card-text class="text-xs-center">
                                  <p class="display-2 white--text">₱{{totalexit}}.00</p>
                                  <p class="title">Exit Earnings</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md4>
                              <v-card color="cyan darken-1">
                                  <v-card-text class="text-xs-center">
                                  <p class="display-2 white--text">₱{{totalinvite}}.00</p>
                                  <p class="title">Referal Earnings</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md4>
                              <v-card color="teal darken-1">
                                  <v-card-text class="text-xs-center">
                                  <p class="display-2 white--text">₱{{totalearnings}}.00</p>
                                  <p class="title">Total Earnings</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <!-- Bottom -->
                    <v-container grid-list-xl>
                        <v-layout row wrap align-start>
                            <v-flex xs12 md6>
                              <v-card color="red darken-1">
                                  <v-card-text class="text-xs-center">
                                  <p class="display-2 white--text">₱{{totalencash}}.00</p>
                                  <p class="title white--text">Total Encashed</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md6>
                              <v-card color="green darken-1">
                                  <v-card-text class="text-xs-center">
                                  <p class="display-2 white--text">₱{{availableencash}}.00</p>
                                  <p class="title white--text">Available Balance</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                  </v-flex>
                </v-layout>
              </v-card-text>
          </v-card>
      </v-flex>
  </v-layout>
</template>

<script src="/js/app.js"></script>
<script>
  export default {
    data(){
      return {
        totalearnings: '',
        availableencash: '',
        totalencash: '',
        totalinvite: '',
        totalexit: '',
        userID: localStorage.getItem('id')
      }
    },
    methods:{
    },
    created() {
      if (localStorage.getItem('type') == "admin"){
        this.admin = true
      }
      else{
        this.admin =  false
      }
        
      axios.get('api/wallet/getEarnings',
      {
        params:{
          id: this.userID
        }
      })
      .then(response =>{
        this.totalearnings=response.data.totalearnings
        this.availableencash=response.data.availableencash
        this.totalinvite=response.data.totalinvite
        this.totalexit=response.data.totalexit
        this.totalencash=Math.abs(response.data.totalencash)
      })
    },
    
    beforeRouteEnter (to, from, next) {
        if(localStorage.getItem('type') == "admin"){
          return next('/numbers')
        }
        next();
    }
}
</script>
