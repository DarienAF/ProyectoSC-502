<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Entities\Usuario;
use ProyectoSC502\Model\Methods\UsuarioM;

class ReportsPageController
{
    private $usuarioM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
    }

    function Index()
    {
        $current_page = 'ReportsPage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        require_once './View/views/private/ReportsPage.php';
    }

    public function obtenerActividad() {
        $actividad = $this->usuarioM->traerActividadGrafico();

        $miembros_activos = $actividad['miembros_activos'];
        $miembros_inactivos = $actividad['miembros_inactivos'];

        return json_encode(array('miembros_activos' => $miembros_activos, 
                                'miembros_inactivos' => $miembros_inactivos));
    }

}
