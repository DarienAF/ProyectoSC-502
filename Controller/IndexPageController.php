<?php
session_start();
require_once './Model/Connection.php';

class IndexPageController {

    function Index()
    {
        require_once './View/LandingPage.php';
    }
}
