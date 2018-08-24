<?php
class Usuario{
    public $id;
    public $nombre;
    public $apellido;
    public $dni;
    public $idFuncion;
    public $idSector;
    public $fechaLogin;
    public $cantidadOperaciones;
    public $idEstado;

    public function InsertarUsuarioParametros() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            INSERT into usuarios (nombre,apellido,dni,idFuncion,idSector,idEstado)
            values(:nombre,:apellido,:dni,:idFuncion,:idSector,:idEstado)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':dni', $this->dni, PDO::PARAM_STR);
        $consulta->bindValue(':idFuncion', $this->idFuncion, PDO::PARAM_INT);
        $consulta->bindValue(':idSector',$this->idSector, PDO::PARAM_INT);
        $consulta->bindValue(':idEstado', $this->idEstado, PDO::PARAM_INT);
        $consulta->execute();
        $nombreUsuario = $this->nombre[0].$this->apellido;
        $this->id = $objetoAccesoDato->RetornarUltimoIdInsertado();
        $consulta = $objetoAccesoDato->RetornarConsulta("
            INSERT into login (nombre,clave,idUsuario)
            values(:nombre,:clave,:idUsuario)");
        $consulta->bindValue(':nombre',$nombreUsuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->dni, PDO::PARAM_STR);
        $consulta->bindValue(':idUsuario', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodosLosUsuarios() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre,apellido,dni,perfil from usuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
    }

    public static function TraerUnUsuario($nombre, $apellido) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        select id,nombre,apellido,perfil 
        from usuario 
        where nombre = '$nombre' and 
        apellido = '$apellido'");
        $consulta->execute();
        $usuarioBuscado = $consulta->fetchObject('Usuario');
        return $usuarioBuscado; 
    }

    public static function nuevaFechaLogin($nombre) {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $tiempo = date('d-m-Y H:i:s');
        $apellido = substr($nombre, 0);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        UPDATE `usuarios` SET `fechaLogin`= $tiempo 
        WHERE apellido = $apellido");
        $consulta->execute();
        // $usuarioBuscado = $consulta->fetchObject('Usuario');
        // return $usuarioBuscado; 
    }
}
?>