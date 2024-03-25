<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class ProfilePageController
{

    function Index()
    {
        $current_page = 'ProfilePage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);

        $userImagePath = $current_user->getRutaImagen();
        $username = $current_user->getUsername();
        $userRole = $current_user->getIdRol();
        $userFullName = $current_user->getFullName();
        $userFirstName = $current_user->getNombre();
        $userLastName = $current_user->getApellidos();
        $userEmail = $current_user->getCorreo();
        $userPhone = $current_user->getTelefono();
        $userPassword = $current_user->getPassword();

        require_once './View/views/private/ProfilePage.php';
    }
}
