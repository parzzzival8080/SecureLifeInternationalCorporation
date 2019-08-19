<template>
  <v-layout row>
    <v-flex xs12 lg10 md6 offset-md1>
      <v-card>
        <v-toolbar color="amber darken-3">
          <!-- Component Header -->
          <v-toolbar-title>User List</v-toolbar-title>
          <v-divider class="mx-2" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="newDialog()"> Add New 
            <v-icon medium>person_add</v-icon>
          </v-btn>
        </v-toolbar>
        <!-- Table Start -->
        <v-data-table :headers="headers" :items="users" class="elevation-1">
          <template slot="items" slot-scope="props">
            <td>{{ props.item.id }}</td>
            <td class="text-xs-left">{{ props.item.name }}</td>
            <td class="text-xs-left">{{ props.item.email }}</td>
            <td class="text-xs-left">{{ props.item.type | upText }}</td>
            <td class="text-xs-left">{{ props.item.created_at | myDate }}</td>
            <td class="justify-center layout px-0">
              <v-icon medium color="blue" @click="editDialog(props.item)">
                edit
              </v-icon>
              <v-divider inset vertical></v-divider>
              <v-icon medium color="red" @click="deleteUser(props.item.id)">
                delete
              </v-icon>
            </td>
          </template>
        </v-data-table>
      </v-card>
    </v-flex>
      <!-- Dialog -->
    <v-layout row justify-center>
      <v-dialog v-model="Userdialog" persistent max-width="500px">
        <v-card>
          <v-card-title class="headline" column>
            <p display-3 v-show="!editMode" id="addNewLabel">New User Information</p>
            <p display-3 v-show="editMode" id="addNewLabel">Update User Information</p>
            <v-spacer></v-spacer>
            <v-btn small fab @click="closeDialog()">
              <v-icon>close</v-icon>
            </v-btn>
          </v-card-title>
          <v-form v-model="valid" ref="form" lazy-validation>
            <v-card-text column align-center>
              <v-flex xs12 md10 lg10>
                <v-text-field class="purple-input" :rules="nameRules" label="Name" v-model="form.name"/>
              </v-flex>
              <v-flex xs12 md10 lg10>
                <v-text-field class="purple-input" :rules="emailRules" label="Email" v-model="form.email"/>
              </v-flex>
              <v-flex xs12 md10 lg10>
                <v-select class="purple-input" :items="types" :rules="typeRules" label="Type" v-model="form.type"></v-select>
              </v-flex>
              <v-flex xs12 md10 lg10>
                <v-text-field class="purple-input" label="Password" v-model="form.password"/>
              </v-flex>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn v-show="editMode" :disabled="!valid" color="green darken-1" flat @click="updateUser()" >Update</v-btn>
              <v-btn v-show="!editMode" :disabled="!valid" color="green darken-1" flat @click="createUser()">Save</v-btn>
              <v-btn type="button" color="red darken-1" flat @click="closeDialog()">Close</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-layout>
  </v-layout>
</template> 

<script>
    export default {
        data(){
            return {
              editMode: false,
              users: [],
              Userdialog: false,
              valid: false,
              form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    type: '',
                    photo: 'profile.png',
                    password: '',
                    status: 'Inactive'
              }),
              //For data table headers
              headers: [
                {text: 'Id', value: 'id'},
                {text: 'Name', value: 'name'},
                {text: 'Email', value: 'email'},
                {text: 'Type', value: 'role'},
                {text: 'Created', value: 'created_at'},
                {text: 'Actions', value: 'name', sortable: false},
              ],
              //For Select Type
              types: ['Admin', 'User'],
              //Rules for user input
              nameRules: [
                (v) => !!v || 'Name is required',
              ],
              emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
              ],
              typeRules: [
                (v) => !!v || 'Type is required'
              ],
            }
        },
        methods: {
          //this function will update the user
          updateUser(){
            if (this.$refs.form.validate()) {
              //console.log("Success");
              this.$Progress.start();
              this.form.put('api/user/'+this.form.id)
              .then(() => {
                swal.fire(
                  'Updated!',
                  'Your user has been updated.',
                  'success')
                custEvent.$emit('ReloadUser');
                this.$Progress.finish();
                this.closeDialog();
              })
              .catch(() => {
                  this.$Progress.fail();
              });
            }
          },
          editDialog(user){
            this.editMode = true;
            this.Userdialog = true;
            this.form.fill(user);
          },
          newDialog(){
            this.editMode = false;
            this.Userdialog = true;
          },
          closeDialog(){
            this.$refs.form.reset()
            this.$refs.form.resetValidation()
            this.Userdialog = false;
          },

          //this function will delete the user
          deleteUser(id){
            //This is the Dialog message
            swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            })
            //this is the condition if the condition is false
            .then((result) => {

              //Send req to server to delete thr user
              if (result.value){
                this.form.delete('api/user/'+id)
                .then(()=>{
                  //this is the pop out msg that the user is deleted
                  swal.fire(
                    'Deleted!',
                    'Your user has been deleted.',
                    'success')

                  //the custome event that will trigger the reload of user
                  custEvent.$emit('ReloadUser');
                }) 
              }                      
            })
            //this is the one that will catch if the process is error
            .catch(()=>{
              swal("Failed!", "There was something wrong.", "warning")
            })
          },
          //this function will load all the user
          loadUsers(){
            axios.get("api/user")
            .then(response =>{
              this.users=response.data.users
            })
          },
          //this function will create a user
          createUser(){
             if (this.$refs.form.validate()) {
                //this is the progress bar
                this.$Progress.start();
                //This will Req to the server
                this.form.post('api/user')
                .then(()=>{
                    //this is the custome event that will trigger the reload of user
                    custEvent.$emit('ReloadUser');
                    //this is the pop out msg if the process is successfull
                    swal.fire(
                        'Created!',
                        'Your user has been created.',
                        'success')
                    //this will end the progress bar
                    this.$Progress.finish();
                    this.closeDialog();
                  
                })
                .catch(()=>{
                    this.$Progress.fail();
                })
             }
          }
        },
        //this is there the component start
        created() { 
            this.loadUsers();

            //this is the listener of the custom event
            custEvent.$on('ReloadUser', () => {
                this.loadUsers();
            });
        },
      beforeRouteEnter (to, from, next) { 
          if (localStorage.getItem('type') != "admin") {
            return next('home');
          }
          next();
      }
    }
    import Form from 'vform';
</script>
