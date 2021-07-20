<?php

require_once 'config.php';

$input = file_get_contents('php://input');
$decode = json_decode($input,true);

$post_id = $decode['post_id']; 
$post_body = $decode['post_body']; 

session_start();

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

    $sql = "UPDATE posts SET body = '{$post_body}' WHERE user_id = '{$user_id}' AND id = '{$post_id}' ";

    $result  = mysqli_query($conn,$sql);

    if($result){
        echo json_encode(['update' => 'success']);
    }else{
        echo json_encode(['update' => 'failed']);
    }

       

}else{
    echo json_encode(['response' => 'login to update record']);
}