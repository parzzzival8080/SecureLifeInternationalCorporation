<template>
  <v-layout row>
    <v-flex xs12 lg10 md6 offset-md1>
      <v-card>
        <v-toolbar color="amber darken-3">
          <v-icon medium color="white">notifications</v-icon>
          <v-toolbar-title class="hidden-md-and-down">Notification</v-toolbar-title>
          <!-- <v-spacer></v-spacer>
          <v-btn flat icon color="green" @click="loadAll('type')">
            <v-icon>cached</v-icon>
          </v-btn>
          <v-flex xs12 sm6 md4>
            <v-select class="purple-input" :items="admin? admintypes:usertypes" label="Type" v-model="type"></v-select>
          </v-flex>
          <v-btn flat icon color="green" @click="loadAll('date')">
            <v-icon>cached</v-icon>
          </v-btn>
          <v-flex xs12 sm6 md4>
            <v-dialog ref="dialogfrom" v-model="modal" :return-value.sync="date" persistent lazy full-width width="290px">
              <template v-slot:activator="{ on }">
                <v-text-field v-model="date" label="From:" prepend-icon="event" readonly v-on="on"></v-text-field>
              </template>
              <v-date-picker v-model="date" scrollable>
                <v-spacer></v-spacer>
                <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                <v-btn flat color="primary" @click="$refs.dialogfrom.save(date); tryalert()">OK</v-btn>
              </v-date-picker>
            </v-dialog>
          </v-flex> -->
        </v-toolbar>
        <!-- List start here -->
        <v-list dense two-line>
          <div v-for="notification in allNotifications" :key="notification.id">
            <v-list-tile>
              <!-- For Icon -->
              <v-list-tile-avatar>
                  <!-- User Register -->
                  <v-icon size="40px" v-if="notification.type == 'UserRegistered'">person_add</v-icon>
                  <v-icon size="40px" v-else-if="notification.type == 'UserRegisterednoCode'">person_add</v-icon>
                  <!-- Key Request -->
                  <v-icon size="40px" v-else-if="notification.type == 'UserActivated'">person_add</v-icon>
                  <v-icon size="40px" v-else-if="notification.type == 'KeyRequest'">vpn_key</v-icon>
                  <v-icon size="40px" color="success" v-else-if="notification.type == 'KeyApproved'">vpn_key</v-icon>
                  <v-icon size="40px" color="error" v-else-if="notification.type == 'KeyDisapproved'">vpn_key</v-icon>
                  <!-- Encashment Request -->
                  <v-icon size="40px" v-else-if="notification.type == 'EncashRequest'">money</v-icon>
                  <v-icon size="40px" color="success" v-else-if="notification.type == 'EncashApproved'">money</v-icon>
                  <v-icon size="40px" color="error" v-else-if="notification.type == 'EncashDisapproved'">money</v-icon>
                  <!-- User Exit -->
                  <v-icon size="40px" color="error" v-else-if="notification.type == 'UserExit'">exit_to_app</v-icon>
              </v-list-tile-avatar>
              <!-- Message -->
              <v-list-tile-content>
                <!-- Message Title -->
                  <!-- User Register -->
                  <v-list-tile-title v-if="notification.type == 'UserRegistered'">User Registered</v-list-tile-title>
                  <v-list-tile-title v-else-if="notification.type == 'UserRegisterednoCode'">Proof of Payment</v-list-tile-title>
                  <!-- Key Request -->
                  <v-list-tile-title v-else-if="notification.type == 'UserActivated'">User Activated</v-list-tile-title>
                  <v-list-tile-title v-else-if="notification.type == 'KeyRequest'">Key Request</v-list-tile-title>
                  <v-list-tile-title v-else-if="notification.type == 'KeyDisapproved'">Key Disapproved</v-list-tile-title>
                  <v-list-tile-title v-else-if="notification.type == 'KeyApproved'">Key Approved</v-list-tile-title>
                  <!-- Encashment Request -->
                  <v-list-tile-title v-else-if="notification.type == 'EncashRequest'">Encashment Request</v-list-tile-title>
                  <v-list-tile-title v-else-if="notification.type == 'EncashApproved'">Encashment Approved</v-list-tile-title>
                  <v-list-tile-title v-else-if="notification.type == 'EncashDisapproved'">Encashment Disapproved</v-list-tile-title>
                  <!-- User Exit -->
                  <v-list-tile-title v-else-if="notification.type == 'UserExit'">User Exit</v-list-tile-title>
                <!-- Message Content -->
                   <!-- User Register -->
                  <v-list-tile-sub-title v-if="notification.type == 'UserRegistered'">{{ notification.data.UserCreatedName }}</v-list-tile-sub-title>
                  <v-list-tile-sub-title v-else-if="notification.type == 'UserRegisterednoCode'">{{ notification.data.UserCreatedName }}</v-list-tile-sub-title>
                  <!-- Key Request -->
                  <v-list-tile-sub-title v-else-if="notification.type == 'UserActivated'">{{ notification.data.UserActivatedName }}</v-list-tile-sub-title>
                  <v-list-tile-sub-title v-else-if="notification.type == 'KeyRequest'">{{ notification.data.message }}</v-list-tile-sub-title>
                  <v-list-tile-sub-title v-else-if="notification.type == 'KeyDisapproved'">{{ notification.data.message }} <br>
                     Try Requesting Again
                  </v-list-tile-sub-title>
                  <v-list-tile-sub-title v-else-if="notification.type == 'KeyApproved'">{{ notification.data.message }}
                     this is your key <p class="body-2 primary--text" >{{ notification.data.key }}</p></v-list-tile-sub-title>
                  <!-- Encashment Request -->
                  <v-list-tile-sub-title v-else-if="notification.type == 'EncashRequest'">{{ notification.data.message }}</v-list-tile-sub-title>
                  <v-list-tile-sub-title v-else-if="notification.type == 'EncashDisapproved'">{{ notification.data.message }} <br>
                     Try Requesting Again
                  </v-list-tile-sub-title>
                  <v-list-tile-sub-title v-else-if="notification.type == 'EncashApproved'">{{ notification.data.message }}</v-list-tile-sub-title>
                  <!-- User Exit -->
                  <v-list-tile-sub-title v-else-if="notification.type == 'UserExit' && admin == true">{{ notification.data.admin_message }}</v-list-tile-sub-title>
                  <v-list-tile-sub-title v-else-if="notification.type == 'UserExit' && admin == false">{{ notification.data.user_message }}</v-list-tile-sub-title>
              </v-list-tile-content>
              <v-spacer></v-spacer>
              <!-- Action/Button -->
              <v-list-tile-action>
                <!-- Date -->
                <v-list-tile-action-text>{{ notification.created_at | myDate }}</v-list-tile-action-text>
          <!-- FOR ADMINS -->
                  <!-- Key Request -->
                  <v-layout v-if="notification.type == 'KeyRequest'">
                    <!-- Pending -->
                    <v-chip v-if="notification.data.status == 'pending'"  @click="openRequest" :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="primary">
                      <v-avatar>
                        <v-icon>hourglass_empty</v-icon>
                      </v-avatar>
                      <span>Pending</span>
                    </v-chip>
                    <!-- Approved -->
                    <v-chip v-else-if="notification.data.status == 'approved'" :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="success">
                      <v-avatar>
                        <v-icon>done</v-icon>
                      </v-avatar>
                      <span>Approved</span>
                    </v-chip>
                    <!-- Disapproved -->
                    <v-chip v-else :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="error">
                      <v-avatar>
                        <v-icon>close</v-icon>
                      </v-avatar>
                      <span>Disapproved</span>
                    </v-chip>
                  </v-layout>
                  <!-- Encashment Request -->
                  <v-layout v-if="notification.type == 'EncashRequest'">
                    <!-- Pending -->
                    <v-chip v-if="notification.data.status == 'pending'"  @click="openRequest" :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="primary">
                      <v-avatar>
                        <v-icon>hourglass_empty</v-icon>
                      </v-avatar>
                      <span>Pending</span>
                    </v-chip>
                    <!-- Approved -->
                    <v-chip v-else-if="notification.data.status == 'approved'" :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="success">
                      <v-avatar>
                        <v-icon>done</v-icon>
                      </v-avatar>
                      <span>Approved</span>
                    </v-chip>
                    <!-- Disapproved -->
                    <v-chip v-else :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="error">
                      <v-avatar>
                        <v-icon>close</v-icon>
                      </v-avatar>
                      <span>Disapproved</span>
                    </v-chip>
                  </v-layout>
                  <!-- User registered -->
                  <v-chip v-else-if="notification.type == 'UserRegistered'" 
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="grey darken-5">
                      <v-avatar>
                        <v-icon>info</v-icon>
                      </v-avatar>
                      Information
                  </v-chip>
                  <!-- Proof of Payment -->
                  <v-chip v-else-if="notification.type == 'UserRegisterednoCode'" @click='openProof(notification.id, notification.data)'
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="grey darken-5">
                      <v-avatar>
                        <v-icon>info</v-icon>
                      </v-avatar>
                      Proof of Payment
                  </v-chip>
                  <!-- User Activated -->
                  <v-chip v-else-if="notification.type == 'UserActivated'"
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="grey darken-5">
                      <v-avatar>
                        <v-icon>info</v-icon>
                      </v-avatar>
                      User Activated
                  </v-chip>
                  <!-- User Exit -->
                  <v-chip v-else-if="notification.type == 'UserExit'" 
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown"
                        outline fab color="error">
                      <v-avatar>
                        <v-icon>exit_to_app</v-icon>
                      </v-avatar>
                      Exited
                  </v-chip>
          <!-- FOR USERS -->
                  <!-- Key Aproved -->
                  <v-chip v-else-if="notification.type == 'KeyApproved'" @click="Activatedialog = true" 
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown" outline fab color="success">
                      <v-avatar>
                        <v-icon>vpn_key</v-icon>
                      </v-avatar>
                      Activate
                  </v-chip>
                  <!-- Key Dissaproved -->
                  <v-chip v-else-if="notification.type == 'KeyDisapproved'"
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown" outline fab color="error">
                      <v-avatar>
                        <v-icon>close</v-icon>
                      </v-avatar>
                      Disapproved
                  </v-chip>
                  <!-- Encashment Aproved -->
                  <v-chip v-else-if="notification.type == 'EncashApproved'"
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown" outline fab color="success">
                      <v-avatar>
                        <v-icon>money</v-icon>
                      </v-avatar>
                      Approved
                  </v-chip>
                  <!-- Encashment Dissaproved -->
                  <v-chip v-else-if="notification.type == 'EncashDisapproved'"
                        :class="{'mb-2': $vuetify.breakpoint.smAndDown, 'mb-4': $vuetify.breakpoint.mdAndUp}" 
                        bottom center round :large="$vuetify.breakpoint.mdAndUp" 
                        :small="$vuetify.breakpoint.smAndDown" outline fab color="error">
                      <v-avatar>
                        <v-icon>close</v-icon>
                      </v-avatar>
                      Disapproved
                  </v-chip>
              </v-list-tile-action>
            </v-list-tile>
            <v-divider inset></v-divider>
          </div>
        </v-list>
      </v-card>
    </v-flex>
    <!-- Activate Dialog -->
    <v-layout row justify-center>
        <v-dialog v-model="Activatedialog" persistent max-width="400px">
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
                        <v-btn type="submit" color="green darken-1" flat @click="Activatedialog = false">CANCEL</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
  </v-layout>
