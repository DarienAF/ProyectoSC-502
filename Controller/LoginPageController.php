<?php
session_start();
require_once './Model/Connection.php';

class LoginPageController {

    function Index()
    {
        // Get the current page name
        $current_page = 'LoginPage';

        if (isset($_SESSION['user'])) {
            $current_user = $_SESSION['user'];
            require_once './View/LoginPage.php';
        } else {
            $current_user = null;
            require_once './View/LoginPage.php';
        }
    }

    function LogIn()
    {
        $user = $_POST["user"];
        $pass = $_POST["password"];


        if($user == "prueba")
            //validar el pass
            if ($pass == "1234")
            {
                $_SESSION['user']=$user;
                header("Location:./index.php?controller=IndexPage&action=Index");
            }
            else
                header("Location:./index.php?controller=LoginPage&action=index");
        else
            header("Location:./index.php?controller=LoginPage&action=index");
    }

    function LogOut()
    {
        session_destroy();
        header("Location:./index.php?controller=LoginPage&action=index");
    }

}
