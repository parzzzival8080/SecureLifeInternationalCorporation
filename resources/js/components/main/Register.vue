<template>
    <v-layout row>
        <v-layout xs12 md10 lg10 justify-center >
            <v-card width="900px" :class="{'my-5': $vuetify.breakpoint.mdAndUp}">
                <!-- Header --> 
                 <v-toolbar height="150px" column>
                        <v-img src="img/banner.png"></v-img>
                        <v-icon large>person_add</v-icon>
                        <v-toolbar-title>Register</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                <!-- Form -->
                    <!-- Tabs -->
                    <v-tabs centered transparent icons-and-text grow >
                        <v-tabs-slider color="amber darken-3"></v-tabs-slider>
                        
                        <!-- Tab for Diamond -->
                        <v-tab href="#tab-1">
                            Diamond Account
                            <v-icon>fas fa-gem</v-icon>
                        </v-tab>

                        <!-- Tab for Bronze -->
                        <v-tab href="#tab-2">
                            Bronze Account
                            <v-icon>device_hub</v-icon>
                        </v-tab>
                        
                        <!-- Tab Value for Diamond -->
                        <v-tab-item :value="'tab-' + 1">
                            <v-card flat>
                                <v-card-text>
                                    <v-form>
                                        <v-container grid-list-sm bt-0>
                                            <!-- Name -->
                                            <v-layout row wrap>
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="lname" type="text" label="Last Name" v-model="lastname" required autofocus prepend-inner-icon="account_circle"/>
                                                        </v-flex>
                                                        <v-flex xs12 md5>
                                                            <v-text-field outline id="fname" type="text" label="First Name" v-model="firstname" required />
                                                        </v-flex>
                                                        <v-flex xs12 md1>
                                                            <v-text-field outline id="mi" type="text" label="M.I" v-model="mi" />
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Password -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline id="password" :type="show1 ? 'text' : 'password'" @click:append="show1 = !show1" :append-icon="show1 ? 'visibility' : 'visibility_off'" label="Password" v-model="password" required prepend-inner-icon="lock"/>
                                                </v-flex>
                                                <!-- Confirm Password -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline id="password-confirm" :type="show2 ? 'text' : 'password'" @click:append="show2 = !show2" :append-icon="show2 ? 'visibility' : 'visibility_off'" label="Confirm Password" v-model="password_confirmation" required prepend-inner-icon="lock"/>
                                                </v-flex>
                                                <!-- Address -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline id="address" type="text" label="Address" v-model="address" required prepend-inner-icon="location_on"/>
                                                </v-flex>
                                                <!-- Email and Contact -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="email" type="email" label="Email Address" v-model="email" required prepend-inner-icon="alternate_email"/>
                                                        </v-flex>

                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="contactno" type="text" label="Contact Number" v-model="contact" required prepend-inner-icon="phone" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Birthdate and Sponsor Id -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="sponsor" type="text" label="Sponsor" v-model="sponsor" required prepend-inner-icon="group_add"/>
                                                        </v-flex>
                                                        
                                                        <v-flex xs12 md6>
                                                            <v-dialog ref="dialogfrom" v-model="modal" :return-value.sync="birthdate" persistent lazy full-width width="290px">
                                                                <template v-slot:activator="{ on }">
                                                                    <v-text-field outline v-model="birthdate" label="Birthdate" prepend-inner-icon="event" v-on="on"></v-text-field>
                                                                </template>
                                                                <v-date-picker v-model="birthdate" scrollable>
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                                                                    <v-btn flat color="primary" @click="$refs.dialogfrom.save(birthdate)">OK</v-btn>
                                                                </v-date-picker>
                                                            </v-dialog>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                        <v-flex xs12 md12>
                                            <v-btn large round outline type="submit" color="amber darken-3" @click="registerDiamond"> Register</v-btn>
                                        </v-flex>
                                    </v-form>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>

                        <!-- Tab Value for Bronze -->
                        <v-tab-item :value="'tab-' + 2">
                            <v-card flat>
                                <v-card-text>
                                    <v-form>
                                        <v-container grid-list-sm bt-0>
                                            <!-- Name -->
                                            <v-layout row wrap>
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="lname" type="text" label="Last Name" v-model="lastname" required autofocus prepend-inner-icon="account_circle"/>
                                                        </v-flex>
                                                        <v-flex xs12 md5>
                                                            <v-text-field outline id="fname" type="text" label="First Name" v-model="firstname" required />
                                                        </v-flex>
                                                        <v-flex xs12 md1>
                                                            <v-text-field outline id="mi" type="text" label="M.I" v-model="mi" />
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Password -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline id="password" :type="show1 ? 'text' : 'password'" @click:append="show1 = !show1" :append-icon="show1 ? 'visibility' : 'visibility_off'" label="Password" v-model="password" required prepend-inner-icon="lock"/>
                                                </v-flex>
                                                <!-- Confirm Password -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline id="password-confirm" :type="show2 ? 'text' : 'password'" @click:append="show2 = !show2" :append-icon="show2 ? 'visibility' : 'visibility_off'" label="Confirm Password" v-model="password_confirmation" required prepend-inner-icon="lock"/>
                                                </v-flex>
                                                <!-- Address -->
                                                <v-flex xs12 md12>
                                                    <v-text-field outline id="address" type="text" label="Address" v-model="address" required prepend-inner-icon="location_on"/>
                                                </v-flex>
                                                <!-- Email and Contact -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="email" type="email" label="Email Address" v-model="email" required prepend-inner-icon="alternate_email"/>
                                                        </v-flex>

                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="contactno" type="text" label="Contact Number" v-model="contact" required prepend-inner-icon="phone" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Birthdate and Sponsor Id -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="sponsor" type="text" label="Sponsor" v-model="sponsor" required prepend-inner-icon="group_add"/>
                                                        </v-flex>
                                                        
                                                        <v-flex xs12 md6>
                                                            <v-dialog ref="dialogfrom" v-model="modal" :return-value.sync="birthdate" persistent lazy full-width width="290px">
                                                                <template v-slot:activator="{ on }">
                                                                    <v-text-field outline v-model="birthdate" label="Birthdate" prepend-inner-icon="event" v-on="on"></v-text-field>
                                                                </template>
                                                                <v-date-picker v-model="birthdate" scrollable>
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                                                                    <v-btn flat color="primary" @click="$refs.dialogfrom.save(birthdate)">OK</v-btn>
                                                                </v-date-picker>
                                                            </v-dialog>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <!-- Placement ID and Position -->
                                                <v-flex xs12 md12>
                                                    <v-layout row wrap>
                                                        <v-flex xs12 md6>
                                                            <v-text-field outline id="placement" type="text" label="Placement-ID" v-model="placement" required prepend-inner-icon="device_hub"/>
                                                        </v-flex>

                                                        <v-flex xs12 md6>
                                                            <v-select outline id="position" label="Position" :items="types" item-text="text" item-value="value" v-model="position" required prepend-inner-icon="code"/>
                                                             <!-- <v-select :items="items" label="Outline style" outline required prepend-inner-icon="code"></v-select> -->
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                        <v-flex xs12 md12>
                                            <v-btn large round outline type="submit" color="amber darken-3" @click="registerBronze"> Register</v-btn>
                                        </v-flex>
                                    </v-form>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>
                    </v-tabs>
                </v-card-text>
            </v-card>
        </v-layout>
    </v-layout>
