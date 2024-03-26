<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class TrainingPlanPageController
{

    function Index()
    {
        $current_page = 'TrainingPlanPage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        require_once './View/views/private/TrainingPlanPage.php';
    }
}
