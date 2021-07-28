<?php
    $_POST = json_decode(file_get_contents("php://input"),true);
    if(isset($_POST['phoneNumber'])){
        session_start();
        $_SESSION['otp'] = "12345";
        $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
        $response['status'] = true;
        echo json_encode($response);
    }else{
        $response['status'] = false;
        echo json_encode($response);
    }
?>