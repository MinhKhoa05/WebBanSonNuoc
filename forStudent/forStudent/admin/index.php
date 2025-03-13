<?php
session_start();
include_once 'model/config.php';
include_once 'model/user.php';
include 'view/header.php';
    $action="home";
    if(isset($_GET['act']))
        $action=$_GET['act'];
    if(!isset($_SESSION['admin']))
    {
        $action="login";
    }
    switch($action)
    {
        case "home":
            include 'view/home.php';
            break;
        case "login":
            if(isset($_POST['btn_submit']))
            {
                $email=$_POST['username'];
                $pass=$_POST['password'];
                if(CheckLogin($email,$pass)==true)
                {
                    $_SESSION['admin']=$email;
                    header("location: index.php");
                }
                else
                {
                    include 'view/login.php';
                }
            }
            else
            {
                include 'view/login.php';
            }
            break;
        case "logout":
            unset($_SESSION['admin']);
            header("location: index.php");
            break;
        case "cate":
            include 'view/catalog.php';
            break;
        case "product":
            include 'view/product.php';
            break;

    }
include 'view/footer.php';

?>