<?php

class Usuario
{
    private $id_usuario;
    private $username;
    private $password;
    private $nombre;
    private $apellidos;
    private $correo;
    private $telefono;
    private $ruta_imagen;
    private $activo;
    private $id_rol;

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getRutaImagen()
    {
        return $this->ruta_imagen;
    }

    public function setRutaImagen($ruta_imagen)
    {
        $this->ruta_imagen = $ruta_imagen;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    public function getIdRol()
    {
        return $this->id_rol;
    }

    public function setIdRol($id_rol)
    {
        $this->id_rol = $id_rol;
    }


    public function setUserFields($row)
    {
        $this->setIdUsuario($row['id_usuario']);
        $this->setUsername($row['username']);
        $this->setPassword($row['password']);
        $this->setNombre($row['nombre']);
        $this->setApellidos($row['apellidos']);
        $this->setCorreo($row['correo']);
        $this->setTelefono($row['telefono']);
        $this->setRutaImagen($row['ruta_imagen']);
        $this->setActivo($row['activo']);
        $this->setIdRol($row['id_rol']);
    }

    public function toArray()
    {
        return [
            'id' => $this->getIdUsuario(),
            'rol' => $this->getIdRol(),
            'username' => $this->getUsername(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'correo' => $this->getCorreo(),
            'telefono' => $this->getTelefono(),
            'ruta_imagen' => $this->getRutaImagen()
        ];
    }
}









