<?php
    $_POST = json_decode(file_get_contents("php://input"),true);
    if(isset($_POST['otp'])){

        session_start();

        $response['status'] = true;

        if($_POST['otp']===$_SESSION['otp']){
            $response['valid']=true;
        }else{
            $response['valid']=false;
        }

        echo json_encode($response);

    }else{
        $response['status']=false;
        echo json_encode($response);
    }


?>