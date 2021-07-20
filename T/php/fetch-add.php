<?php

require_once 'config.php';
$input = file_get_contents('php://input');

$decode = json_decode($input,true);
$post_body = $decode['postBody'];

session_start();

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

        $sql = "INSERT INTO posts (body, user_id) VALUES ('$post_body','{$user_id}') ";
        $result = mysqli_query($conn ,$sql);
        if($result){
            echo json_encode(['insert' => 'insert successfully']);
        };
 

}else{
    echo json_encode(['response' => 'login to isnert record']);
}