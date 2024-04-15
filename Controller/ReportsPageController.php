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
        $actividad = $this->usuarioM->traerActividadGrafico();

        $miembros_activos = $actividad['miembros_activos'];
        $miembros_inactivos = $actividad['miembros_inactivos'];

        return json_encode(array('miembros_activos' => $miembros_activos, 
                                'miembros_inactivos' => $miembros_inactivos));
    }

    public function obtenerClases() {
        $clases = $this->reservacionesM->traerClasesAsistidas();
        
        $nombres_clases = array();
        $conteos = array();
    
        foreach ($clases as $clase) {
            $nombres_clases[] = $clase['nombre_clase'];
            $conteos[] = $clase['conteo'];
        }
    
        return json_encode(array('nombres_clases' => $nombres_clases, 
                                'conteos' => $conteos));
    }

    public function obtenerPromedio() {
        $pesos = $this->medidasM->traerPromedioPeso();

        $meses = array();
        $promedios = array();
    
        foreach ($pesos as $peso) {
            $meses[] = $peso['mes'];
            $promedios[] = $peso['promedio_peso'];
        }
        return json_encode(array('meses' => $meses, 'promedios' => $promedios));
    }

    public function obtenerCancelaciones() {
        $cancelaciones = $this->reservacionesM->traerClasesCanceladas();
       
        $nombres_clases = array();
        $conteos = array();
    
        foreach ($cancelaciones as $cancelacion) {
            $nombres_clases[] = $cancelacion['nombre_clase'];
            $conteos[] = $cancelacion['cancelaciones'];
        }
        return json_encode(array('nombres_clases' => $nombres_clases, 'cancelaciones' => $conteos));
    }
    
    
}
