<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\ReservacionesM;
use ProyectoSC502\Model\Methods\ClasesM;

class ReservesPageController
{
    private $usuarioM;
    private $reservacionM;
    private $claseM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->reservacionM = new ReservacionesM();
        $this->claseM = new ClasesM();

    }

    function Index()
    {
        $current_page = 'ReservesPage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        $bookings = $this->reservacionM->viewAll();
        $claseM = new ClasesM();

        require_once './View/views/private/ReservesPage.php';
    }
}