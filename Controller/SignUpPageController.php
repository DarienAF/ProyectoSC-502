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

        $usuarioNuevo = new Usuario();
        $usuarioNuevo->setUsername($data['usuario']);
        $usuarioNuevo->setPassword($data['contrasena']);
        $usuarioNuevo->setNombre($data['nombre']);
        $usuarioNuevo->setApellidos($data['apellidos']);
        $usuarioNuevo->setCorreo($data['correo']);
        $usuarioNuevo->setTelefono($data['numero']);
        $usuarioNuevo->setRutaImagen("./View/img/users/default_user.png");
        $usuarioNuevo->setActivo(1);
        $usuarioNuevo->setIdRol(4);
        $usuarioNuevo->setPasswordFlag(0);

        if (!$usuarioM->emailExists($usuarioNuevo->getCorreo())){
            if (!$usuarioM->usernameExists($usuarioNuevo->getUsername())){
                if ($usuarioM->create($usuarioNuevo)) {
                    $response = ['success' => true, 'message' => '¡Registro Correcto!'];
                    $_SESSION["usuario"] = $data['usuario'];
                    $_SESSION["rol"] = 4;
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
