<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubtel | Login</title>
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
                            <a :href="links.homeLink">
                                <img class="logo mb-3" v-bind:src="images.logo" alt="">
                            </a>
                            <h2 class="d-block d-md-none font-weight-700">{{mobileHeader}}</h2>
                        </div>

                        <form id="loginForm" class="text-start needs-validation" @submit.prevent="submitForm">
                            <div class="mb-3">

                                <label for="number" class="form-label">{{inputLabel}}<span class="text-danger">*</span></label>
                                <div class="input-group mb-4">
                                    <div class="input-group-text">{{countryCode}} - </div>
                                    <input type="tel" name="phoneNumber" v-bind:class="{ 'is-invalid': !isNumeric }" class="form-control"  v-on:input="validateNumber()" v-model="mobileNumber" id="number" maxlength="10" aria-describedby="numberHelp">
                                    <div class="invalid-feedback">
                                        {{errMsg}}
                                    </div>
                                </div>
                            
                                <div class="d-grid mt-3">
                                    <button id="submit" class="btn btn-primary" :disabled="!numberIsValid" type="submit">Login</button>
                                </div>
                                <div class="text-center text-md-end mt-2">
                                    <small>{{helpText}}</small>
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
                                    <img class="qr" :src="images.qrCode" alt="">
                                    <p class="m-0">
                                        {{haveAppText}}
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <strong>{{signInFast}}</strong>
                                    </p>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </span>
        </div>
    </div>
    
  
    <!-- Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body d-flex flex-column justify-content-center">
                <span class="d-flex flex-column">
                    <span class="mx-auto mb-3">
                        <img class="info-icon" src="assets/images/info.svg" alt="">
                    </span>
                    <div class="mb-3 text-center">
                        <p class="mb-2">
                            (For Ghanaian users)
                        </p>
                        <p class="m-0">
                            Dial *713*90# to see the 4-digit OTP message to log in
                        </p>
                    </div>
                    <form action="./otp.php" class="col-11 col-md-10 align-self-center" id="otpForm">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Enter OTP Code</button>
                        </div>
                    </form>
                </span>
            </div>
        </div>
        </div>
    </div>
    
        
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        // const axios = require('https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js');

        var app = new Vue({
            el : '#app',
            data:{
                mobileHeader:'Sign in with your phone number',
                inputLabel:`Login with your number`,
                countryCode:'(+233)',
                errMsg:'Please enter a correct phone number',
                helpText:'Need help?',
                getAppText:'Don’t have the app? Get it here',
                haveAppText:'Do you have the Hubtel app?',
                signInFast:'Sign in faster via QR code',

                mobileNumber:'',
                numberIsValid:false,
                isNumeric:true,
                otpSent:false,
                otpModal:new bootstrap.Modal(document.getElementById('otpModal')),

                images:{
                    logo:'assets/images/logo.svg',
                    googleplayIcon:'assets/images/Google_Play_Arrow_logo.png',
                    googleplayText: 'assets/images/googleplaytext.svg',
                    qrCode:'assets/images/qr.svg'
                },
                links:{
                    homeLink:'./',
                    otpLink:'./otp.html',
                    welcomeLink:'./welcome.html'
                },
            },
            methods:{
                validateNumber(){
                    if (isNaN(this.mobileNumber)) {
                        this.isNumeric = false;
                        this.mobileNumber = this.mobileNumber.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                    }else{
                        this.isNumeric = true;
                        let numLength = parseInt(this.mobileNumber.length);
                        numLength == 10 ? this.numberIsValid=true : this.numberIsValid=false;
                    }
                },
                submitForm(){
                    axios({
                        method: 'post',
                        url: 'api/send-otp.php',
                        data: {
                            phoneNumber: this.mobileNumber
                        },
                        headers: {'Authorization': 'Bearer ...'}
                    }).then((response)=>{
                        console.log(response.data);
                        response.data.status ? this.otpModal.show() :this.otpModal.hide();
                    }) .catch((error) => {
                        // error.response.status Check status code
                    }).finally(() => {
                        //Perform action in always
                    });
                },
            },
            computed:{
                log(){
                    return console.log('My first Vue app.')
                }
            }
        });





        // $(function(){

        //     $('#number').on('input',function(){
        //         this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');

        //         let numLength = parseInt($(this).val().length);
        //         if(numLength == 10){
        //             $('#submit').attr('disabled',false);
        //         }else{
        //             $('#submit').attr('disabled',true);
        //         }

        //         let num = $(this).val();
        //         if(!$.isNumeric(num)){
        //             $('#number').addClass('is-invalid');
        //         }else{
        //             $('#number').removeClass('is-invalid');
        //         }
        //     })

        //     $('#loginForm').submit(function(e){
        //         e.preventDefault();
        //         let form = $(this);

        //         if($('#number').val()==""){
        //             $('#number').addClass('is-invalid');
        //         }else{
        //             let valid = validatePhoneNumber($('#number').val());
        //             if(valid){

        //                 $.ajax({
        //                     url: './api/send-otp.php',
        //                     dataType: "json",
        //                     type: "Post",
        //                     async: true,
        //                     data: {'phoneNumber':$('#number').val() },
        //                     success: function (response) {
        //                         if(response.status === true){
        //                             $('#number').removeClass('is-invalid');
        //                             $('#otpModal').modal('show');
        //                         }
        //                     },
        //                     error: function (xhr, exception) {
                                
        //                     }
        //                 }); 

                    
        //             }else{
        //                 $('#number').addClass('is-invalid');
        //             }
        //         }
        //     })

        //     // $('#otpForm').submit(function(e){
        //     //     e.preventDefault();
        //     //     location.href = "./otp.html"
        //     // })

        //     function validatePhoneNumber(input_str) {
        //         var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

        //         return re.test(input_str);
        //     }

        //     function phonenumber(inputtxt){
        //         var phoneno = /^\d{10}$/;
        //         if(inputtxt.value.match(phoneno)){
        //             return true;
        //         }else{
        //             return false;
        //         }
        //     }


        // });

    </script>
</body>
</html>