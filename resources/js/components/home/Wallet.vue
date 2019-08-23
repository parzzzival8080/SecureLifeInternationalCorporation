<template>
  <v-layout row>
    <v-flex xs12 lg10 md6 offset-md1>
      <v-card>
        <v-toolbar color="amber darken-3">
          <v-icon color="white" medium>account_balance_wallet</v-icon>
          <v-toolbar-title>Wallet</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <!-- For Diamond -->
          <v-layout v-if="!Bronze" justify-center align-center>
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
          <v-layout v-if="Bronze" justify-center align-center>
            <v-flex xs12>
              <v-container grid-list-xl>
                <v-layout row wrap align-start>
                  <v-flex xs12 md3>
                    <v-card color="blue darken-1">
                      <v-card-text class="text-xs-center">
                        <!-- Insert Match Earnings Here -->
                        <p class="display-2 white--text">₱{{match_earnings}}.00</p>
                        <p class="title">Match Earnings</p>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 md3>
                    <v-card color="light-blue darken-1">
                      <v-card-text class="text-xs-center">
                        <!-- Insert Referal Earnings Here -->
                        <p class="display-2 white--text">₱{{referal_earnings}}.00</p>
                        <p class="title">Referal Earnings</p>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 md3>
                    <v-card color="cyan darken-1">
                      <v-card-text class="text-xs-center">
                        <!-- Insert Group Sales Earnings Here -->
                        <p class="display-2 white--text">₱{{referal_earnings}}.00</p>
                        <p class="title">Group Sales Earnings</p>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 md3>
                    <v-card color="teal darken-1">
                      <v-card-text class="text-xs-center">
                        <!-- Insert Total Earnings -->
                        <p class="display-2 white--text">₱{{total_earnings}}.00</p>
                        <p class="title">Total Earnings</p>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-container grid-list-xl>
                <v-layout row wrap align-start>
                  <v-flex xs12 md6>
                    <v-card color="red darken-1">
                      <v-card-text class="text-xs-center">
                        <!-- Insert Total Encashed Here -->
                        <p class="display-2 white--text">₱{{total_encashed}}.00</p>
                        <p class="title white--text">Total Encashed</p>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 md6>
                    <v-card color="green darken-1">
                      <v-card-text class="text-xs-center">
                        <!-- Insert Avail Balance here -->
                        <p class="display-2 white--text">₱{{current_balance}}.00</p>
                        <p class="title white--text">Available Balance</p>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-flex>
          </v-layout>
          <v-layout xs12 md12 justify-center align-center column>
            <v-btn @click="EncashAmtDialog = true" color="primary" round large disabled>ENCASH</v-btn>
          </v-layout>
          <v-spacer></v-spacer>
          <!-- For Wallet logs -->
          <v-data-table expand :headers="headers" :items="wallet_logs" class="elevation-1">
            <template slot="items" slot-scope="props">
              <td class="text-xs-left">{{ props.item.created_at }}</td>
              <td class="text-xs-left">{{ props.item.amount }}</td>
              <td class="text-xs-left">{{ props.item.remarks }}</td>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-flex>
    <!-- Encashment amount Dialog -->
    <v-dialog v-model="EncashAmtDialog" persistent max-width="400px">
        <v-card>
            <v-card-title class="headline">SecureLife International Corporation Encash</v-card-title>
            <v-card-text>
              <v-text-field label="Encashment Amount" id="encashmentAmt" prefix="₱" suffix=".00" v-model="encashmentAmt"></v-text-field>
              <v-select class="purple-input" :items="types" label="Encashment Type" v-model="encashmentType"></v-select>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" flat @click="requestEncash">ENCASH</v-btn>
                <v-btn type="submit" color="green darken-1" flat @click="EncashAmtDialog = false">CANCEL</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
  export default {
    data(){
      return {
        // Bronze Package
        total_encashed: 0,
        current_balance: 0,
        total_earnings: 0,
        match_earnings: 0,
        referal_earnings: 0,
        wallet_logs: [],

        // Diamond Packaage
        money: [],
        totalearnings: '',
        availableencash: '',
        totalencash: '',
        totalinvite: '',
        totalexit: '',
        EncashAmtDialog: false,
        EncashTypeDialog: false,
        userID: localStorage.getItem('id'),
        encashmentAmt: '',
        encashmentType: '',
        Bronze: true,
        //For data table headers
        headers: [
          {text: 'Date', value: 'date'},
          {text: 'Amount', value: 'amount'},
          {text: 'Remarks', value: 'remarks'},
        ],
        types: ['Cheque', 'Bank Transfer', 'Cash'],
      }
    },
    methods: {

      retrieveBronzeWallet() {
        axios.get('/api/bronze/wallet', {params: {user_id: localStorage.getItem('id')}})
        .then(response => {
          console.log(response)
          var data = response.data
          this.current_balance = data.current_balance
          this.total_earnings = data.total_earnings
          this.match_earnings = data.match_earnings
          this.referal_earnings = data.referal_earnings
          this.wallet_logs = data.wallet_logs
        })
        .catch(response => {
          console.log(response)
        })
      },

      requestEncash(){
        if (this.encashmentAmt<=0 || this.encashmentAmt>this.availableencash)
        {
          swal.fire({
            allowOutsideClick: false,
            title: 'Sorry!',
            text: 'Your encashment can\'t be processed',
            type: 'error',
            showCancelButton: false,
            confirmButtonText: 'Okay'
          })
          return false
        }
        axios.post('api/notification/requestEncash',{
          id: this.userID,
          name: localStorage.getItem('name'),
          amount: this.encashmentAmt,
          type: this.encashmentType
        })
        .then(response =>{
          swal.fire({
            allowOutsideClick: false,
            title: 'Success!',
            text: 'Your encashment request has been sent to admin. Wait for admin to approve',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
          })
          this.encashmentAmt=''
          this.encashmentType=''
          this.EncashAmtDialog=false
        })
      },
      encash(){
        axios.post('api/wallet',{
          user_id: this.userID,
          amount: 0-this.encashmentAmt,
          encashed: '1',
          remarks: 'Encashment',
        })
        swal.fire({
          allowOutsideClick: false,
          title: 'Congratulations!',
          text: 'Successfully encashed',
          type: 'success',
          showCancelButton: false,
          confirmButtonText: 'Okay'
        }).then((result)=>{
          if(result.value){
            window.location.reload()
          }
        })
      }
    },
    //this is there the component start
    created() { 
      this.retrieveBronzeWallet()
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
        this.money=response.data.money
      })
    }
  }
</script>