<?php
session_start();
require_once './Model/Connection.php';
require_once  './Model/Methods/UsuarioM.php';
require_once  './Model/Entities/Usuario.php';


class SignUpPageController {

    function Index()
    {
        $current_page = 'SignUpPage';
        require_once './View/views/public/SignUpPage.php';

    }

    function SignUp()
    {
        $usuarioM = new UsuarioM();
        $data = json_decode(file_get_contents('php://input'), true);

        $newUser = new Usuario();

        $newUser->setUsername($data['username']);
        $newUser->setPassword($data['password']);
        $newUser->setNombre($data['firstName']);
        $newUser->setApellidos($data['lastName']);
        $newUser->setCorreo($data['email']);
        $newUser->setTelefono($data['phone']);
        $newUser->setRutaImagen("./View/img/users/default_user.png");
        $newUser->setActivo(1);
        $newUser->setIdRol(4);
        $newUser->setPasswordFlag(0);


        if (!$usuarioM->emailExists($newUser->getCorreo())) {
            if (!$usuarioM->usernameExists($newUser->getUsername())) {
                if ($usuarioM->create($newUser)) {
                    $userCreated = $usuarioM->userLogin($newUser->getUsername());
                    $_SESSION['user_id'] = $userCreated->getIdUsuario();
                    $response = ['success' => true, 'message' => '¡Registro Correcto!'];
                } else{
                    $response = ['success' => false, 'message' => '¡Registro Fallido!'];
                }
            } else{
                $response = ['success' => false, 'error'=>'usuario', 'message' => '¡Usuario ya se encuentra en uso!'];
            }
        } else{
            $response = ['success' => false, 'error'=>'correo', 'message' => '¡Correo ya está registrado!'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
