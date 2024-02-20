<?php
session_start();
require_once './Model/Connection.php';

class LoginPageController {

    function Index()
    {
        require_once './View/LoginPage.php';
    }

}
