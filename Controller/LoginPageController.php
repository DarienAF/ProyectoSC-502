<?php
session_start();
require_once './Model/Connection.php';
require_once  './Model/Methods/UsuarioM.php';


class LoginPageController {

    function Index()
    {
        // Get the current page name
        $current_page = 'LoginPage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            require_once './View/views/public/LoginPage.php';
        } else {
            $current_user = null;
            require_once './View/views/public/LoginPage.php';
        }
    }

    function LogIn()
    {
        $usuarioM = new UsuarioM();

        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['usuario']) && isset($data['contrasena'])) {
            $username = $data['usuario'];
            $password = $data['contrasena'];

            $usuario = $usuarioM->UserLogin($username);

            if ($usuario) {
                // Asumiendo que $password es la contraseña ingresada por el usuario y está disponible en este contexto
                if (password_verify($password, $usuario->getPassword())) {
                    $response = ['success' => true, 'message' => '¡Usuario validado exitosamente!'];
                    $_SESSION['usuario'] = $usuario->getNombre()." ".$usuario->getApellidos();
                    $_SESSION['rol'] = $usuario->getIdRol();
                } else {
                    $response = ['success' => false, 'message' => 'Contraseña incorrecta'];
                }
            } else {
                $response = ['success' => false, 'message' => 'Usuario incorrecto'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Rellene las credenciales'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function LogOut()
    {
        session_destroy();
        header("Location:./index.php?controller=LoginPage&action=index");
    }

}
