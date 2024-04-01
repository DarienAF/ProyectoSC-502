<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Usuario;
use ProyectoSC502\Model\Methods\UsuarioM;

class SignUpPageController {
    private $usuarioM;
    private $newUser;
    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->newUser = new Usuario();
    }

    function Index()
    {
        $current_page = 'SignUpPage';
        require_once './View/views/public/SignUpPage.php';

    }

    // Crea un nuevo usuario e inicia sesión
    function SignUp()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $this->newUser->setUsername($data['username']);
        $this->newUser->setPassword($data['password']);
        $this->newUser->setNombre($data['firstName']);
        $this->newUser->setApellidos($data['lastName']);
        $this->newUser->setCorreo($data['email']);
        $this->newUser->setTelefono($data['phone']);
        $this->newUser->setRutaImagen("https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg");
        $this->newUser->setActivo(1);
        $this->newUser->setIdRol(4);
        $this->newUser->setPasswordFlag(0);

        if (!$this->usuarioM->emailExists($this->newUser->getCorreo())) {
            if (!$this->usuarioM->usernameExists($this->newUser->getUsername())) {
                if ($this->usuarioM->create($this->newUser)) {
                    $userCreated = $this->usuarioM->userLogin($this->newUser->getUsername());
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
