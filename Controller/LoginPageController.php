<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Methods\UsuarioM;

class LoginPageController
{
    private $usuarioM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
    }

    function Index()
    {
        $current_page = 'LoginPage';
        require_once './View/views/public/LoginPage.php';

    }

    // Inicia sesión
    function LogIn()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $password = $data['password'];

        $usuario = $this->usuarioM->userLogin($username);

        if ($usuario) {
            if ($usuario->getActivo()) {
                if (password_verify($password, $usuario->getPassword())) {
                    $_SESSION['username'] = $usuario->getUsername();
                    $_SESSION['user_id'] = $usuario->getIdUsuario();
                    if ($usuario->getPasswordFlag()) {
                        // El usuario debe cambiar la contraseña
                        $response = ['success' => true, 'changePassword' => true, 'message' => 'Debe cambiar la contraseña'];
                    } else {
                        // Usuario validado correctamente y no necesita cambiar la contraseña
                        $response = ['success' => true, 'changePassword' => false, 'message' => 'Debe cambiar la contraseña'];
                    }
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

    // Cambia contraseña del usario
    function changePassword()
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $username = $_SESSION['username'];
        $oldPassword = $data['oldPassword'];
        $newPassword = $data['newPassword'];

        $usuario = $this->usuarioM->userLogin($username);

        if ($usuario) {
            if (password_verify($oldPassword, $usuario->getPassword())) {
                if ($this->usuarioM->updatePassword($usuario->getIdUsuario(), $newPassword)) {
                    $response = ['success' => true, 'passwordMatch' => true];
                } else {
                    $response = ['success' => false, 'passwordMatch' => true];
                }
            } else {
                $response = ['success' => false, 'passwordMatch' => false];
            }
        } else {
            $response = ['success' => false];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Cierra sesión
    function LogOut()
    {
        session_destroy();
        header("Location:./index.php?controller=LoginPage&action=index");
    }
}
