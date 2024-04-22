<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Entities\Reservaciones;
use ProyectoSC502\Model\Methods\ReservacionesM;
use ProyectoSC502\Model\Methods\ClasesM;

class ReservesPageController
{
    private $usuarioM;
    private $reservacionM;
    private $claseM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->reservacionM = new ReservacionesM();
        $this->claseM = new ClasesM();
    }

    function Index()
    {
        $current_page = 'ReservesPage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();

        $bookings = $this->reservacionM->viewAll();

        $claseM = new ClasesM();

        $classes = $this->claseM->viewAll();

        require_once './View/views/private/ReservesPage.php';
    }

    public function activate()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['bookingId'])) {
            $bookingId = $data['bookingId'];
            $this->reservacionM->setCancelStatus($bookingId, 1);
            $response = ['success' => true, 'icon' => 'success', 'title' => '¡Reserva Activada!', 'text' => 'activado'];
        } else {
            $response = ['success' => false, 'message' => 'bookingId no proporcionado'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function deactivate()
    {
        $data = json_decode(file_get_contents('php://input'), true);


        if (isset($data['bookingId'])) {
            $bookingId = $data['bookingId'];
            $this->reservacionM->setCancelStatus($bookingId, 0);
            $response = ['success' => true, 'icon' => 'success', 'title' => '¡Reserva Cancelada!', 'text' => 'activado'];
        } else {
            $response = ['success' => false, 'message' => 'bookingId no proporcionado'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function getBookingData()
    {
        if (isset($_POST['bookingId'])) {
            $bookingId = $_POST['bookingId'];
            $booking = $this->reservacionM->view($bookingId);

            $user = $this->usuarioM->view($booking->getIdUsuario());
            $username = $user->getFullName();
            $user_id = $user->getIdUsuario();

            $cls = $this->claseM->view($booking->getIdClase());
            $dia = $cls->getDia();


            if ($booking != null) {
                $response = $booking->toArray();
                $response['username'] = $username;
                $response['dia'] = $dia;
                $response['user_id'] = $user_id;
            } else {
                $response = ['error' => 'Reserva no encontrada'];

            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'bookingId no proporcionado']);
        }
    }


    public function updateBooking()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['bookingId'], $data['classId'], $data['userId'])) {
            $reservaActualizada = new Reservaciones();
            $reservaActualizada->setIdReserva($data['bookingId']);
            $reservaActualizada->setIdClase($data['classId']);
            $reservaActualizada->setIdUsuario($data['userId']);

            $reservaOriginal = $this->reservacionM->view($data['bookingId']);

            if ($reservaActualizada->getIdClase() !== $reservaOriginal->getIdClase()) {
                $updateResult = $this->reservacionM->update($reservaActualizada, $reservaOriginal);

                if ($updateResult) {
                    $response = ['success' => true, 'changed' => true, 'message' => 'Reserva actualizada con éxito'];
                } else {
                    $response = ['success' => false, 'changed' => false, 'message' => '¡Selecciona otra clase. La clase ya ha sido reservada por el usuario!'];
                }
            } else {
                $response = ['success' => false, 'error' => 'correo', 'message' => '¡Selecciona otra clase. La clase ya ha sido reservada por el usuario!'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Por favor selecciona una clase para modificar la reservación'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

}