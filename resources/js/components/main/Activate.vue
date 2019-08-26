<template>
    <v-layout mt-5 row>
        <v-layout mt-5 xs12 md10 lg10 justify-center>
            <v-card width="600px">
                <v-toolbar height="150px" column>
                    <v-img src="img/banner.png"></v-img>
                </v-toolbar>
                <v-card-text>
                    Available Keys:
                    <p v-for="(thisrequest, index) in keys" :key="index">{{thisrequest.key}} - {{thisrequest.pin}}</p>
                    <v-form>

                        <v-flex xs12 md12>
                            <v-text-field outline id="code" type="code" label="Pin Code" v-model="pin" required autofocus prepend-inner-icon="dialpad"/>
                        </v-flex>

                        <v-flex xs12 md12>
                            <v-text-field outline id="code" type="code" label="Activation Code" v-model="code" required autofocus prepend-inner-icon="dialpad"/>
                        </v-flex>

                        <v-flex class="justify-center layout px-0" xs12 md12>
                            <v-btn large round outline type="submit" color="amber darken-3" @click="submitCode">Activate Account</v-btn>
                        </v-flex>
                        
                    </v-form>
                    <v-flex xs12 md12 row justify-center align-center>
                        <v-divider></v-divider>
                        <p class="display-1">OR</p>
                        <v-divider></v-divider>
                    </v-flex>

                    Pending Requests:
                    <p v-for="(thisrequest, index) in requests" :key="index">
                        <v-icon medium color="red" @click="cancelRequest(thisrequest.id)" v-if="thisrequest.status == 'pending'">
                            close
                        </v-icon>
                        <v-btn @click="openRequest(thisrequest)">{{thisrequest.created_at}} - {{thisrequest.status}}</v-btn>
                    </p>
                    <v-form>

                        <v-flex xs12 md12>
                            <v-text-field outline id="investment" type="investment" label="Amount" v-model="investment" required autofocus prepend-inner-icon="dialpad"/>
                        </v-flex>

                        <input type="file" id="imgupload" style="display:none" @change="UploadPicture"/> 
                        
                        <div class="row">
                            <v-btn class="mx-2" @click.prevent="openFileDialog" icon>
                                <v-icon size="22px">photo</v-icon>
                            </v-btn>

                            <v-text-field id="proof" type="proof" v-model="proof" readonly/>
                        </div>

                        <v-flex class="justify-center layout px-0" xs12 md12>
                            <v-btn large round outline type="submit" color="amber darken-3" @click="submitProof">Upload Proof of Payment</v-btn>
                        </v-flex>
                    </v-form>
                </v-card-text>
            </v-card>
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
                code : "",
                pin : "",
                proof: "",
                image: "",
                keys: [],
                requests: [],
                PicDialog: false,
                pic: '',
                investment: '',
                requestinvestment: ''
            }
        },
        methods : {
            cancelRequest(id){
                axios.put('api/proof/cancelRequest',
                {
                    id: id
                })
                window.location.reload();
            },
            openRequest(data){
                this.PicDialog = true
                this.pic = data.request_image
                this.requestinvestment = data.investment
            },
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
            submitCode(e){
                e.preventDefault()
                if (sessionStorage.getItem('reference_id'))
                {
                    axios.get('api/key/checkKey/', {
                        params: {
                            userid: sessionStorage.getItem('id'),
                            key: this.code,
                            pin: this.pin,
                            name: sessionStorage.getItem('name'),
                            email: sessionStorage.getItem('email'),
                            reference_id: sessionStorage.getItem('reference_id'),
                            referal_id: sessionStorage.getItem('referal_id'),
                            position: sessionStorage.getItem('position'),
                            user_id: sessionStorage.getItem('id'),
                        }
                    }).then(response => {
                        if(!response.data.data){
                            swal.fire("Failed!",
                            "It seems you have entered a wrong key. Enter again",
                            "error")
                            return false
                        }
                    })
                    sessionStorage.setItem('status', 'Active')
                    swal.fire({
                        allowOutsideClick: false,
                        title: 'Congratulations!',
                        text: 'Succesfully Activated',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result)=>{
                        if(result.value){
                            this.$router.go('/dashboard')
                        }
                    })
                    return false
                }
                //check if key entered is not yet activated
                axios.get('api/key/checkKey/', {
                    params: {
                        userid: sessionStorage.getItem('id'),
                        key: this.code,
                        pin: this.pin,
                        name: sessionStorage.getItem('name'),
                        email: sessionStorage.getItem('email'),
                    }
                }).then(response => {
                    //check if key entered is bought by user
                    if(response.data.data){
                        axios.post('api/wallet/referralActivated',
                        {
                            id: sessionStorage.getItem('id'),
                            code: this.code,
                            name: sessionStorage.getItem('name')
                        })
                        sessionStorage.setItem('status', 'Active')
                        swal.fire({
                            allowOutsideClick: false,
                            title: 'Congratulations!',
                            text: 'Succesfully Activated',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result)=>{
                            if(result.value){
                                this.$router.go('/dashboard')
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
            submitProof(e){
                e.preventDefault()
                this.$Progress.start();
                if (this.investment == 0 || this.investment%20000!=0 || this.proof.trim() == '')
                {
                    if (this.investment == 0 || this.investment%20000!=0)
                    {
                        swal.fire('Oops!', 'Investment must be multiple of P20,000.00', 'error')
                    }
                    else if (this.proof.trim() == '')
                    {
                        swal.fire('Oops!', 'Upload your proof of payment', 'error')
                    }
                    return false
                }
                //check if key entered is not yet activated
                axios.post('api/proof',{
                    name: sessionStorage.getItem('name'),
                    user_id: sessionStorage.getItem('id'),
                    image: this.image,
                    investment: this.investment,
                    status: 'pending',
                    }
                ).then(response => {
                    if(response.data.data){
                        this.$Progress.finish();
                        swal.fire({
                        allowOutsideClick: false,
                        title: 'Thank you!',
                        text: 'Succesfully Requested for a key',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                        }).then((result)=>{
                            if(result.value){
                                this.$router.go('/dashboard')
                            }
                        })
                    }
                    else{
                        swal.fire("Failed!",
                        "Try again",
                        "error")
                        this.$Progress.fail();
                    }
                })
            }
        },
        created(){
            axios.get('api/key/getMyKeys',
            {
                params:{
                    id: sessionStorage.getItem('id')
                }
            })
            .then(response =>
            {
                this.keys = response.data;
            })
            axios.get('api/proof/getMyRequests',
            {
                params:{
                    id: sessionStorage.getItem('id')
                }
            })
            .then(response =>
            {
                this.requests = response.data;
            })
        },
        beforeRouteEnter (to, from, next) {
            if (sessionStorage.getItem('status') == 'Active'){
                return next('/dashboard');
            }
            else if (!sessionStorage.getItem('id'))
            {
                return next('/');
            }

            next();
        }
    }
</script>