<?php
session_start();
require_once './Model/Connection.php';
require_once  './Model/Methods/UsuarioM.php';
require_once  './Model/Entities/Usuario.php';
class SignUpPageController {

    function Index()
    {
        // Get the current page name
        $current_page = 'SignUpPage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            require_once './View/views/public/SignUpPage.php';
        } else {
            $current_user = null;
            require_once './View/views/public/SignUpPage.php';
        }
    }

    function SignUp()
    {
        $usuarioM = new UsuarioM();
        $data = json_decode(file_get_contents('php://input'), true);

        $nombre     = $data['nombre'    ];
        $apellidos  = $data['apellidos' ];
        $correo     = $data['correo'    ];
        $usuario    = $data['usuario'   ];
        $numero     = $data['numero'    ];
        $contraseña = $data['contraseña'];

        $usuarioNuevo = new Usuario();

        $usuarioNuevo->setUsername  ($usuario  );
        $usuarioNuevo->setPassword  ($contraseña  );
        $usuarioNuevo->setNombre    ($nombre    );
        $usuarioNuevo->setApellidos ($apellidos );
        $usuarioNuevo->setCorreo    ($correo    );
        $usuarioNuevo->setTelefono  ($numero  );
        $usuarioNuevo->setRutaImagen("./View/img/users/default_user.png");
        $usuarioNuevo->setActivo    (1    );
        $usuarioNuevo->setIdRol     (4);

        if (!$usuarioM->emailExists($usuarioNuevo->getCorreo())){
            if (!$usuarioM->usernameExists($usuarioNuevo->getUsername())){
                if ($usuarioM->Create($usuarioNuevo)){
                    $response = ['success' => true, 'message' => '¡Registro Correcto!'];
                    $_SESSION["usuario"] = $nombre." ".$apellidos;
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
