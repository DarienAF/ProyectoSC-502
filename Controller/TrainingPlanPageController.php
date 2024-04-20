<?php

namespace ProyectoSC502\Controller;

session_start();

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
    private $usuarioM;
    private $ejerciciosM;

    public function __construct()
    {
        $this->planesM = new PlanesM();
        $this->planEjerciciosM = new PlanEjerciciosM();
        $this->usuarioM = new UsuarioM();
        $this->ejerciciosM = new EjerciciosM();
    }

    function Index()
    {
        $current_page = 'TrainingPlanPage';

        // Carga datos del usuario actual.
        $user_id = $_SESSION['user_id'];
        $current_user = $this->usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        $planExercises = $this->planEjerciciosM->viewAll();
        if ($userRole != 4) {
            $plans = $this->planesM->viewAll();
            require_once './View/views/private/TrainingPlanPages/TrainingPlanPage.php';
        } else {
            require_once './View/views/private/TrainingPlanPages/TrainingPlanPageMembers.php';
        }
    }


    public function getPlanesByUser()
    {

        $response = [];
        foreach ($this->planesM->viewUserPlans($_SESSION['user_id']) as $plan) {

            $planEjercicio = $this->planEjerciciosM->view($plan->getIdPlanEjercicio());
            $ejercicio = $this->ejerciciosM->view($planEjercicio->getIdEjercicio());

            $response[] = [
                'id_plan' => $plan->getIdPlan(),
                'nombre_plan' => $plan->getIdPlanEjercicioName(),
                'dia' => $plan->getDia(),
                'nombre_ejercicio' => $ejercicio->getNombreEjercicio(),
                'informacion' => $planEjercicio->getSeries() . " series de " .
                    $planEjercicio->getRepeticiones() . " repeticiones cada una.",
                'imagen' => $ejercicio->getImagenEjercicio(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
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
        $response = [];
        foreach ($this->ejerciciosM->viewAll() as $ejercicio) {
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
            $usuario = $this->usuarioM->view($data['selectedUserId']);
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

    public function deletePlan()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $idPlanEjercicio = $this->planesM->view($data['planId'])->getIdPlanEjercicio();
        $succ2 = $this->planesM->delete($data['planId']);
        $succ1 = $this->planEjerciciosM->delete($idPlanEjercicio);
        if ($succ1 && $succ2) {
            $response = ['success' => true, 'message' => 'Plan eliminado con éxito.'];
        } else {
            $response = ['success' => false, 'message' => 'No se pudo eliminar el plan s1:' . $succ1 . " / s2:" . $succ2];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}