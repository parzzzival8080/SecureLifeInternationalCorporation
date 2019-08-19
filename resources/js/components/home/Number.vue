<template>
  <v-layout row>
      <v-flex xs12 lg10 md6 offset-md1>
          <v-card>
          <!-- Header -->
              <v-toolbar color="amber darken-3">
                <v-icon medium color="white">filter_1</v-icon>
                <v-toolbar-title class="hidden-md-and-down ">My Number</v-toolbar-title>
                <v-spacer></v-spacer>
                <div class="card-tools">
                    <v-btn outline @click.stop="Newdialog = true" >Buy Key <v-icon small>vpn_key</v-icon></v-btn>
                    <v-btn outline @click.stop="Keydialog = true" v-if="disable == false">Activate Key <v-icon small>vpn_key</v-icon></v-btn>
                </div>
              </v-toolbar>
              <v-card-text>
                <div v-for="(dta, index) in dta" :key='index' row>
                  <p :class="{'headline': $vuetify.breakpoint.smAndDown, 'display-2': $vuetify.breakpoint.mdAndUp}" >{{dta.accounts}} Account(s): <strong>#{{dta.num}}</strong></p>
                  <v-divider></v-divider>
                </div>
              </v-card-text>
          </v-card>
      </v-flex>
        <!-- Content -->
      <v-layout row justify-center>
        <v-dialog v-model="Keydialog" persistent max-width="400px">
            <v-card>
                <v-card-title class="headline">ACTIVATE ACCOUNT</v-card-title>
                <v-card-text>
                    <p display-1>Your account is currently inactive. Enter key to activate account!</p>
                    <p headline>Key:</p>
                    <v-text-field label="Key" id="key" ></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                        <v-btn color="green darken-1" flat @click="activateuser()">ACTIVATE</v-btn>
                        <v-btn type="submit" color="green darken-1" flat @click="Keydialog = false">CANCEL</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
      <!-- Key Request Dialog -->
    <v-layout row justify-center>
        <v-dialog v-model="Newdialog" persistent max-width="400px">
            <v-card>
                <v-card-title class="headline">Welcome to SecureLife International Corporation</v-card-title>
                <v-card-text>
                    <p display-1>Invest a multiple of ₱20,000.00!</p>
                    <v-text-field label="Amount" id="investment" prefix="₱" suffix=".00" v-model="investment"></v-text-field>
                    <input type="file" id="imgupload" style="display:none" @change="UploadPicture"/> 
                    
                    <div class="row">
                        <v-btn class="mx-2" @click.prevent="openFileDialog" icon>
                            <v-icon size="22px">photo</v-icon>
                        </v-btn>

                        <v-text-field id="proof" type="proof" v-model="proof" readonly/>
                    </div>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click="saveinvestment();">INVEST</v-btn>
                    <v-btn type="submit" color="green darken-1" flat @click="Newdialog = false">INVEST LATER</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
  </v-layout>
</template> 

<script>
  export default {
    data(){
      return {
        Newdialog: false,
        Keydialog: false,
        dta: [],
        myexit: '',
        num1: '',
        num2: '',
        thisid: localStorage.getItem('id'),
        proof: '',
        image: '',
        investment: '',
        myaccounts: '',
        disable: false
      }
    },
    methods: {
      openFileDialog(){
          $('#imgupload').trigger('click');
      },
      UploadPicture(e){
          let file = e.target.files[0];
          let reader = new FileReader();
          reader.onloadend = (file) => {
              this.proof = document.getElementById('imgupload').value.split('\\').pop()
              this.image = reader.result;
          }
          reader.readAsDataURL(file);
      },
      saveinvestment() {
        this.$Progress.start();
        if (this.investment == 0 || this.investment%20000!=0 || this.proof.trim() == '')
        {
            if (this.investment == 0 || this.investment%20000!=0)
            {
                swal.fire('Oops!', 'Investment must be multiple of P20,000.00', 'error')
                this.$Progress.fail();
            }
            else if (this.proof.trim() == '')
            {
                swal.fire('Oops!', 'Upload your proof of payment', 'error')
                this.$Progress.start();
            }
            return false
        }
        axios.post('api/proof',{
            name: localStorage.getItem('name'),
            user_id: localStorage.getItem('id'),
            image: this.image,
            investment: this.investment,
            status: 'pending',
            }
        )
        this.Newdialog = false;
        swal.fire(
        'Thanks for investing!',
        'Wait for admin to confirm',
        'success')
        this.$Progress.finish();
      },
      activateuser(){
        //check if key entered is not yet activated
        axios.get('api/key/checkKey/', {
          params: {
            accounts: this.myaccounts,
            userid: this.thisid,
            key: document.getElementById('key').value,
            name: this.thisname,
            email: localStorage.getItem('email'),
          }
        }).then(response => {
          //check if key entered is bought by user
          if(response.data.data){
                this.Activatedialog = false;
                swal.fire({
                  allowOutsideClick: false,
                  title: 'Congratulations!',
                  text: 'Succesfully Activated',
                  type: 'success',
                  showCancelButton: false,
                  confirmButtonText: 'Okay'
                }).then((result)=>{
                  if(result.value){
                    window.location.reload();
                  }
                })
          }
          else{
              swal.fire("Failed!",
              "It seems you have entered a wrong key. Enter again",
              "error")
          }
        })
      },
    },
    //this is there the component start
  created() { 
      axios.get('api/queue/configNumber',{
        params:{
          id: this.thisid
        }
      })
      .then(response =>{
        this.dta = response.data.dta
      });
      axios.get('api/key/myAccounts',
      {
        params:{
          id: this.thisid
        }
      })
      .then(response => {
        this.myaccounts = response.data.count
        if (this.myaccounts == 50){
          this.disable = true
        }
      })
    }
  }
</script>