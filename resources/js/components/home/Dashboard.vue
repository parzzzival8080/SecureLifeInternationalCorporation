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
                <!-- For Diamond -->
                <v-layout v-if="!Bronze">
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
                <!-- For Bronze -->
                <v-layout v-if="Bronze">
                  <v-flex xs12>
                    <v-container grid-list-xl>
                        <v-layout row wrap align-start>
                            <v-flex xs12 md4>
                              <v-card color="blue darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Total Reward For Bronze Here -->
                                  <p class="display-2 white--text">₱{{match_earnings}}.00</p>
                                  <p class="title">Match Earnings</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md4>
                              <v-card color="cyan darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Total Referal Reward Here -->
                                  <p class="display-2 white--text">₱{{referal_earnings}}.00</p>
                                  <p class="title">Referal Earnings</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md4>
                              <v-card color="teal darken-1">
                                  <v-card-text class="text-xs-center">
                                    <!-- Insert Total Earnings Here -->
                                  <p class="display-2 white--text">₱{{total_earnings}}.00</p>
                                  <p class="title">Total Earnings</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <!-- 2nd Layer -->
                    <v-container grid-list-xl>
                        <v-layout row wrap align-start>
                            <v-flex xs12 md6>
                              <v-card color="red darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Total Encashed -->
                                  <p class="display-2 white--text">₱{{total_encashed}}.00</p>
                                  <p class="title white--text">Total Encashed</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md6>
                              <v-card color="green darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Total Balance -->
                                  <p class="display-2 white--text">₱{{total_balance}}.00</p>
                                  <p class="title white--text">Available Balance</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <!-- 3rd Layer -->
                    <v-container grid-list-xl>
                      <v-layout row wrap align-start>
                            <v-flex xs12 md6>
                              <v-card color="deep-orange darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Match Count -->
                                  <p class="display-2 white--text">{{match_count}}</p>
                                  <p class="title white--text">Match Count</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md6>
                              <v-card color="light-green darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Product Points Here -->
                                  <p class="display-2 white--text">{{product_points}}</p>
                                  <p class="title white--text">Product Points</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <!-- 4th Layer -->
                    <v-container grid-list-xl>
                      <v-layout row wrap align-start>
                            <v-flex xs12 md6>
                              <v-card color="amber darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Left Downline -->
                                  <p class="display-2 white--text">{{left_downline}}</p>
                                  <p class="title white--text">Left Downline</p>
                                  </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md6>
                              <v-card color="grey darken-1">
                                  <v-card-text class="text-xs-center">
                                  <!-- Insert Right Downline -->
                                  <p class="display-2 white--text">{{right_downline}}</p>
                                  <p class="title white--text">Right Downline</p>
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
        match_earnings: 0,
        referal_earnings: 0,
        total_earnings: 0,
        total_encashed: 0,
        total_balance: 0,
        match_count: 0,
        product_points: 0,
        left_downline: 0,
        right_downline: 0,
        

        totalearnings: '',
        Bronze: true,
        availableencash: '',
        totalencash: '',
        totalinvite: '',
        totalexit: '',
        userID: localStorage.getItem('id')
      }
    },
    methods:{
      retrieveBronzeDashboard() {
        axios.get('/api/bronze/dashboard', {params: {user_id: localStorage.getItem('id')}})
        .then(response => {
          var data = response.data
          this.match_earnings = data.match_earnings
          this.referal_earnings = data.referal_earnings
          this.total_earnings = data.total_earnings
          this.total_encashed = data.total_encashed
          this.total_balance = data.total_balance
          this.match_count = data.match_count
          this.product_points = data.product_points
          this.left_downline = data.left_downline
          this.right_downline = data.right_downline
          console.log(data)
        })
        .catch(response => {
          console.log(response)
        })
      },
    },
    created() {
      this.retrieveBronzeDashboard()

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
