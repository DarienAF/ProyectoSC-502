<?php
session_start();
require_once './Model/Connection.php';

class SignUpPageController {

    function Index()
    {
        require_once './View/SignUpPage.php';
    }
}
