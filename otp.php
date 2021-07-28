<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubtel | Enter OTP</title>
    <link rel="shortcut icon" type="image" href="assets/images/favicon.png" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/scss/style.css">

</head>
<body>

    <div id="app">
        <div class="login container">

            <span class="content col-md-8">
                <div class="row">
                    <div class="col-md-6 text-center d-flex flex-column left-col my-auto">

                        <div class="col-10 align-self-center login-header">
                            <a :href="homeLink">
                                <img class="logo mb-3" v-bind:src="images.logo" alt="">
                            </a>
                        </div>

                        <form id="otpForm" class="text-start"  @submit.prevent="submitOtpForm">
                            <div class="mb-3">

                                <label for="otp" class="form-label">OTP sent to +233 - {{phoneNumber}}</label>

                                <div class="input-group mb-4">
                                    <div class="input-group-text">HHYE - </div>
                                    <input type="text" v-on:input="validateOtp()" v-on:input="validateOtp()" v-model="otp" v-bind:class="{ 'is-invalid': !isValidOtp, 'is-valid': goodToGo }"  class="form-control" id="otp" placeholder="Enter code here" maxlength="5"  aria-describedby="otpHelp" required>
                                    <div class="invalid-feedback">
                                        {{errMsg}}
                                    </div>
                                </div>

                                <div class="d-grid mt-3">
                                    <button id="submit" :disabled="!otpIsValid" class="btn btn-primary mb-2" type="submit">Verify Code</button>
                                    <button class="btn btn-default" type="button">Resend Code</button>
                                </div>

                                <div class="login-footer d-block d-md-none">
                                    <p class="text-center text-small">
                                        {{getAppText}}
                                    </p>
                                    <div class="d-flex">
                                        <span class="mx-auto">
                                            <img class="me-1 googleplay-icon" :src="images.googleplayIcon" alt="">
                                            <img :src="images.googleplayText" alt="">
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 login-col-right d-none d-md-flex">
                        <div class="outer my-auto">
                            <div class="or d-none d-md-flex">OR</div>
                            <div class="inner text-center d-flex right-col">
                                <span class="my-auto">
                                    <img class="qr" src="assets/images/qr.svg" alt="">
                                    <p class="m-0">
                                        Do you have the Hubtel app?
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <strong>Sign in faster via QR code</strong>
                                    </p>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </span>

        </div>
    </div>
  

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

    var app = new Vue({
        el:"#app",
        data:{
            homeLink:'./',
            phoneNumber:null,
            getAppText:'Don’t have the app? Get it here',
            isValidOtp:true,
            goodToGo:false,
            otpIsValid:false,
            isNumeric:false,
            otp:'',
            errMsg:'Please enter a valid OTP code',
            images:{
                logo:'assets/images/logo.svg',
                googleplayIcon:'assets/images/Google_Play_Arrow_logo.png',
                googleplayText: 'assets/images/googleplaytext.svg',
                qrCode:'assets/images/qr.svg'
            },
        },
        methods:{
            validateOtp(){

                if (isNaN(this.otp)) {
                    this.isNumeric = false;
                    this.isValidOtp = false;
                    this.otp = this.otp.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                }else{
                    this.isNumeric = true;
                    this.isValidOtp = true;
                    let numLength = parseInt(this.otp.length);
                    numLength == 5 ? this.otpIsValid=true : this.otpIsValid=false;
                }
            },
            getPhoneNumber(){
                axios({
                        method: 'get',
                        url: 'api/get-phone.php',
                        headers: {'Authorization': 'Bearer ...'}
                    }).then((response)=>{
                        this.phoneNumber = response.data;
                    }) .catch((error) => {
                    }).finally(() => {
                    });
            },
            submitOtpForm(){
                axios({
                        method: 'post',
                        url: 'api/validate-otp.php',
                        data: {
                            otp: this.otp
                        },
                        headers: {'Authorization': 'Bearer ...'}
                    }).then((response)=>{
                        if (!response.data.valid) {
                            this.isValidOtp = false 
                        }else{
                            this.isValidOtp = true;
                            location.href="./welcome.php";
                        }
                    }) .catch((error) => {
                    }).finally(() => {
                    });
            }
        },
        beforeMount(){
            this.getPhoneNumber()
        },
        computed:{
            
        }
    });
</script>
</body>
</html>