<template>
    <v-app id="inspire" :dark="dark">
      <!-- Drawer Start -->
      <v-navigation-drawer width="250" clipped fixed v-model="drawer" app class="column align-center justify-center">
      <div class="d-flex flex-column justify-content-center align-items-center mt-3">
        <v-avatar size="150px" @click.stop="PicDialog = true">
          <img :src="photo" alt="Profile">
        </v-avatar>
        <p class="subheading font-weight-regular mt-1">{{name}} </p>
        <p class="subheading font-weight-regular">{{code}}</p>
        <p class="subheading font-weight-regular" v-if="!admin">Diamond Account</p>
        <p class="subheading font-weight-regular" v-if="admin">Admin Account</p>
      </div>
      <!-- Profile Picture Dialog -->
      <v-dialog v-model="PicDialog">
        <div class="d-flex justify-content-center align-items-center">
          <v-img :src="photo"  :max-height="profile_size" :max-width="profile_size" contain alt="Profile">
          </v-img>
        </div>
      </v-dialog>
      <v-list dense expand three-line>
        <!-- Start Navigation List -->
        <v-list-tile ripple="ripple" exact to="/profile">
          <v-list-tile-action>
            <v-icon>account_circle</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title class="subheading font-weight-regular">My Profile</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/dashboard" v-if="!admin">
            <v-list-tile-action>
                <v-icon>dashboard</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">Dashboard</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/users" v-if="admin">
            <v-list-tile-action>
                <v-icon>people</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">User List</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/number" v-if="!admin && !account">
          <v-list-tile-action>
            <v-icon>filter_1</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title class="subheading font-weight-regular">My Number</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/genealogy" v-if="!admin">
          <v-list-tile-action>
            <v-icon>device_hub</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title class="subheading font-weight-regular">Genealogy</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/keys" v-if="admin">
            <v-list-tile-action>
                <v-icon>vpn_key</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">Keys</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/requests" v-if="admin">
            <v-list-tile-action>
                <v-icon>move_to_inbox</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">Requests</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/numbers" v-if="admin">
            <v-list-tile-action>
                <v-icon>filter_1</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">User Number List</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/wallet" v-if="!admin">
            <v-list-tile-action>
                <v-icon>account_balance_wallet</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">Wallet</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile ripple="ripple" exact to="/points" v-if="!admin && account">
            <v-list-tile-action>
                <v-icon>fas fa-coins</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">Points</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile>
            <v-list-tile-content>
                <v-switch v-model="dark" color="amber darken-3" label="Dark Mode"></v-switch>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile  ripple="ripple" @click="logout" rel="noopener">
            <v-list-tile-action >
                <v-icon>exit_to_app</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading font-weight-regular">Logout</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
      </v-list>
        <!-- End Navigation List -->        
      </v-navigation-drawer>
        <!-- Drawer End -->        
        <!-- Navigation Bar -->        
      <v-toolbar app fixed clipped-left>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>SecureLife International Corporation</v-toolbar-title>
        <v-spacer></v-spacer>
         <v-menu full-width transition="slide-x-transition" offset-y origin="center center" class="elelvation-1" :nudge-bottom="14" >
              <v-btn icon flat slot="activator" @click="markAsRead">
                  <v-badge color="red" overlap>
                      <span slot="badge">{{notifCount}}</span>
                      <v-icon medium>notifications</v-icon>
                  </v-badge>
              </v-btn>
              <v-list two-line>
                <div v-for="notification in allNotifications" :key="notification.id">
                  <v-list-tile ripple="ripple" exact to="/notification">
                    <v-list-tile-avatar>
                        <v-icon size="40px" v-if="notification.type == 'UserRegistered'">person_add</v-icon>
                        <v-icon size="40px" v-else-if="notification.type == 'UserRegisterednoCode'">person_add</v-icon>
                        <v-icon size="40px" v-else-if="notification.type == 'UserActivated'">person_add</v-icon>
                        <v-icon size="40px" v-else-if="notification.type == 'KeyRequest'">vpn_key</v-icon>
                        <v-icon size="40px" color="success" v-else-if="notification.type == 'KeyApproved'">vpn_key</v-icon>
                        <v-icon size="40px" color="error" v-else-if="notification.type == 'KeyDisapproved'">vpn_key</v-icon>
                        <v-icon size="40px" v-else-if="notification.type == 'EncashRequest'">money</v-icon>
                        <v-icon size="40px" color="success" v-else-if="notification.type == 'EncashApproved'">money</v-icon>
                        <v-icon size="40px" color="error" v-else-if="notification.type == 'EncashDisapproved'">money</v-icon>
                        <v-icon size="40px" color="error " v-else-if="notification.type == 'UserExit'">exit_to_app</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title v-if="notification.type == 'UserRegistered'">User Registered</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'UserRegisterednoCode'">Proof of Payment</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'UserActivated'">User Activated</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'KeyRequest'">Key Request</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'KeyDisapproved'">Key Request Disapproved</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'KeyApproved'">Key Request Approved</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'EncashRequest'">Encashment Request</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'EncashDisapproved'">Encashment Request Disapproved</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'EncashApproved'">Encashment Request Approved</v-list-tile-title>
                        <v-list-tile-title v-else-if="notification.type == 'UserExit'">User Exit</v-list-tile-title>
                        <v-list-tile-sub-title v-if="notification.type == 'UserRegistered'">{{ notification.data.UserCreatedName }}</v-list-tile-sub-title>
                        <v-list-tile-sub-title v-else-if="notification.type == 'UserRegisterednoCode'">{{ notification.data.UserCreatedName }}</v-list-tile-sub-title>
                        <v-list-tile-sub-title v-else-if="notification.type == 'UserActivated'">{{ notification.data.UserActivatedName }}</v-list-tile-sub-title>
                        <v-list-tile-sub-title v-else-if="notification.type == 'KeyRequest'">{{ notification.data.message }}</v-list-tile-sub-title>
                        <v-list-tile-sub-title v-else-if="notification.type == 'KeyDisapproved'">{{ notification.data.message }}</v-list-tile-sub-title>
                        <v-list-tile-sub-title v-else-if="notification.type == 'KeyApproved'">{{ notification.data.message }}</v-list-tile-sub-title>
                        <v-list-tile-sub-title v-else-if="notification.type == 'UserExit' && admin == true">{{ notification.data.admin_message }}</v-list-tile-sub-title>
                        <v-list-tile-sub-title v-else-if="notification.type == 'UserExit' && admin == false">{{ notification.data.user_message }}</v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-spacer></v-spacer>
                    <v-list-tile-action>
                        <v-list-tile-action-text>{{ notification.created_at | myDate }}</v-list-tile-action-text>
                    </v-list-tile-action>
                  </v-list-tile>
                  <v-divider inset></v-divider>
                </div>
                <v-btn small  flat :ripple="false" :hover="false" exact to="/notification">Show All Notification</v-btn>
              </v-list>
          </v-menu>
      </v-toolbar>
     <!-- Container List -->        
      <v-content>
        <v-container fluid  pa-2 ma-2 fill-height>
          <!-- <v-layout> -->
            <!-- <v-flex> -->
              <router-view name="home"></router-view>
              <vue-progress-bar></vue-progress-bar>
            <!-- </v-flex> -->
          <!-- </v-layout> -->
        </v-container>
      </v-content>
      <v-footer app fixed>
        <span>&copy; SecureLife International Corporation 2019</span>
      </v-footer>
    </v-app>
