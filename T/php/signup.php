<?php
  if(isset($_POST)){
    // print_r($_POST);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    if(empty($name) || empty($email) || empty($password)){
        echo 'inser all value';
    }else{
        
        require_once('config.php');

        $sql = "INSERT INTO users (name, email, password) VALUES ('{$name}', '{$email}', '{$password}')";

        $result = mysqli_query($conn, $sql);

        if($result){
            $sql2 = "SELECT id,name,email from users WHERE email = '{$email}' AND password = '{$password}'  ";
            $result2 = mysqli_query($conn,$sql2);
            
            if($result2){
                $user = mysqli_fetch_assoc($result2);
                session_start();
                $_SESSION['user'] = $user;
                echo json_encode($user);
            }
        }

    }
  }