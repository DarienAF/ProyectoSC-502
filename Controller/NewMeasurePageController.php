<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/MedidasM.php';


class NewMeasurePageController
{

    function Index()
    {
        // Get the current page name
        $current_page = 'NewMeasurePage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            require_once './View/views/private/NewMeasurePage.php';
        } else {
            $current_user = null;
            require_once './View/views/private/LandingPage.php';
        }
    }
}
