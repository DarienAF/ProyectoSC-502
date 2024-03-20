<?php
session_start();
require_once './Model/Connection.php';

require_once  './Model/Methods/MensajesM.php';
require_once  './Model/Entities/Mensajes.php';


class ContactPageController
{

    function Index()
    {
        // Get the current page name
        $current_page = 'ContactPage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            require_once './View/views/public/ContactPage.php';
        } else {
            $current_user = null;
            require_once './View/views/public/ContactPage.php';
        }
    }

    function Contact()
    {
        $mensajesM = new MensajesM();
        $data = json_decode(file_get_contents('php://input'), true);

        $nombrem = $data['nombre'];
        $correo = $data['correo'];
        $titulo = $data['titulo'];
        $contexto = $data['contexto'];
    
        $mensajesNuevo = new Mensajes();

        $mensajesNuevo->setNombreM($nombrem);
        $mensajesNuevo->setCorreo($correo);
        $mensajesNuevo->setTitulo($titulo);
        $mensajesNuevo->setContexto($contexto);
        //$mensajesNuevo->setFechaEnvio( 'now() ');
        $mensajesNuevo->setLeido(0);
    
        // Guardar el mensaje en la base de datos
        if ($mensajesM->Create($mensajesNuevo)){
            $response = ['success' => true, 'message' => '¡Mensaje enviado correctamente!'];
        } else{
            $response = ['success' => false, 'message' => '¡Error al enviar el mensaje!'];
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);

}

}