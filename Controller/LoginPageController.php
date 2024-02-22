<?php
session_start();
require_once './Model/Connection.php';

class LoginPageController {

    function Index()
    {
        // Get the current page name
        $current_page = basename($_GET['controller']);
        require_once './View/LoginPage.php';
    }

}
