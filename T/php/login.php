<?php

if(isset($_POST)){

    
    $email = $_POST['email'];
    $password = $_POST['password'];
     
    if( empty($email) || empty($password)){
        echo 'inser all value';
    }else{
        
        require_once 'config.php';

        $sql = "SELECT id,name,email from users WHERE email = '{$email}' AND password = '{$password}'  ";
        $result = mysqli_query($conn,$sql);

        if($result){
            $user = mysqli_fetch_assoc($result);
            session_start();
        
            $_SESSION['user'] = $user;
            echo json_encode($user);
        }
    }    
}