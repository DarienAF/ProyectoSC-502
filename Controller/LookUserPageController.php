<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';
require_once './Model/Methods/RolM.php';


class LookUserPageController
{
    private $usuarioM;
    private $rolM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->rolM = new RolM();
    }

    public function index()
    {
        $current_page = 'LookUserPage';

        // Carga datos del usuario actual y todos los usuarios y roles para la vista.
        $user_id = $_SESSION['user_id'];
        $current_user = $this->usuarioM->view($user_id);
        $userFullName = $current_user->getFullName();
        $userRole = $current_user->getIdRol();
        $users = $this->usuarioM->viewAll();
        $roles = $this->rolM->viewRolesNames();
        require_once './View/views/private/LookUserPage.php';
    }

    // Crea un nuevo usuario
    public function createUser()
    {
        $usuarioM = new UsuarioM();
        $data = json_decode(file_get_contents('php://input'), true);

        $usuarioNuevo = new Usuario();
        $usuarioNuevo->setIdRol($data['role']);
        $usuarioNuevo->setUsername($data['username']);
        $usuarioNuevo->setCorreo($data['email']);
        $usuarioNuevo->setNombre($data['firstName']);
        $usuarioNuevo->setApellidos($data['lastName']);
        $usuarioNuevo->setTelefono($data['phone']);
        $usuarioNuevo->setPassword($data['password']);
        $usuarioNuevo->setRutaImagen("./View/img/users/default_user.png");
        $usuarioNuevo->setActivo(1);
        $usuarioNuevo->setPasswordFlag(1);

        if (!$usuarioM->emailExists($usuarioNuevo->getCorreo())) {
            if (!$usuarioM->usernameExists($usuarioNuevo->getUsername())) {
                if ($usuarioM->create($usuarioNuevo)) {
                    $response = ['success' => true, 'message' => '¡Registro Correcto!'];
                } else {
                    $response = ['success' => false, 'message' => '¡Registro Fallido!'];
                }
            } else {
                $response = ['success' => false, 'error' => 'usuario', 'message' => '¡Usuario ya se encuentra en uso!'];
            }
        } else {
            $response = ['success' => false, 'error' => 'correo', 'message' => '¡Correo ya está registrado!'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Actualiza los datos de un usuario
    public function updateUser()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['username'], $data['firstName'], $data['lastName'], $data['email'], $data['phone'], $data['role'])) {
            $usuarioActualizado = new Usuario();
            $usuarioActualizado->setIdUsuario($data['userId']);
            $usuarioActualizado->setUsername($data['username']);
            $usuarioActualizado->setNombre($data['firstName']);
            $usuarioActualizado->setApellidos($data['lastName']);
            $usuarioActualizado->setCorreo($data['email']);
            $usuarioActualizado->setTelefono($data['phone']);
            $usuarioActualizado->setIdRol($data['role']);
            $usuarioActualizado->setPassword($data['password']);

            $usuarioOriginal = $this->usuarioM->view($data['userId']);

            if (!$this->usuarioM->emailExists($usuarioActualizado->getCorreo()) || $usuarioOriginal->getCorreo() == $usuarioActualizado->getCorreo()) {
                if (!$this->usuarioM->usernameExists($usuarioActualizado->getUsername()) || $usuarioOriginal->getUsername() == $usuarioActualizado->getUsername()) {
                    $updateResult = $this->usuarioM->update($usuarioActualizado, $usuarioOriginal);
                    $passwordUpdateResult = false;

                    if (!empty($data['password'])) {
                        $passwordUpdateResult = $this->usuarioM->updatePassword($data['userId'], $data['password'], true);
                    }

                    if ($updateResult || $passwordUpdateResult) {
                        $response = ['success' => true, 'changed' => true, 'message' => 'Usuario y contraseña actualizados con éxito'];
                    } else {

                        $response = ['success' => true, 'false' => true, 'message' => 'No se agregaron cambios al usuario'];
                    }
                } else {
                    $response = ['success' => false, 'error' => 'usuario', 'message' => '¡Nombre de usuario ya se encuentra en uso!'];
                }
            } else {
                $response = ['success' => false, 'error' => 'correo', 'message' => '¡Correo electrónico ya está registrado!'];
            }

        } else {
            $response = ['success' => false, 'message' => 'Faltan datos'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Obtiene datos de un usuario específico
    public function getUserData()
    {
        if (isset($_POST['userId'])) {
            $userId = $_POST['userId'];
            $usuario = $this->usuarioM->view($userId);

            if ($usuario != null) {
                $response = $usuario->toArray();
            } else {
                $response = ['error' => 'Usuario no encontrado'];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'userId no proporcionado']);
        }
    }

    // Obtiene todos los roles
    public function getRoles()
    {
        $rolM = new RolM();
        $roles = $rolM->viewAll();

        $rolesArray = [];
        foreach ($roles as $rol) {
            $rolesArray[] = [
                'id' => $rol->getIdRol(),
                'nombre' => $rol->getNombre(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($rolesArray);
    }

    // Activa un usuario
    public function activate()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['userId'])) {
            $userId = $data['userId'];
            $this->usuarioM->setActivationStatus($userId, 1);
            $response = ['success' => true, 'icon' => 'success', 'title' => '¡Usuario Activado!', 'text' => 'activado'];
        } else {
            $response = ['success' => false, 'message' => 'userId no proporcionado'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Desactiva un usuario
    public function deactivate()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['userId'])) {
            $userId = $data['userId'];
            $this->usuarioM->setActivationStatus($userId, 0);
            $response = ['success' => true, 'icon' => 'warning', 'title' => '¡Usuario Desactivado!', 'text' => 'desactivado'];
        } else {
            $response = ['success' => false, 'message' => 'userId no proporcionado'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

}
