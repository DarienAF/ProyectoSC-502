<?php
session_start();
require_once './Model/Connection.php';

class IndexPageController {

    function Index()
    {
        if(isset($_GET['controller']))
            $current_page = basename($_GET['controller']);
        require_once './View/LandingPage.php';
    }
}
