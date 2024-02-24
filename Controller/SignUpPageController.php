<?php
session_start();
require_once './Model/Connection.php';

class SignUpPageController {

    function Index()
    {
        // Get the current page name
        $current_page = 'SignUpPage';

        if (isset($_SESSION['user'])) {
            $current_user = $_SESSION['user'];
            require_once './View/SignUpPage.php';
        } else {
            $current_user = null;
            require_once './View/SignUpPage.php';
        }

    }
}
