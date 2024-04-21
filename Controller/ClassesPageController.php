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
{ $categoria = $this->categoriasM->view($class->getIdCategoria());
    $categoriaNombre = ($categoria !== null) ? $categoria->getNombreCategoria() : "Sin categoría";
    $classReturn = [
        "id_clase" => $class->getIdClase(),
        "usuario" => $this->usuarioM->view($class->getIdUsuario())->getUsername(),
        "hora_inicio" => $class->getHoraInicio(),
        "hora_fin" => $class->getHoraFin(),
        "dia" => $class->getDia(),
        "nombre_clase" => $class->getNombreClase(),
        "categoria" => $categoriaNombre
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
    $userClasses = [];

    if ($userRole != 4) {
        foreach ($this->clasesM->viewAll() as $class) {
            $userClasses[] = $this->SetClassesData($class);
        }
    } else {
        foreach ($this->clasesM->viewUserClasses($user_id) as $class) {
            $userClasses[] = $this->SetClassesData($class);
        }
    }

    require_once './View/views/private/ClassesPage.php';
}

public function createClass()
{
    $data = json_decode(file_get_contents('php://input'), true);
    // Crear una nueva instancia
    $nuevaClase = new Clases();

    // Establece si el usuario asociado a la clase existe
    $usuarioAsociado = $this->usuarioM->view($data['classUserID']);

    // Si el usuario asociado existe
    if ($usuarioAsociado) {
        // Asignar los atributos de la clase Clases con los datos recibidos
        $nuevaClase->setIdUsuario($data['classUserID']);
        $nuevaClase->setHoraInicio($data['startTime']);
        $nuevaClase->setHoraFin($data['endTime']);
        $nuevaClase->setDia($data['day']);
        $nuevaClase->setNombreClase($data['className']);
        $nuevaClase->setIdCategoria($data['categoryClassID']);

        // Intentar crear la nueva clase en la base de datos
        if ($this->clasesM->create($nuevaClase)) {
            $response = ['success' => true, 'message' => '¡Registro Correcto!'];
        } else {
            $response = ['success' => false, 'message' => '¡Registro Fallido!'];
        }
    } else {
        // Si el usuario asociado no existe
        $response = ['success' => false, 'message' => 'El usuario no existe'];
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
        $claseActualizada->setIdClase($data['id_clase']); // Cambio en la clave
        $claseActualizada->setIdUsuario($data['classUserID']); // Cambio en la clave
        $claseActualizada->setNombreClase($data['className']); // Cambio en la clave
        $claseActualizada->setHoraInicio($data['startTime']); // Cambio en la clave
        $claseActualizada->setHoraFin($data['endTime']); // Cambio en la clave
        $claseActualizada->setDia($data['day']);
        $claseActualizada->setIdCategoria($data['categoryClassID']); // Cambio en la clave

        // Se define si el usuario asociado y la clase original existen
        $usuario = $this->usuarioM->view($data['classUserID']); // Cambio en la clave
        $claseOriginal = $this->clasesM->view($data['id_clase']); // Cambio en la clave

        if ($usuario && $claseOriginal) {
            // Actualizar la clase en la base de datos
            $updateResult = $this->clasesM->update($claseActualizada, $claseOriginal);
            if ($updateResult) {
                $response = ['success' => true, 'changed' => true, 'message' => 'Clase actualizada con éxito', "Usuario" => $usuario->getUsername()];
            } else {
                $response = ['success' => true, 'changed' => false, 'message' => 'No se agregaron cambios a la Clase'];
            }
        } else {
            $response = ['success' => false, 'message' => 'El usuario o la clase no existen'];
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
            if ($usuario->getIdRol() == 3 && $usuario->getActivo() == 1) {
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

    public function CategoryClasses()
    {
        $um = new CategoriasM();
        $response = [];
        foreach ($um->viewAll() as $categoria) {
                $response[] = [
                    'id' => $categoria->getIdCategoria(),
                    'nombre' => $categoria->getNombreCategoria(),
                ];
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
