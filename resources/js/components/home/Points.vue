<template>
  <v-layout row>
    <v-flex xs12 lg10 md6 offset-md1>
      <v-card>
        <v-toolbar color="amber darken-3">
          <v-icon color="white" medium>fas fa-coins</v-icon>
          <v-toolbar-title>Points</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <v-layout justify-center align-center>
            <v-flex xs12>
              <v-container grid-list-xl>
                <v-layout row wrap align-start>
                  <v-flex xs12 md12>
                    <v-card>
                      <v-card-text class="text-xs-center">
                        <p class="display-2 white--text">Incentive Points</p>
                         <v-layout row wrap align-start>
                            <v-flex xs12 md12>
                              <v-card color="teal darken-1">
                                <v-card-text class="text-xs-center">
                                  <!-- Insert Current Mont Maintaenance Balance Here -->
                                  <p class="display-2 white--text">{{incentives_points}}</p>
                                  <p class="title">Incentive Points</p>
                                </v-card-text>
                              </v-card>
                            </v-flex>
                          </v-layout>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-container grid-list-xl>
                <v-layout row wrap align-start>
                  <v-flex xs12 md12>
                    <v-card>
                      <v-card-text class="text-xs-center">
                        <p class="display-2 white--text">Group Sales Points</p>
                         <v-layout row wrap align-start>
                            <v-flex xs12 md6>
                              <v-card color="cyan darken-2">
                                <v-card-text class="text-xs-center">
                                  <!-- Insert Incentive Points Here -->
                                  <p class="display-2 white--text">{{left_group_sales_points}}</p>
                                  <p class="title">Left GS Points</p>
                                </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md6>
                              <v-card color="teal darken-2">
                                <v-card-text class="text-xs-center">
                                  <!-- Insert Group Sales Points -->
                                  <p class="display-2 white--text">{{right_group_sales_points}}</p>
                                  <p class="title">Right GS Points</p>
                                </v-card-text>
                              </v-card>
                            </v-flex>
                          </v-layout>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-container grid-list-xl>
                <v-layout row wrap align-start>
                  <v-flex xs12 md12>
                    <v-card>
                      <v-card-text class="text-xs-center">
                        <p class="display-2 white--text">Maintaining Balance</p>
                         <v-layout row wrap align-start>
                            <v-flex xs12 md6>
                              <v-card color="cyan darken-3">
                                <v-card-text class="text-xs-center">
                                  <!-- Insert Prev Mont Maintaenance Balance Here -->
                                  <p class="display-2 white--text">{{product_purchase}}</p>
                                  <p class="title">Cash</p>
                                </v-card-text>
                              </v-card>
                            </v-flex>
                            <v-flex xs12 md6>
                              <v-card color="teal darken-3">
                                <v-card-text class="text-xs-center">
                                  <!-- Insert Current Mont Maintaenance Balance Here -->
                                  <p class="display-2 white--text">{{product_points}}</p>
                                  <p class="title">Points</p>
                                </v-card-text>
                              </v-card>
                            </v-flex>
                          </v-layout>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-flex>
          </v-layout>
          <v-divider></v-divider>
          <v-layout xs12 md12 justify-center align-center>
             <v-container grid-list-xl>
                <v-layout row wrap align-start>
                  <v-flex xs12 md12>
                    <v-card>
                      <v-card-text class="text-xs-center">
                        <p class="display-2 white--text">Car Incentives</p>
                         <v-layout row wrap justify-center>
                            <v-flex xs12 md4>
                              <v-card>
                                <v-card-text class="text-xs-center">
                                  <v-avatar tile size="250px">
                                    <img src="img/car-montero.png" alt="Profile">
                                  </v-avatar>
                                  <!-- Insert Condition For claim Incentive -->
                                  <v-btn @click="EncashAmtDialog = true" color="primary" round large disabled>Claim</v-btn>
                                </v-card-text>
                              </v-card>
                            </v-flex>
                          </v-layout>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
            
          </v-layout>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
  export default {
    data(){
      return {
        product_purchase: 0,
        product_points: 0,
        incentives_points: 0,
        left_group_sales_points: 0,
        right_group_sales_points: 0,
      }
    },

    methods: {
      retrievePoints() {
        axios.get('/api/bronze/points', {params: {user_id: sessionStorage.getItem('id')}})
        .then(response => {
          var data = response.data
          console.log(data)
          this.product_purchase = data.product_purchase
          this.product_points = data.product_points
          this.incentives_points = data.incentives_points
          this.left_group_sales_points = data.left_group_sales_points
          this.right_group_sales_points = data.right_group_sales_points

          // sessionStorage.getItem('id')
        })
        .catch(response => {
          console.log(response)
        })
      }
    },
    
    created() {
      this.retrievePoints();
    }
  }
</script>