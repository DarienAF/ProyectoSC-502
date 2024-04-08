<?php

namespace ProyectoSC502\Controller;

session_start();

use ProyectoSC502\Model\Entities\Clases;
use ProyectoSC502\Model\Methods\UsuarioM;
use ProyectoSC502\Model\Methods\RolM;
use ProyectoSC502\Model\Methods\ClasesM;
use ProyectoSC502\Model\Methods\CategoriasM;

class ClassesPageController
{
    private $usuarioM;
    private $rolM;
    private $clasesM;
    private $categoriasM;

    public function __construct()
    {
        $this->usuarioM = new UsuarioM();
        $this->rolM = new RolM();
        $this->clasesM = new ClasesM();
        $this->categoriasM = new CategoriasM();
    }
   

    function SetClassesData($class)
{
    $classReturn = [
        "id_clase" => $class->getIdClase(),
        "id_usuario" => $class->getIdUsuario(),
        "usuario" => $this->usuarioM->view($class->getIdUsuario())->getUsername(),
        "hora_inicio" => $class->getHoraInicio(),
        "hora_fin" => $class->getHoraFin(),
        "dia" => $class->getDia(),
        "nombre_clase" => $class->getNombreClase(),
        "id_categoria" => $class->getIdCategoria(),
        "categoria" => $this->categoriasM->view($class->getIdCategoria())->getNombreCategoria()
    ];
    return $classReturn;
}


function Index()
{
    $current_page = 'ClassesPage';
    $user_id = $_SESSION['user_id'];
    $usuarioM = new UsuarioM();
    $current_user = $usuarioM->view($user_id);
    $userFullName = $current_user->getFullName();
    $userRole = $current_user->getIdRol();
    $userImagePath = $current_user->getRutaImagen();
    require_once './View/views/private/ClassesPage.php';
}

    public function createClass()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        // Crear una nueva instancia
        $nuevaClase = new Clases();

        // Establece si el usuario asociado a la clase existe
        $usuarioAsociado = $this->usuarioM->view($data['classUserID']);
        // Igualmente, pero para categoria
        $categoriaAsociada = $this->categoriasM->view($data['classCategoryID']);

        // Si AMBOS existen
        if ($usuarioAsociado && $categoriaAsociada) {
            // Asignar los atributos de la clase Clases con los datos recibidos
            $nuevaClase->setIdUsuario($data['classUserID']);
            $nuevaClase->setHoraInicio($data['startTime']);
            $nuevaClase->setHoraFin($data['endTime']);
            $nuevaClase->setDia($data['day']);
            $nuevaClase->setNombreClase($data['className']);
            $nuevaClase->setIdCategoria($data['classCategoryID']);

            // Intentar crear la nueva clase en la base de datos
            if ($this->clasesM->create($nuevaClase)) {
                $response = ['success' => true, 'message' => '¡Registro Correcto!'];
            } else {
                $response = ['success' => false, 'message' => '¡Registro Fallido!'];
            }
        } else {
            // Verificar cuál de los elementos (usuario o categoría) no existe y generar un mensaje adecuado
            if (!$usuarioAsociado) {
                $response = ['success' => false, 'message' => 'El usuariono existe'];
            } elseif (!$categoriaAsociada) {
                $response = ['success' => false, 'message' => 'La categoria no existe'];
            } else {
                $response = ['success' => false, 'message' => 'El usuario y la categoría no existen'];
            }
        }

        // Devolver respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function updateClass()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data)) {
            // Creamos una instancia de la clase Clases
            $claseActualizada = new Clases();
            //Le agregamos los datos
            $claseActualizada->setIdClase($data['classId']);
            $claseActualizada->setIdUsuario($data['classUserID']);
            $claseActualizada->setNombreClase($data['className']);
            $claseActualizada->setHoraInicio($data['startTime']);
            $claseActualizada->setHoraFin($data['endTime']);
            $claseActualizada->setDia($data['day']);
            $claseActualizada->setIdCategoria($data['classCategoryID']);

            // Se define si el usuario asociado, la categoría y la clase original existen
            $categoria = $this->categoriasM->view($data['classCategoryID']);
            $usuario = $this->usuarioM->view($data['classUserID']);
            $claseOriginal = $this->clasesM->view($data['classId']);

            if ($categoria && $usuario && $claseOriginal) {
                // Actualizar la clase en la base de datos
                $updateResult = $this->clasesM->update($claseActualizada, $claseOriginal);
                if ($updateResult) {
                    $response = ['success' => true, 'changed' => true, 'message' => 'Clase actualizada con éxito', "Usuario" => $usuario->getUsername()];
                } else {
                    $response = ['success' => true, 'changed' => false, 'message' => 'No se agregaron cambios a la Clase'];
                }
            } else {
                $response = ['success' => false, 'message' => 'El usuario, la categoría o la clase no existen'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Faltan datos'];
        }

        // Devolver respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    
    public function MemberUsers()
    {
        $um = new UsuarioM();
        $response = [];
        foreach ($um->viewAll() as $usuario) {
            if ($usuario->getIdRol() == 4 && $usuario->getActivo() == 1) {
                $response[] = [
                    'id' => $usuario->getIdUsuario(),
                    'nombre' => $usuario->getNombre(),
                    'apellidos' => $usuario->getApellidos()
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getClassUpdate()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        // Se recupera la clase usando el ID de la clase proporcionado en los datos
        $clase = $this->clasesM->view($data);

        if ($clase) {
            // Llama a la función SetClassData() con la clase recuperada como argumento y almacenar el resultado en $response
            $response = $this->SetClassesData($clase);
        } else {
            // Si no se encuentra la clase, establecer $response en null
            $response = null;
        }

        // Devuelve la respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }


}
