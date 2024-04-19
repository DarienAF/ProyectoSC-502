<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Entities\Usuario;
use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Entities\Planes;
use ProyectoSC502\Model\Entities\PlanEjercicios;
use ProyectoSC502\Model\Methods\PlanesM;
use ProyectoSC502\Model\Methods\PlanEjerciciosM;
use ProyectoSC502\Model\Methods\EjerciciosM;

class TrainingPlanPageController
{

    private $planesM;
    private $planEjerciciosM;
    private $usuariosM;
    private $ejerciciosM;

    public function __construct()
    {
        $this->planesM = new PlanesM();
        $this->planEjerciciosM = new PlanEjerciciosM();
        $this->usuariosM = new UsuarioM();
        $this->ejerciciosM = new EjerciciosM();
    }

    function Index()
    {
        $current_page = 'TrainingPlanPage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        $planExercises = $this->planEjerciciosM->viewAll();
        $plans = $this->planesM->viewAll();
        require_once './View/views/private/TrainingPlanPage.php';
    }

    public function getMiembros()
    {
        $usuarioM = new UsuarioM();
        $response = [];
        foreach ($usuarioM->viewAll() as $usuario) {
            if ($usuario->getIdRol() == 4 && $usuario->getActivo() == 1) {
                $response[] = [
                    'id' => $usuario->getIdUsuario(),
                    'nombre' => $usuario->getNombre(),
                    'apellidos' => $usuario->getApellidos()
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getEjercicios()
    {
        $ejerciciosM = new EjerciciosM();
        $response = [];
        foreach ($ejerciciosM->viewAll() as $ejercicio) {
            $response[] = [
                'id_ejercicio' => $ejercicio->getIdEjercicio(),
                'nombre_ejercicio' => $ejercicio->getNombreEjercicio(),
                'grupo_muscular' => $ejercicio->getGrupoMuscular(),
                'url_imagen' => $ejercicio->getImagenEjercicio()
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function createExercisePlan()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $planEjercicios = new PlanEjercicios();
        $planEjercicios->setIdEjercicio($data['selectedExerciseId']);
        $planEjercicios->setSeries($data['series']);
        $planEjercicios->setRepeticiones($data['repetitions']);

        $idPlanEjercicio = $this->planEjerciciosM->create($planEjercicios);

        if ($idPlanEjercicio) {
            $plan = new Planes();
            $usuario = $this->usuariosM->view($data['selectedUserId']);
            $plan->setNombrePlan("Rutina " . $data['day'] . " - " . $usuario->getFullName());
            $plan->setIdUsuario($usuario->getIdUsuario());
            $plan->setIdPlanEjercicio($idPlanEjercicio);
            $plan->setDia($data['day']);
            if ($this->planesM->create($plan)) {
                $response = ['success' => true, 'message' => '¡Plan creado correctamente!'];
            } else {
                $response = ['success' => false, 'message' => '¡Plan no se puedo crear correctamente id!'];
            }
        } else {
            $response = ['success' => false, 'message' => '¡Plan de ejercicios no se puedo crear correctamente!'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}