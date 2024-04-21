<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Entities\Reservaciones;
use ProyectoSC502\Model\Entities\Usuario;
use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\ReservacionesM;
use ProyectoSC502\Model\Methods\MedidasM;

class ReportsPageController
{
    private $usuarioM;
    private $reservacionesM;
    private $medidasM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->reservacionesM = new ReservacionesM();
        $this->medidasM = new MedidasM();
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
        $usuarioM = new UsuarioM();
        $actividad = $usuarioM->traerActividadGrafico();
    
        echo json_encode($actividad);
    }
    
}