</template>
<script>
    export default {
        data(){
            return {
                name : "",
                lastname : "",
                firstname : "",
                mi : "",
                email : "",
                password : "",
                password_confirmation : "",
                address: "",
                sponsor: "", //who invited this user
                contact: "(+63)",
                birthdate: "",
                position: '',
                placement: '',
                // birthdate: new Date().toISOString().substr(0, 10),  
                activationcode: "", //given by admin
                show1: false, //hide password text
                show2: false, //hide confirm password text
                modal: false, //for birthday modal
                types: ['Left', 'Right']
            }
        },
        methods : {
            registerDiamond(e) {
                e.preventDefault()
                //if password is same as confirm password and length is at least 8
                if (!this.password === this.password_confirmation && !this.password.length >= 8)
                {
                    this.password = ""
                    this.passwordConfirm = ""
                    swal.fire(
                        'Warning!',
                        'Passwords don\'t match',
                        'error'
                    )
                    return false
                }

                //submit data to User Controller
                if (this.mi.trim() == '')
                {
                    this.name = this.firstname + " " + this.lastname
                }
                else
                {   
                    this.name = this.firstname + " " + this.mi + ". " + this.lastname
                }
                axios.post('api/user/registerDiamond', {
                    name: this.name,
                    firstname: this.firstname,
                    lastname: this.lastname,
                    mi: this.mi,
                    email: this.email,
                    password: this.password,
                    c_password : this.password_confirmation,
                    photo: 'https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png', //user pic
                    type: 'User',
                    status: 'Inactive', //set user as inactive to direct to Activate.vue
                    address: this.address,
                    sponsor: this.sponsor, //who invited this user
                    contact: this.contact, 
                    birthdate: this.birthdate,
                    activationcode: this.activationcode, //code from admin
                })
                .then(response => {
                    if (response.data.success){
                        swal.fire({
                            allowOutsideClick: false,
                            title: 'Thankyou!',
                            text: 'You have successfully registered',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result)=>{
                            if(result.value){
                                localStorage.setItem('id',response.data.success.id) //to check if there is a logged in user
                                localStorage.setItem('type',response.data.success.type) //to check if admin or user
                                localStorage.setItem('photo',response.data.success.photo) //to compare update profile (avoid duplicate of photo)
                                localStorage.setItem('name',response.data.success.name) //for display in side nav
                                localStorage.setItem('code',response.data.success.code) //for display in side nav
                                localStorage.setItem('status',response.data.success.status) //determine routing: Inactive=>Activate.vue, Active=>dashboard

                                //if there is logged in
                                if (localStorage.getItem('id') != null){
                                    this.$router.go('/dashboard')
                                }
                            }
                        })
                    }
                    else{
                        swal.fire(
                            'Warning!',
                            response.data.error,
                            'warning'
                        )
                    }
                })
                .catch(error => {
                    this.code = ""
                    swal.fire(
                        'Error!',
                        error.message,
                        'error'
                    )
                });
            },
            registerBronze(){
                e.preventDefault()
                //if password is same as confirm password and length is at least 8
                if (!this.password === this.password_confirmation && !this.password.length >= 8)
                {
                    this.password = ""
                    this.passwordConfirm = ""
                    swal.fire(
                        'Warning!',
                        'Passwords don\'t match',
                        'error'
                    )
                    return false
                }

                //submit data to User Controller
                if (this.mi.trim() == '')
                {
                    this.name = this.firstname + " " + this.lastname
                }
                else
                {   
                    this.name = this.firstname + " " + this.mi + ". " + this.lastname
                }
                axios.post('api/user/registerBronze', {
                    name: this.name,
                    firstname: this.firstname,
                    lastname: this.lastname,
                    mi: this.mi,
                    email: this.email,
                    password: this.password,
                    c_password : this.password_confirmation,
                    photo: 'https://res.cloudinary.com/tim0923/image/upload/v1565588396/SecureLife/profile_pictures/user_wvwscz.png', //user pic
                    type: 'User',
                    status: 'Inactive', //set user as inactive to direct to Activate.vue
                    address: this.address,
                    sponsor: this.sponsor, //who invited this user
                    contact: this.contact, 
                    birthdate: this.birthdate,
                    activationcode: this.activationcode, //code from admin
                    placement: this.placement, //code from admin
                    position: this.position, //code from admin
                })
                .then(response => {
                    if (response.data.success){
                        swal.fire({
                            allowOutsideClick: false,
                            title: 'Thankyou!',
                            text: 'You have successfully registered',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result)=>{
                            if(result.value){
                                localStorage.setItem('id',response.data.success.id) //to check if there is a logged in user
                                localStorage.setItem('type',response.data.success.type) //to check if admin or user
                                localStorage.setItem('photo',response.data.success.photo) //to compare update profile (avoid duplicate of photo)
                                localStorage.setItem('name',response.data.success.name) //for display in side nav
                                localStorage.setItem('code',response.data.success.code) //for display in side nav
                                localStorage.setItem('status',response.data.success.status) //determine routing: Inactive=>Activate.vue, Active=>dashboard

                                //if there is logged in
                                if (localStorage.getItem('id') != null){
                                    this.$router.go('/dashboard')
                                }
                            }
                        })
                    }
                    else{
                        swal.fire(
                            'Warning!',
                            response.data.error,
                            'warning'
                        )
                    }
                })
                .catch(error => {
                    this.code = ""
                    swal.fire(
                        'Error!',
                        error.message,
                        'error'
                    )
                });
            }
        },
        beforeRouteEnter (to, from, next) {
            //if user is logged in, direct to dashboard
            if (localStorage.getItem('id')) {
                return next('dashboard');
            }

            next();
        }
    }
</script>