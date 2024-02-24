<?php
session_start();
require_once './Model/Connection.php';

class IndexPageController
{

    function Index()
    {
        $current_page = 'IndexPage';

        if (isset($_SESSION['user'])) {
            $current_user = $_SESSION['user'];
            require_once './View/HomePage.php';
        } else {
            $current_user = null;
            require_once './View/LandingPage.php';
        }


    }
}
