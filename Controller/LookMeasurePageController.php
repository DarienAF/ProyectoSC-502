<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Entities\Medidas;
use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\MedidasM;

class LookMeasurePageController
{
    private $usuarioM;
    private $medidasM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->medidasM = new MedidasM();
    }

    function Index()
    {
        $current_page = 'LookMeasurePage';

        // Carga datos del usuario actual.
        $user_id = $_SESSION['user_id'];
        $current_user = $this->usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        $userMeasures = [];

        if ($userRole != 4) {
            foreach ($this->medidasM->viewAll() as $measure) {
                $userMeasures[] = $this->SetMeasuresData($measure);
            }
            require_once './View/views/private/MeasurePages/LookMeasurePage.php';
        } else {
            foreach ($this->medidasM->viewUserMeasures($user_id) as $measure) {
                $userMeasures[] = $this->SetMeasuresData($measure);
            }
            require_once './View/views/private/MeasurePages/LookMeasurePageMembers.php';
        }
    }

    function SetMeasuresData($measure): array
    {
        return [
            "id_medida" => $measure->getIdMedida(),
            "id_Usuario" => $measure->getIdUsuario(),
            "usuario" => $this->usuarioM->view($measure->getIdUsuario())->getUsername(),
            "fecha" => $measure->getFechaRegistro(),
            "peso" => $measure->getPeso(),
            "altura" => $measure->getAltura(),
            "edad" => $measure->getEdad(),
            "grasa" => $measure->getGrasa(),
            "musculo" => $measure->getMusculo()
        ];
    }

    public function createMeasure()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $medidaNueva = new Medidas();
        $usuarioMedida = $this->usuarioM->view($data['measureUserID']);

        if ($usuarioMedida) {
            $medidaNueva->setIdUsuario($data['measureUserID']);
            $medidaNueva->setPeso($data['weight']);
            $medidaNueva->setAltura($data['height']);
            $medidaNueva->setEdad($data['age']);
            $medidaNueva->setGrasa($data['fat']);
            $medidaNueva->setMusculo($data['muscle']);


            if ($this->medidasM->create($medidaNueva)) {
                $response = ['success' => true, 'message' => '¡Registro Correcto!'];
            } else {
                $response = ['success' => false, 'message' => '¡Registro Fallido!'];
            }

        } else {
            $response = ['success' => false, 'message' => 'Usuario no existe'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function updateMeasure()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data)) {
            $medidaActualizada = new Medidas();
            $medidaActualizada->setIdMedida($data['measureId']);
            $medidaActualizada->setIdUsuario($data['measureUserID']);
            $medidaActualizada->setAltura($data['weight']);
            $medidaActualizada->setPeso($data['height']);
            $medidaActualizada->setEdad($data['age']);
            $medidaActualizada->setGrasa($data['fat']);
            $medidaActualizada->setMusculo($data['muscle']);

            $usuario = $this->usuarioM->view($data['measureUserID']);
            $medidaOriginal = $this->medidasM->view($data['measureId']);

            if ($usuario && $medidaOriginal) {
                $updateResult = $this->medidasM->update($medidaActualizada, $medidaOriginal);
                if ($updateResult) {
                    $response = ['success' => true, 'changed' => true, 'message' => 'Medida actualizada con éxito', "Usuario" => $usuario->getUsername()];
                } else {
                    $response = ['success' => true, 'changed' => false, 'message' => 'No se agregaron cambios a la Medida'];
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

    public function MemberUsers()
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

    public function getMeasureUpdate()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $medida = $this->medidasM->view($data['id_medida']);

        if ($medida) {
            $response = $this->SetMeasuresData($medida);
        } else
            $response = null;

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
