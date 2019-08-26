<template>
  <v-layout row>
    <v-flex xs12 lg10 md6 offset-md1>
      <v-card>
        <!-- Header -->
        <v-toolbar color="amber darken-3" v-if="keyRequests">
          <v-icon medium>vpn_key</v-icon>
          <v-toolbar-title class="hidden-md-and-down">Key Requests</v-toolbar-title>
        </v-toolbar>
        <v-toolbar color="amber darken-3" v-else>
          <v-icon medium>money</v-icon>
          <v-toolbar-title class="hidden-md-and-down">Encashment Requests</v-toolbar-title>
        </v-toolbar>
        <!-- Tabs -->
        <v-tabs centered transparent icons-and-text grow >
          <v-tabs-slider color="amber darken-3"></v-tabs-slider>
          
          <!-- Tab for Diamond -->
          <v-tab href="#tab-1" @click="keyRequests = true">
            Key Requests
            <v-icon>vpn_key</v-icon>
          </v-tab>

          <!-- Tab for Bronze -->
          <v-tab href="#tab-2" @click="keyRequests = false">
            Encashment Requests
            <v-icon>money</v-icon>
          </v-tab>
          
          <!-- Tab Value for Key Requests -->
          <v-tab-item :value="'tab-' + 1">
            <v-data-table expand :headers="keyHeaders" :items="keys" class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.user_name }}</td>
                <td class="text-xs-left">{{ props.item.investment }}</td>
                <td class="text-xs-left">{{ props.item.status }}</td>
                <td class="justify-center layout px-0" v-if="props.item.status == 'pending'">
                  <v-icon medium color="green" @click.stop="OpenNewDialog(props.item)">
                    check
                  </v-icon>
                  <v-divider inset vertical></v-divider>
                  <v-icon medium color="gray" @click="OpenPicDialog(props.item.request_image)">
                    visibility_on
                  </v-icon>
                  <v-divider inset vertical></v-divider>
                  <v-icon medium color="red" @click="disapproveRequest(props.item)">
                    close
                  </v-icon>
                </td>
              </template>
            </v-data-table>
          </v-tab-item>

          <!-- Tab Value for Encashment Requests -->
          <v-tab-item :value="'tab-' + 2">
            <v-data-table expand :headers="encashmentHeaders" :items="encashments" class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.user_name }}</td>
                <td class="text-xs-left">{{ props.item.amount }}</td>
                <td class="text-xs-left">{{ props.item.type }}</td>
                <td class="text-xs-left">{{ props.item.status }}</td>
                <td class="justify-center layout px-0" v-if="props.item.status == 'pending'">
                  <v-icon medium color="green" @click.stop="approveEncash(props.item)">
                    check
                  </v-icon>
                  <v-divider inset vertical></v-divider>
                  <v-icon medium color="red" @click="disapproveEncash(props.item)">
                    close
                  </v-icon>
                </td>
              </template>
            </v-data-table>
          </v-tab-item>
        </v-tabs>
      </v-card>
    </v-flex>
    <!-- New Key Dialog -->
    <v-layout row justify-center>
        <v-dialog v-model="Newdialog" persistent max-width="400px">
            <v-card>
                <v-card-title class="headline">SecureLife International Corporation Generate Key</v-card-title>
                <v-card-text>
                  <v-select class="purple-input" :items="types" label="Type" v-model="type"></v-select>
                  <v-text-field label="Investment Amount" id="investment" prefix="₱" suffix=".00" v-model="investment" :disabled='type=="Diamond Package"?false:true'></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click="saveinvestment();">GENERATE</v-btn>
                    <v-btn type="submit" color="green darken-1" flat @click="Newdialog = false">CANCEL</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
    <!-- Profile Picture Dialog -->
    <v-dialog v-model="PicDialog" fullscreen>
            <v-img :src="pic"  max-height="100%" max-width="100%" contain alt="Profile">
            </v-img>
    </v-dialog>
  </v-layout>
</template> 

