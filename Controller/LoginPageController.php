<?php
session_start();
require_once './Model/Connection.php';
<<<<<<< HEAD
require_once  './Model/Methods/UsuarioM.php';


class LoginPageController {

    function Index()
    {
        // Get the current page name
        $current_page = 'LoginPage';

=======
require_once './Model/Methods/UsuarioM.php';

class LoginPageController {

    // Método para cargar la vista de la página de inicio de sesión.
    function Index()
    {
        $current_page = 'LoginPage';

        // Verifica si el usuario ya está en sesión.
>>>>>>> Darien
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
<<<<<<< HEAD
        $usuarioM = new UsuarioM();

        $data = json_decode(file_get_contents('php://input'), true);

=======
        $usuarioM = new UsuarioM(); // Crea una instancia de la clase UsuarioM.

        // Obtiene los datos enviados en formato JSON y los convierte en un array asociativo.
        $data = json_decode(file_get_contents('php://input'), true);

        // Verifica si se han enviado el usuario y la contraseña
>>>>>>> Darien
        if (isset($data['usuario']) && isset($data['contrasena'])) {
            $username = $data['usuario'];
            $password = $data['contrasena'];

            $usuario = $usuarioM->UserLogin($username);

            if ($usuario) {
<<<<<<< HEAD
                // Asumiendo que $password es la contraseña ingresada por el usuario y está disponible en este contexto
=======
>>>>>>> Darien
                if (password_verify($password, $usuario->getPassword())) {
                    $response = ['success' => true, 'message' => '¡Usuario validado exitosamente!'];
                    $_SESSION['usuario'] = $usuario->getNombre()." ".$usuario->getApellidos();
                    $_SESSION['rol'] = $usuario->getIdRol();
                } else {
<<<<<<< HEAD
                    $response = ['success' => false, 'message' => 'Contraseña incorrecta'];
                }
            } else {
                $response = ['success' => false, 'message' => 'Usuario incorrecto'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Rellene las credenciales'];
=======
                    $response = ['success' => false, 'error'=>'contraseña', 'message' => 'Contraseña incorrecta'];
                }
            } else {
                $response = ['success' => false,'error'=>'usuario', 'message' => 'Usuario incorrecto'];
            }
        } else {
            $response = ['success' => false, 'error'=>'ambos', 'message' => 'Rellene las credenciales'];
>>>>>>> Darien
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
