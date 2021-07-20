<?php


require_once 'config.php';


session_start();

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

        $post_id = $_GET['delId'];
        $sql = "DELETE FROM posts WHERE id = '{$post_id}' AND user_id = '{$user_id}' ";

        $result = mysqli_query($conn ,$sql);
        if($result){
            echo json_encode(['delete' => 'delete successfully']);
        };
 

}else{
    echo json_encode(['response' => 'login to delet record']);
}