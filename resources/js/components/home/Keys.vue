<template>
  <v-layout row>
    <v-flex xs12 lg10 md6 offset-md1>
      <v-card>
        <v-toolbar color="amber darken-3">
          <v-icon medium>vpn_key</v-icon>
          <v-toolbar-title class="hidden-md-and-down">Key List</v-toolbar-title>
          <v-spacer></v-spacer>
          <div class="card-tools">
            <v-btn outline color="white" @click.stop="Newdialog = true" >Generate Key<v-icon small color="white">vpn_key</v-icon></v-btn>
          </div>
        </v-toolbar>
        <v-data-table expand :headers="headers" :items="keys" class="elevation-1">
          <template slot="items" slot-scope="props">
            <td>{{ props.item.id }}</td>
            <td class="text-xs-left">{{ props.item.key }}</td>
            <td class="text-xs-left">{{ props.item.pin }}</td>
            <td class="text-xs-left">{{ props.item.investment}}</td>
            <td class="text-xs-left">{{ props.item.status }}</td>
            <td class="text-xs-left" v-if="props.item.status == 'Inactive'">
              <v-icon medium color="red" @click="deleteCode(props.item.id)">
                delete
              </v-icon>
            </td>
          </template>
        </v-data-table>
      </v-card>
    </v-flex>
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
  </v-layout>
</template>

<script>
  export default {
    data(){
      return {
        Newdialog: false,
        keys: [],
        thisid: sessionStorage.getItem('id'),
        investment: '',
        key: '',
        pin: '',
        //For Select Type
        types: ['Bronze Package', 'Diamond Package', 'Commission Deduction'],
        type:'',
        //For data table headers
        headers: [
          {text: 'Id', value: 'id'},
          {text: 'Code', value: 'Code'},
          {text: 'Pin', value: 'Pin'},
          {text: 'Amount', value: 'amount'},
          {text: 'Status', value: 'status'},
          {text: 'Actions', value: 'name', sortable: false},
        ],
      }
    },
    watch: {
      type: function (val) {
        if (this.type=='Bronze Package')
        {
          this.investment = 3995
        }
        else if (this.type=='Diamond Package')
        {
          this.investment = 20000
        }
        else if(this.type=='Commission Deduction')
        {
          this.investment = 0
        }
      }
    },
    methods: {
      deleteCode(id){
        this.$Progress.start();
        //put swal here
        axios.delete('api/key/deletekey/' + id)
        .then(response =>
        {
          this.$Progress.finish();
          window.location.reload();
        })
      },
      saveinvestment() {
        this.$Progress.start();
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
            this.$Progress.fail();
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
        let invest = this.investment
        axios.post('api/key',{
          user_id: this.thisid,
          key: this.key,
          pin: this.pin,
          status: 'Inactive',
          investment: this.investment,
          }
        )
        .then(response=>{
          this.keys.push({
            id: response.data,
            key: this.key,
            pin: this.pin,
            investment: invest,
            status: 'Inactive'
          })
        })
        this.investment=""
        this.Newdialog = false;
        swal.fire({
          allowOutsideClick: false,
          title: 'Successfully Generated!',
          html: 'Key: '+this.key + '</br>' +'Pin: '+this.pin,
          type: 'success',
          showCancelButton: false,
          confirmButtonText: 'Okay'
        })
        this.$Progress.finish();
      },
    },
    //this is there the component start
    created() { 
      //get all keys
      axios.get('api/key/getAllKeys')
      .then(response => {
        this.keys = response.data
      })
    }
  }
</script>