</template>
<script src="/js/app.js"></script>
<script>
  export default {
    data: () => ({
      drawer: null,
      noCodeID: '',
      noCodeName: '',
      investment: '',
      Newdialog: false,
      Keydialog: false,
      Activatedialog: false,
      allNotifications:[],
      dateNotifications:[],
      typeNotifications:[],
      admin: false,
      key: '',
      notif_id: '',
      data: '',
      entry:'',
      modal:false,
      date: '',
      type: 'All',
      thisid: localStorage.getItem('id'),
      thisname: localStorage.getItem('name'),
      admintypes: ['All', 'Key Requests', 'User Registrations', 'User Exits'],
      usertypes: ['All', 'Approved Keys', 'Disapproved Keys'],
    }),
    methods:{
      openRequest(){
        window.location.replace('/requests')
      },
      openProof(id, data){
        this.Newdialog= true
        this.noCodeID= data.UserCreatedID
        this.noCodeName= data.UserCreatedName
        var win = window.open(data.proof, '_blank');
        win.focus();
      },
      activateuser(){
          //check if key entered is not yet activated
          axios.get('api/key/checkKey/', {
            params: {
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
        loadAll(data){
          if (data == 'type'){
            this.type = 'All'
          }
          else{
            this.date = ''
          }
          // this.allNotifications = window.user.user.notifications;
        }
    },
    created() {
      axios.get('api/notification', {
        params: {
          id: this.thisid
        }
      }).then(response=>{
        //should call read function
        this.allNotifications=response.data.dta;
      })
      if (localStorage.getItem('type') == "admin"){
        this.admin = true
      }
      else{
        this.admin =  false
      }
      axios.put('api/notification/read/',
      {
        id: this.thisid
      });
    }
}
</script>