<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class ClassesPageController
{

    function Index()
    {
        $current_page = 'ClassesPage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        require_once './View/views/private/ClassesPage.php';
    }
}
