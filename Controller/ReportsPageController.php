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
    
    public function obtenerClasesAsistidas() {
        $reservacionesM = new ReservacionesM();
        $clasesAsistidas = $reservacionesM->traerClasesAsistidas();
    
        $nombres_clases = array();
        $conteos = array();
    
        foreach ($clasesAsistidas as $clase) {
            $nombres_clases[] = $clase['nombre_clase'];
            $conteos[] = $clase['conteo'];
        }
    
        echo json_encode(array('nombres_clases' => $nombres_clases, 'conteos' => $conteos));
    }
    
    public function obtenerCategoriasAsistidas() {
        $reservacionesM = new ReservacionesM();
        $categoriasAsistidas = $reservacionesM->traerCategoriasAsistidas();
    
        $nombres_categorias = array();
        $cantidades_asistentes = array();
    
        foreach ($categoriasAsistidas as $categoria) {
            $nombres_categorias[] = $categoria['nombre_categoria'];
            $cantidades_asistentes[] = $categoria['cantidad_asistentes'];
        }
    
        echo json_encode(array('nombres_categorias' => $nombres_categorias, 'cantidades_asistentes' => $cantidades_asistentes));
    }

    public function obtenerPromedioPeso() {
        $medidasM = new MedidasM();
        $promediosPeso = $medidasM->obtenerPromedioPeso();
    
        $meses = array();
        $promedios = array();
    
        foreach ($promediosPeso as $promedio) {
            $meses[] = $promedio['mes'];
            $promedios[] = $promedio['promedio_peso'];
        }
    
        echo json_encode(array('meses' => $meses, 'promedios' => $promedios));
    }
    
    public function obtenerConteoRol() {
        $usuarioM = new UsuarioM();
        $conteoUsuariosPorRol = $usuarioM->contarUsuariosPorRol();
    
        $nombres_roles = array();
        $cantidades_usuarios = array();
    
        foreach ($conteoUsuariosPorRol as $conteo) {
            $nombres_roles[] = $conteo['nombre_rol'];
            $cantidades_usuarios[] = $conteo['cantidad_usuarios'];
        }
    
        echo json_encode(array('nombres_roles' => $nombres_roles, 'cantidades_usuarios' => $cantidades_usuarios));
    }
    

}