</template>

<script src="/js/app.js"></script>
<script>
  export default {
    data: () => ({
      name: sessionStorage.getItem('name'),
      photo: sessionStorage.getItem('photo'),
      userId: sessionStorage.getItem('id'),
      account: true,
      PicDialog: false,
      drawer: null,
      dark: true,
      allNotifications:[],
      admin: false,
      code: '',
      pic: '',
      notifCount: 0
    }),
    props:['user'],

    computed: {
      profile_size () {
        switch (this.$vuetify.breakpoint.name) {
          case 'xs': return '400px'
          case 'sm': return '400px'
          case 'md': return '400px'
          case 'lg': return '600px'
          case 'xl': return '700px'
        }
      },
    },
    methods:{
      logout() {
        sessionStorage.clear();
        window.location.replace('/')
      },
      markAsRead(){
        axios.put('api/notification/read/',
        {
          id: this.userId
        });
        this.notifCount=0
      },
      refresh(){
        if (sessionStorage.getItem('id'))
        {
          setTimeout(function()
          {
              sessionStorage.clear();
              window.location.replace('/')
          },100000)
        }
      }
    },
    created() {
      if (sessionStorage.getItem('type') == "admin"){
          this.admin = true
        }
        else{
          this.admin =  false
          this.code = sessionStorage.getItem('code')
        }
        axios.get('api/notification/getUnreadNotifs', {
        params: {
          id: this.userId
        }
      }).then(response=>{
        this.allNotifications=response.data.dta;
      })
      this.notifCount = this.allNotifications.length
      
      // this.refresh()
      // document.addEventListener('click', this.refresh)
      // document.addEventListener('mousemove', this.refresh)
      // document.addEventListener('keypress', this.refresh)
    },
    beforeRouteEnter (to, from, next) {
      if (!sessionStorage.getItem('id')) {
          return next('login');
      }

      if (sessionStorage.getItem('status') == 'Inactive'){
        return next('/activate')
      }
      next();
    }
}
</script>
