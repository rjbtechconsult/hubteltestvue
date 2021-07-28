<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubtel | Welcome to the Hubtel UX/UI Engeneering test.</title>
    <link rel="shortcut icon" type="image" href="assets/images/favicon.png" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/scss/style.css">
</head>
<body>

    <div id="app">
        <div class="welcome d-flex container">
            <span class="m-auto d-flex justify-content-center flex-column align-items-center">
                <a :href="homeLink">
                    <img class="welcome-logo" :src="images.logo" alt="">
                </a>
                <h1 class="text">{{text}}</h1>
            </span>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        var app = new Vue({
            el:'#app',
            data:{
                title:'',
                homeLink:'./',
                text:'Welcome',
                images:{
                    logo:'assets/images/logo.svg'
                }
            },
            
        });
    </script>

</body>
</html>
