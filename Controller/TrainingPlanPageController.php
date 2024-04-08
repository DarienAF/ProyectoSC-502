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
        require_once './View/views/private/TrainingPlanPage.php';
    }

    public function SetPlanData($plan)
    {
        $planReturn = [
            "id_plan" => $plan->getIdPlan(),
            "id_usuario" => $plan->getIdUsuario(),
            "nombre_usuario" => $this->usuariosM->view ($plan->getIdUsuario())->getUsername(),
            "nombre_plan" => $plan->getNombrePlan(),
            "dia" => $plan->getDia()
        ];
        return $planReturn;
    }

public function SetPlanExerciseData($planExercise)
    {
        $planExerciseReturn = [
            "id_plan" => $planExercise->getIdPlan(),
            "id_ejercicio" => $planExercise->getIdEjercicio(),
            "nombre_ejercicio" => $this->ejerciciosM->view($planExercise->getIdEjercicio())->getNombreEjercicio(), 
            "series" => $planExercise->getSeries(),
            "repeticiones" => $planExercise->getRepeticiones()
        ];
        return $planExerciseReturn;
    }

    public function createPlan()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $planNuevo = new Planes();
        $usuarioPlan = $this->usuariosM->view($data['PlanUserID']);

        if ($usuarioPlan) {
            $planNuevo->setIdUsuario($usuarioPlan->getIdUsuario());
            $planNuevo->setNombrePlan($data['planName']);
            $planNuevo->setDia($data['day']);

            if ($this->planesM->create($planNuevo)) {
                $response = ['success' => true, 'message' => '¡Plan creado correctamente!'];
            } else {
                $response = ['success' => false, 'message' => '¡No se pudo crear el plan!'];
            }
        } else {
            $response = ['success' => false, 'message' => '¡El usuario especificado para el plan no existe!'];
        }

        // Respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function createPlanExercise()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $planEjercicioNuevo = new PlanEjercicios();
        $planUsuario = $this->usuariosM->view($data['planUserID']);
        $ejercicio = $this->ejerciciosM->view($data['exerciseID']);

        if ($planUsuario && $ejercicio) {
            $planEjercicioNuevo->setIdPlan($data['planID']);
            $planEjercicioNuevo->setIdEjercicio($data['exerciseID']);
            $planEjercicioNuevo->setSeries($data['series']);
            $planEjercicioNuevo->setRepeticiones($data['repetitions']);

            if ($this->planEjerciciosM->create($planEjercicioNuevo)) {
                $response = ['success' => true, 'message' => '¡Registro Correcto!'];
            } else {
                $response = ['success' => false, 'message' => '¡Registro Fallido!'];
            }
        } else {
            $response = ['success' => false, 'message' => 'El usuario o el ejercicio no existe'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function MemberUsers()
    {
        $um = new UsuarioM();
        $response = [];
        foreach ($um->viewAll() as $usuario) {
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

    public function updatePlan()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data)) {
            $planActualizado = new Planes();
            $planActualizado->setIdPlan($data['planId']);
            $planActualizado->setIdUsuario($data['userId']);
            $planActualizado->setNombrePlan($data['planName']);
            $planActualizado->setDia($data['day']);

            $usuario = $this->usuariosM->view($data['userId']);
            $planOriginal = $this->planesM->view($data['planId']);

            if ($usuario && $planOriginal) {
                $updateResult = $this->planesM->update($planActualizado, $planOriginal);
                if ($updateResult) {
                    $response = ['success' => true, 'changed' => true, 'message' => 'Plan actualizado con éxito', "Usuario" => $usuario->getUsername()];
                } else {
                    $response = ['success' => true, 'changed' => false, 'message' => 'No se agregaron cambios al Plan'];
                }
            } else {
                $response = ['success' => false, 'message' => 'Faltan datos'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Faltan datos'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function updatePlanExercise()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data)) {
            $planExerciseActualizado = new PlanEjercicios();
            $planExerciseActualizado->setIdPlan($data['planId']);
            $planExerciseActualizado->setIdEjercicio($data['exerciseId']);
            $planExerciseActualizado->setSeries($data['series']);
            $planExerciseActualizado->setRepeticiones($data['repetitions']);

            $planExistente = $this->planesM->view($planExerciseActualizado->getIdPlan());
            $exerciseExistente = $this->ejerciciosM->view($planExerciseActualizado->getIdEjercicio());
            $planExerciseOriginal = $this->planEjerciciosM->view($data['planId'], $data['exerciseId']);

            if ($planExistente && $exerciseExistente && $planExerciseOriginal) {
                $updateResult = $this->planEjerciciosM->update($planExerciseActualizado, $planExerciseOriginal);
                if ($updateResult) {
                    $response = ['success' => true, 'changed' => true, 'message' => 'Registro de ejercicio en el plan actualizado con éxito'];
                } else {
                    $response = ['success' => true, 'changed' => false, 'message' => 'No se agregaron cambios al registro de ejercicio en el plan'];
                }
            } else {
                $response = ['success' => false, 'message' => 'El plan, el ejercicio o el registro de ejercicio en el plan no existen'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Faltan datos'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

        public function getPlanUpdate()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Obtener los detalles del plan desde el modelo
        $plan = $this->planesM->view($data);

        if ($plan) {
            // Formatear los datos del plan
            $formattedPlan = $this->SetPlanData($plan);

            // Devolver los datos formateados como respuesta
            $response = ['success' => true, 'plan_details' => $formattedPlan];
        } else {
            // Si no se encuentra el plan, devolver una respuesta indicando que no se encontraron datos
            $response = ['success' => false, 'message' => 'No se encontraron detalles del Plan'];
        }

        //Respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getPlanExerciseUpdate()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $planExercise = $this->planEjerciciosM->view($data['planId'], $data['exerciseId']);

        if ($planExercise) {
            // Formatear los datos del PlanEjercicios
            $formattedPlanExercise = $this->SetPlanExerciseData($planExercise);

            // Devolver los datos formateados como respuesta
            $response = ['success' => true, 'plan_exercise_details' => $formattedPlanExercise];
        } else {
            // Si no se encuentra el PlanEjercicios, devolver una respuesta indicando que no se encontraron datos
            $response = ['success' => false, 'message' => 'No se encontraron detalles del PlanEjercicios'];
        }

        // Enviar la respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }






}
