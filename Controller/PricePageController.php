<?php
session_start();
require_once './Model/Connection.php';
require_once  './Model/Methods/UsuarioM.php';

class PricePageController {

    function Index()
    {
        $current_page = 'PricePage';
        require_once './View/views/public/PricePage.php';

    }
}
