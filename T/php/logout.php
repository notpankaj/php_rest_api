<?php
if($_POST){

    $logoutId = $_POST['user_id'];
    session_start();
    if($_SESSION['user']['id']  == $logoutId){
        unset($_SESSION['user']);
        echo " logout";
    }

}