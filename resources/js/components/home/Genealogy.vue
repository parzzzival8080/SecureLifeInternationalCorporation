<template>
  <v-layout row>
    <v-flex xs12 lg10 md6 offset-md1>
        <v-card>
            <!-- Header -->
            <v-toolbar color="amber darken-3">
              <v-icon medium color="white">filter_1</v-icon>
              <v-toolbar-title class="hidden-md-and-down">User Number List</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn flat icon color="green" @click="loadUsers" v-show="admin">
                <v-icon>cached</v-icon>
              </v-btn>
              <v-flex xs12 sm6 md4 v-show="admin">
                <v-dialog ref="dialogfrom" v-model="modalfrom" :return-value.sync="datefrom" persistent lazy full-width width="290px">
                  <template v-slot:activator="{ on }">
                    <v-text-field v-model="datefrom" label="From:" prepend-icon="event" readonly v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="datefrom" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="modalfrom = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialogfrom.save(datefrom); tryalert()">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-flex>
              <v-flex xs12 sm6 md4 v-show="admin">
                <v-dialog ref="dialogto" v-model="modalto" :return-value.sync="dateto" persistent lazy full-width width="290px">
                  <template v-slot:activator="{ on }">
                    <v-text-field v-model="dateto" label="To:" prepend-icon="event" readonly v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="dateto" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="modalto = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialogto.save(dateto); tryalert()">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-flex>
            </v-toolbar>
            <!-- Header End -->
            <v-card-actions v-if="admin">
              <v-layout column align-center justify-center>
                <v-layout v-for="(queue, index) in queues" :key="index" align-center column mt-2>
                    <v-avatar size="81" :color="queue.exited == 0? 'blue':'red'">
                        <p class="headline white--text">{{queue.id}}</p>
                    </v-avatar>
                    <p v-if="queue.id>bracketcnt">{{queue.name}} - (0/{{queue.exit}})</p>
                    <p v-else-if="queue.id==bracketcnt">{{queue.name}} - ({{count}}/{{queue.exit}})</p>
                    <p v-else>{{queue.name}} - ({{queue.exit}}/{{queue.exit}})</p>
                </v-layout>
                <div class="text-xs-center">
                  <v-pagination
                    v-model="page"
                    @input="paginates()"
                    :length=pages
                  ></v-pagination>
                </div>
              </v-layout>
            </v-card-actions>
        </v-card>
      </v-flex>
  </v-layout>
</template> 

<script>
  export default {
    data(){
      return {
        Newdialog: false,
        Keydialog: false,
        editMode: false,
        queues: [],
        thisid: localStorage.getItem('id'),
        thisname: localStorage.getItem('name'),
        active: false,
        bracket: 0,
        bracketcnt: 0,
        count: 0,
        id: '',
        myBracket : 0,
        nowBracket: 0,
        admin:false,
        modalfrom:false,
        modalto:false,
        datefrom:'',
        dateto: '',
        page: 1,
        pages: 1,
      }
    },
    methods: {
      paginates(){
        axios.get("api/queue",{
          params:{
            datefrom: this.datefrom,
            dateto: this.dateto,
            page: this.page
          }
        })
        .then(response =>{
          this.queues=response.data.data.data
          this.pages = response.data.data.last_page
        });
      },
      tryalert(){
        if (this.datefrom == ''){
          this.datefrom = this.dateto;
        }
        if (this.dateto == ''){
          this.dateto = this.datefrom;
        }
        axios.get("api/queue",{
          params:{
            datefrom: this.datefrom,
            dateto: this.dateto,
            page: this.page
          }
        })
        .then(response =>{
          this.queues=response.data.data.data
          this.pages = response.data.data.last_page
        });
      },
      //this function will load all the user
      loadUsers(){
        let last=0
        axios.get("api/queue",{
          params:{
            datefrom: '',
            dateto: ''
          }
        })
        .then(response =>{
          this.queues=response.data.data.data
          this.pages = response.data.data.last_page
        });
        this.datefrom=''
        this.dateto=''
        this.page = 1
      },
    },
    //this is there the component start
    created() { 

      this.admin = true
      this.loadUsers();
      axios.get('api/bracket/getActiveBracket/').then(response =>{
        this.bracketcnt = response.data.data
        this.count = response.data.count
      })
    }
  }
</script>