<?php
class Login{
    public $id;
    public $idUsuario;
    public $nombre;
    public $clave;

    public function InsertarLoginParametros() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `login` (nombre,clave) VALUES (:nombre,:clave)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }   
//trae todos los horarios y fechas de cada login
    public static function TraerTodosLosLogins() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        SELECT u.nombre+' '+u.apellido AS Nombre, fl.fechaLogin AS 'Fecha y hora'
        FROM `fechalogin` AS fl INNER JOIN `usuarios` AS u");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Login");		
    }

    public static function TraerUnLogin($nombre, $clave) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        SELECT id,idUsuario,nombre,clave
        FROM `login` 
        WHERE nombre = '$nombre' AND 
        clave = '$clave'");
        $consulta->execute();
        $loginBuscado = $consulta->fetchObject('Login');
        return $loginBuscado; 
    }

    //agrega fecha y hora de cada login
    public static function nuevaFechaLogin($id) {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $tiempo = time();
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        INSERT INTO `fechaLogin` (idUsuario, fechaLogin)
        VALUES (:idUsuario,:fechaLogin)");
        $consulta->bindValue(':idUsuario', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaLogin', $tiempo, PDO::PARAM_INT);
        $consulta->execute();
    }
}
?>