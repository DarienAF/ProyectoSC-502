<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Methods\UsuarioM;

class NewMeasurePageController
{
    function Index()
    {
        $current_page = 'NewMeasurePage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        require_once './View/views/private/NewMeasurePage.php';
    }
}
