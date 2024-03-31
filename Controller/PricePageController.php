<?php

namespace ProyectoSC502\Controller;

session_start();

class PricePageController {
    function Index()
    {
        $current_page = 'PricePage';
        require_once './View/views/public/PricePage.php';

    }
}
