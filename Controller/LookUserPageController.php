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
        // Get the current page name
        $current_page = 'LookUserPage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            $users = $this->usuarioM->viewAll();
            $roles = $this->rolM->viewRolesNames();
            require_once './View/views/private/LookUserPage.php';
        } else {
            $current_user = null;
            require_once './View/views/private/LandingPage.php';
        }
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
        if (isset($_POST['userId'], $_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['role'])) {
            $usuarioActualizado = new Usuario();
            $usuarioActualizado->setIdUsuario($_POST['userId']);
            $usuarioActualizado->setUsername($_POST['username']);
            $usuarioActualizado->setNombre($_POST['firstName']);
            $usuarioActualizado->setApellidos($_POST['lastName']);
            $usuarioActualizado->setCorreo($_POST['email']);
            $usuarioActualizado->setTelefono($_POST['phone']);
            $usuarioActualizado->setIdRol($_POST['role']);

            $usuarioOriginal = $this->usuarioM->view($_POST['userId']);

            if ($this->usuarioM->update($usuarioActualizado, $usuarioOriginal)) {
                echo json_encode(['success' => true, 'message' => 'Usuario actualizado con éxito']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Faltan datos']);
        }
    }
}
