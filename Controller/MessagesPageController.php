<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Entities\Mensajes;
use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\RolM;
use ProyectoSC502\Model\Methods\MensajesM;


class MessagesPageController
{
    private $usuarioM;
    private $rolM;
    private $MensajesM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->rolM = new RolM();
        $this->MensajesM = new MensajesM();
    }

    function Index()
    {
        $current_page = 'MessagesPage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $userImagePath = $current_user->getRutaImagen();
        require_once './View/views/private/MessagesPage.php';
    }

    // Obtiene datos de un mensaje específico
    public function getMessageData()
    {
        if (isset($_POST['messageId'])) {
            $messageId = $_POST['messageId'];
            $message = $this->MensajesM->view($messageId);

            if ($message != null) {
                $response = $message->toArray();
            } else {
                $response = ['error' => 'Mensaje no encontrado'];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'messageId no proporcionado']);
        }
    }

    // Activa un mensaje (que ha sido leido)
    public function activate()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['messageId'])) {
            $messageId = $data['messageId'];
            $this->MensajesM->setReadStatus($messageId, 1);
            $response = ['success' => true, 'icon' => 'success', 'title' => '¡Mensaje Leido!', 'text' => 'leido'];
        } else {
            $response = ['success' => false, 'message' => 'messageId no proporcionado'];
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

    function SetMessageData($message)
    {
        $messageReturn = [
            "id_mensaje" => $message->getIdMensaje(),
            "nombreM" =>  $message->getNombre(),
            "correo" =>  $message->getCorreo(),
            "titulo" =>  $message->getTitulo(),
            "contexto" =>  $message->getContexto(),
            "fecha_envio" =>  $message->getFechaEnvio(),
            "leido" => $message->getLeido()
        ];
        return $messageReturn;

    }

}
