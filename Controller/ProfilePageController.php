<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Entities\Usuario;
use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\RolM;
use ProyectoSC502\Services\S3ClientService;

class ProfilePageController
{
    private $usuarioM;
    private $rolM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->rolM = new RolM();
    }

    function Index()
    {
        $current_page = 'ProfilePage';
        $user_id = $_SESSION['user_id'];
        $usuarioM = new UsuarioM();
        $current_user = $usuarioM->view($user_id);
        $username = $current_user->getUsername();
        $userRole = $current_user->getIdRol();
        $userFullName = $current_user->getFullName();
        $userFirstName = $current_user->getNombre();
        $userLastName = $current_user->getApellidos();
        $userEmail = $current_user->getCorreo();
        $userPhone = $current_user->getTelefono();
        $userPassword = $current_user->getPassword();
        $userImagePath = $current_user->getRutaImagen();
        require_once './View/views/private/ProfilePage.php';
    }

    // Actualiza los datos de un usuario
    public function updateUser()
    {
        $userId = $_SESSION['user_id'];

        if (isset($_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'])) {
            $usuarioActualizado = new Usuario();
            $usuarioActualizado->setIdUsuario($userId);
            $usuarioActualizado->setUsername($_POST['username']);
            $usuarioActualizado->setNombre($_POST['firstName']);
            $usuarioActualizado->setApellidos($_POST['lastName']);
            $usuarioActualizado->setCorreo($_POST['email']);
            $usuarioActualizado->setTelefono($_POST['phone']);

            if (isset($_FILES['profileImage'])) {
                $fileTmpPath = $_FILES['profileImage']['tmp_name'];
                $new_photoURL = S3ClientService::uploadImage($userId, $fileTmpPath);
                if ($new_photoURL) {
                    $usuarioActualizado->setRutaImagen($new_photoURL);
                } else {
                    echo "Failed to upload the file.\n";
                }
            }

            $usuarioOriginal = $this->usuarioM->view($userId);

            if (!$this->usuarioM->emailExists($usuarioActualizado->getCorreo()) || $usuarioOriginal->getCorreo() == $usuarioActualizado->getCorreo()) {
                if (!$this->usuarioM->usernameExists($usuarioActualizado->getUsername()) || $usuarioOriginal->getUsername() == $usuarioActualizado->getUsername()) {
                    $updateResult = $this->usuarioM->update($usuarioActualizado, $usuarioOriginal);
                    $passwordUpdateResult = false;

                    if (!empty($data['password'])) {
                        $passwordUpdateResult = $this->usuarioM->updatePassword($data['userId'], $data['password'], true);
                    }

                    if ($updateResult || $passwordUpdateResult || isset($_FILES['profileImage'])) {
                        $response = ['success' => true, 'changed' => true, 'message' => 'Cambios realizados con exito'];
                    } else {
                        $response = ['success' => true, 'changed' => false, 'message' => 'No se agregaron cambios al usuario'];
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
}
