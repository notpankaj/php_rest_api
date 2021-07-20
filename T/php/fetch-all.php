<?php

require_once 'config.php';

session_start();

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

    $sql = "SELECT * FROM posts WHERE user_id = '{$user_id}' ";

    $result = mysqli_query($conn ,$sql);
    if( mysqli_num_rows($result) > 0 ){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);
    };

}else{
    echo json_encode(['response' => 'login to see record']);
}