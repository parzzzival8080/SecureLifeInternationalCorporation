<template>
  <v-container fill-height fluid grid-list-xl>
    <v-layout justify-center wrap>
      <v-flex xs12 md8>
        <v-form>
          <v-container py-0>
            <v-layout wrap>
              <v-flex xs12 md12>
                <v-text-field class="purple-input" label="Name" v-model="name" prepend-inner-icon="account_circle" disabled/>
              </v-flex>
              <v-flex xs12 md12>
                <v-text-field label="Email Address" class="purple-input" v-model="email" prepend-inner-icon="alternate_email"/>
              </v-flex>
              <v-flex xs12 md12>
                <v-text-field label="Username" class="purple-input" v-model="username"/>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field label="Contact Number" class="purple-input" v-model="contact" prepend-inner-icon="phone"/>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-dialog ref="dialogfrom" v-model="modal" :return-value.sync="birthdate" persistent lazy full-width width="290px">
                  <template v-slot:activator="{ on }">
                    <v-text-field v-model="birthdate" label="Birthdate:" prepend-icon="event" readonly v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="birthdate" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialogfrom.save(birthdate); tryalert()">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-flex>
              <v-flex xs12 md12>
                <v-text-field label="Address" class="purple-input" v-model="address" prepend-inner-icon="location_on"/>
              </v-flex>
              <v-flex xs12 md12>
                <v-text-field v-model="password" :append-icon="show1 ? 'visibility' : 'visibility_off'" :rules="[rules.min]" :type="show1 ? 'text' : 'password'" label="Password" hint="At least 8 characters" counter @click:append="show1 = !show1" @keydown.space.prevent prepend-inner-icon="lock"></v-text-field>
              </v-flex>
              <v-flex xs12 text-xs-right >
                <v-btn class="mx-0 font-weight-light" color="success" @click="updateUser()">
                  Update Profile
                </v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-form>
      </v-flex>
      <v-flex xs12 md4>
        <input type="file" id="imgupload" style="display:none" @change="UploadPicture"/> 
        <v-avatar @click.prevent="openFileDialog" slot="offset" class="mx-auto d-block" size='130'>
          <img  :src="photo" />
        </v-avatar>
        <v-card-text class="text-xs-center">
          <h6 class="title text-gray font-weight-regular mb-3">{{name}}</h6>
        </v-card-text>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data(){
    return {
      id: sessionStorage.getItem('id'),
      name: sessionStorage.getItem('name'),
      email: sessionStorage.getItem('email'),
      address: sessionStorage.getItem('address'),
      contact: sessionStorage.getItem('contact'),
      birthdate: sessionStorage.getItem('birthdate'),
      password: '',
      username: '',
      modal: false,
      show1: false,
      photo: sessionStorage.getItem('photo'),
      rules: {
        min: v => v.length >= 8 || 'Min 8 characters'
      }
    }
  },
  methods:{
    openFileDialog(){
      $('#imgupload').trigger('click');
    },
    UploadPicture(e){
      let file = e.target.files[0];
      let reader = new FileReader();
      reader.onloadend = (file) => {
        this.photo = reader.result;
      }
      reader.readAsDataURL(file);
    },
    updateUser(){
      let nopic = true
      this.$Progress.start();
      if (this.photo != sessionStorage.getItem('photo')){
        nopic = false
      }
      if (this.password != ''){
        axios.put('api/user/'+this.id, {
          name: this.name,
          email: this.email,
          password: this.password,
          contact: this.contact,
          address: this.address,
          birthdate: this.birthdate,
          photo: this.photo,
          username: this.username,
          nopic: nopic
        })
        .then(response => {
          if (!nopic){
            sessionStorage.setItem('photo', response.data.path)
          }
          this.$Progress.finish();
          
          swal.fire({
            allowOutsideClick: false,
            title: 'Updated!',
            text: 'Your user has been updated.',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
            
          }).then((result)=>{
            if(result.value){
              window.location.reload();
            }
          })
        })
      }
      else{
        axios.put('api/user/'+this.id, {
          name: this.name,
          email: this.email,
          photo: this.photo,
          contact: this.contact,
          address: this.address,
          username: this.username,
          birthdate: this.birthdate,
          nopic: nopic
        })
        .then(response => {
          if (!nopic){
            sessionStorage.setItem('photo', response.data.path)
          }

          swal.fire({
            allowOutsideClick: false,
            title: 'Updated!',
            text: 'Your user has been updated.',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
          }).then((result)=>{
            if(result.value){
            this.$Progress.finish();

              window.location.reload();
            }
          })
        })
      }
    }
  },
  created() {
    axios.get('api/user/profile',
    {
      params:{
        id: this.id,
      }
    })
    .then(response =>
    {
      response.data.forEach(element => {
      this.name= element.name
      this.email= element.email
      this.photo= element.photo
      this.contact= element.contact
      this.address= element.address
      this.username= element.username
      this.birthdate= element.birthdate
      });
    })
  }
}
</script>