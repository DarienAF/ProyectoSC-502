<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class LoginPageController
{
    function Index()
    {
        $current_page = 'LoginPage';
        require_once './View/views/public/LoginPage.php';

    }

    function LogIn()
    {
        $usuarioM = new UsuarioM(); // Crea una instancia de la clase UsuarioM.

        // Obtiene los datos enviados en formato JSON y los convierte en un array asociativo.
        $data = json_decode(file_get_contents('php://input'), true);


        $username = $data['usuario'];
        $password = $data['contrasena'];

        $usuario = $usuarioM->userLogin($username);


        if ($usuario) {
            if ($usuario->getActivo()) {
                if (password_verify($password, $usuario->getPassword())) {
                    $response = ['success' => true, 'message' => '¡Usuario validado exitosamente!'];
                    $_SESSION['nombre'] = $usuario->getNombre() . " " . $usuario->getApellidos();
                    $_SESSION['usuario'] = $usuario->getUsername();
                    $_SESSION['rol'] = $usuario->getIdRol();
                } else {
                    $response = ['success' => false, 'error' => 'contraseña', 'icon' => 'error', 'message' => 'Contraseña incorrecta'];
                }
            } else {
                $response = ['success' => false, 'error' => 'usuario', 'icon' => 'warning', 'message' => 'Usuario no se encuentra activo. Contacte a la administración.'];
            }
        } else {
            $response = ['success' => false, 'error' => 'usuario', 'icon' => 'error', 'message' => 'Usuario incorrecto'];
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