<script>
  export default {
    data(){
      return {
        Newdialog: false,
        PicDialog: false,
        keyRequests: true,
        keys: [],
        encashments: [],
        thisid: sessionStorage.getItem('id'),
        investment: '',
        notif_id: '',
        user_id: '',
        pic: '',
        key: '',
        pin: '',
        types: ['Bronze Package', 'Diamond Package', 'Commission Deduction'],
        type:'',
        //For data table headers
        keyHeaders: [
          {text: 'Id', value: 'id'},
          {text: 'User', value: 'user_id'},
          {text: 'Investment', value: 'Investment'},
          {text: 'Status', value: 'status'},
          {text: 'Actions', value: 'name', sortable: false},
        ],
        encashmentHeaders: [
          {text: 'Id', value: 'id'},
          {text: 'User', value: 'user_id'},
          {text: 'Encashment Amount', value: 'Encashment Amount'},
          {text: 'Encashment Type', value: 'Encashment Type'},
          {text: 'Status', value: 'status'},
          {text: 'Actions', value: 'name', sortable: false},
        ],
      }
    },
    watch: {
      type: function (val) {
        alert('HE')
        // if (this.type=='Bronze Package')
        // {
        //   this.investment = 3995
        // }
        // else if (this.type=='Diamond Package')
        // {
        //   this.investment = 20000
        // }
        // else if(this.type=='Commission Deduction')
        // {
        //   this.investment = 0
        // }
      }
    },
    methods: {
      approveEncash(data){
        axios.post('api/wallet',{
          user_id: data.user_id,
          amount: 0-data.amount,
          encashed: '1',
          remarks: 'Encashment',
        })
        .then(response =>{
          axios.post('api/notification/encashmentApproved',{
            id: this.thisid,
            user_id: data.user_id,
            notif_id: data.id
          })
        })
        swal.fire({
          allowOutsideClick: false,
          title: 'Thank you!',
          text: 'User successfully encashed',
          type: 'success',
          showCancelButton: false,
          confirmButtonText: 'Okay'
        }).then((result)=>{
          if(result.value){
            window.location.reload()
          }
        })
      },
      OpenNewDialog(data){
          this.Newdialog = true
          this.user_id=data.user_id
          this.proof_id=data.id
      },
      OpenPicDialog(pic){
          this.PicDialog = true
          this.pic = pic
      },
      disapproveRequest(data){
        axios.post('api/proof/disapproveRequest',{
          user_id: data.user_id,
          thisid: this.thisid,
          proof_id: data.id
          }
        )
        .then(response=>{
          window.location.reload();
        })
      },
      saveinvestment() {
          if (this.type == 'Diamond Package')
        {
          if (this.investment %20000 != 0 && this.investment<=0){
            swal.fire({
              allowOutsideClick: false,
              title: 'ERROR!',
              text: 'Investment should be a multiple of 20000',
              type: 'error',
              showCancelButton: false,
              confirmButtonText: 'Okay'
            })
            return false
          }
        }
        let keychars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890" //allowed characters for key
        let pinchars = "1234567890" //allowed characters for key
        this.key = ''
        this.pin = ''
        for(let i=0; i < 16; i++ ) {
          if (i==4 || i==8 || i==12){
            this.key +="-"
          }
          this.key += keychars.charAt(Math.floor(Math.random() * keychars.length))
        }
        for(let i=0; i < 7; i++ ) {
          // if (i==3 || i==5){
          //   this.pin +="-"
          // }
          this.pin += pinchars.charAt(Math.floor(Math.random() * pinchars.length))
        }
        if (this.type == 'Commission Deduction')
        {
          this.key = "SLCD-" + this.key;
        }
        else
        {
          this.key = "SL-" + this.key;
        }
        axios.post('api/proof/approveRequest',{
            user_id: this.user_id,
            key: this.key,
            pin: this.pin,
            status: 'Inactive',
            investment: this.investment,
            thisid: this.thisid,
            proof_id: this.proof_id
        }).then(response=>
        {
          this.investment=""
          this.Newdialog = false;
          swal.fire({
            allowOutsideClick: false,
            title: 'Successfully Generated!',
            html: 'Key: '+this.key + '</br>' +'Pin: '+this.pin,
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
          }).then((result)=>
          {
            if(result.value){
              window.location.reload();
            }
          })
        })
      },
    },
    watch: {
      keyRequests: function (val) {
        if (val == true)
        {
          axios.get('api/proof/getRequests')
          .then(response => {
            this.keys = response.data
          })
        }
        else
        {
          axios.get('api/notification/getEncashmentRequests')
          .then(response => {
            this.encashments = response.data
          })
        }
      }
    },
    //this is there the component start
    created() { 
      axios.get('api/proof/getRequests')
      .then(response => {
        this.keys = response.data
      })
    }
  }
</script>