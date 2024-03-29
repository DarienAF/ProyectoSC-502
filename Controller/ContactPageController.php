<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/MensajesM.php';
require_once './Model/Entities/Mensajes.php';


class ContactPageController
{

    function Index()
    {
        $current_page = 'ContactPage';
        require_once './View/views/public/ContactPage.php';

    }

    function Contact()
    {
        $mensajesM = new MensajesM();
        $data = json_decode(file_get_contents('php://input'), true);

        $fullNameMsg = $data['fullNameMsg'];
        $emailMsg = $data['emailMsg'];
        $titleMsg = $data['titleMsg'];
        $contextMsg = $data['contextMsg'];

        $newMessage = new Mensajes();

        $newMessage->setNombreM($fullNameMsg);
        $newMessage->setCorreo($emailMsg);
        $newMessage->setTitulo($titleMsg);
        $newMessage->setContexto($contextMsg);
        $newMessage->setLeido(0);

        // Guardar el mensaje en la base de datos
        if ($mensajesM->Create($newMessage)) {
            $response = ['success' => true, 'message' => '¡Mensaje enviado correctamente!'];
        } else {
            $response = ['success' => false, 'message' => '¡Error al enviar el mensaje!'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);

    }

}