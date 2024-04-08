<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Methods\Clases;
use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\RolM;
use ProyectoSC502\Model\Methods\ClasesM;

class ClassesPageController
{
    private $usuarioM;
    private $rolM;
    private $clasesM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->rolM = new RolM();
        $this->clasesM = new ClasesM();
    }
   

    function SetClassesData($class)
{
    $classReturn = [
        "id_clase" => $class->getIdClase(),
        "id_usuario" => $class->getIdUsuario(),
        "usuario" => $this->usuarioM->view($class->getIdUsuario())->getUsername(),
        "hora_inicio" => $class->getHoraInicio(),
        "hora_fin" => $class->getHoraFin(),
        "dia" => $class->getDia(),
        "nombre_clase" => $class->getNombreClase(),
        "id_categoria" => $class->getIdCategoria()
    ];
    return $classReturn;
}



function Index()
{
    $current_page = 'ClassesPage';
    $user_id = $_SESSION['user_id'];
    $usuarioM = new UsuarioM();
    $current_user = $usuarioM->view($user_id);
    $userFullName = $current_user->getFullName();
    $userRole = $current_user->getIdRol();
    $userImagePath = $current_user->getRutaImagen();
    require_once './View/views/private/ClassesPage.php';
}
}
