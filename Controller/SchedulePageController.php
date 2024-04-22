<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\ReservacionesM;

class SchedulePageController
{

    private $reservacionesM;

    public function __construct()
    {
        $this->reservacionesM = new ReservacionesM();
    }
    function Index()
    {
        $current_page = 'SchedulePage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        require_once './View/views/private/SchedulePage.php';
    }

    public function getClassesByUser()
    {
        $response = [];
        $reservas = $this->reservacionesM->viewReservesbyUser($_SESSION['user_id']);

        foreach ($reservas as $reserva) {
            $response[] = [
                'id_reserva' => $reserva['id_reserva'],
                'nombre_usuario_reservado' => $reserva['nombre_usuario_reservado'],
                'nombre_usuario_profesor' => $reserva['nombre_usuario_profesor'],
                'hora_inicio' => $reserva['hora_inicio'],
                'hora_fin' => $reserva['hora_fin'],
                'dia' => $reserva['dia'],
                'nombre_clase' => $reserva['nombre_clase'],
                'nombre_categoria' => $reserva['nombre_categoria'],
                'apellidos_usuario_profesor' => $reserva['apellidos_usuario_profesor']
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function deactivate()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['bookingId'])) {
            $bookingId = $data['bookingId'];
            $this->reservacionesM->setCancelStatus($bookingId, 0);
            $response = ['success' => true, 'icon' => 'success', 'title' => '¡Reserva Cancelada!', 'text' => 'activado'];
        } else {
            $response = ['success' => false, 'message' => 'bookingId no proporcionado'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

}