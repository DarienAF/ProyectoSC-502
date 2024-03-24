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
        $current_user = $_SESSION['usuario'];
        $user_rol = $_SESSION['rol'];
        $users = $this->usuarioM->viewAll();
        $roles = $this->rolM->viewRolesNames();
        require_once './View/views/private/LookUserPage.php';
    }

    public function activate()
    {
        if (isset($_POST['userId'])) {
            $userId = $_POST['userId'];
            $this->usuarioM->activate($userId);
            $response = ['success' => true, 'icon' => 'success', 'title' => '¡Usuario Activado!', 'text' => 'activado'];
        } else {
            $response = ['success' => false, 'message' => 'userId no proporcionado'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function deactivate()
    {
        error_log(print_r($_POST, true));
        if (isset($_POST['userId'])) {
            $userId = $_POST['userId'];
            $this->usuarioM->deactivate($userId);
            $response = ['success' => true, 'icon' => 'warning', 'title' => '¡Usuario Desactivado!', 'text' => 'desactivado'];
        } else {
            $response = ['success' => false, 'message' => 'userId no proporcionado'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

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

    public function updateUser()
    {
        $usuarioM = new UsuarioM();
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

            if (!$usuarioM->emailExists($usuarioActualizado->getCorreo()) || $usuarioOriginal->getCorreo() == $usuarioActualizado->getCorreo()) {
                if (!$usuarioM->usernameExists($usuarioActualizado->getUsername()) || $usuarioOriginal->getUsername() == $usuarioActualizado->getUsername()) {
                    $updateResult = $this->usuarioM->update($usuarioActualizado, $usuarioOriginal);
                    $passwordUpdateResult = false;

                    if (!empty($data['password'])) {
                        $passwordUpdateResult = $this->usuarioM->updatePasswordAdmin($data['userId'], $data['password']);
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

    public function updatePassword()
    {
        if (isset($_POST['userId']) && isset($_POST['newPassword'])) {
            $userId = $_POST['userId'];
            $newPassword = $_POST['newPassword'];

            // Lógica para actualizar la contraseña y activar el password_flag
            $result = $this->usuarioM->updatePassword($userId, $newPassword);
            $this->usuarioM->updatePasswordFlag($userId);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Contraseña actualizada correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar la contraseña']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        }
    }

}
