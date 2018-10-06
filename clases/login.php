<?php
class Login{
    public $id;
    public $idUsuario;
    public $idFechaLogin;
    public $nombre;
    public $clave;
    
    public function InsertarLoginParametros() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `logins` (nombre,clave) VALUES (:nombre,:clave)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }   
    
    //trae todos los horarios y fechas de cada login
    public static function TraerTodosLosLogins() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        SELECT CONCAT(u.nombre,' ',u.apellido) AS Nombre, fl.fechaLogin AS 'fechayhora'
        FROM `fechas_login` AS fl INNER JOIN `usuarios` AS u
        ON u.idUsuario = fl.idUsuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function TraerUnLogin($nombre, $clave) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        SELECT l.idLogin,l.idUsuario,l.nombre,l.clave, u.idFuncion
        FROM `logins` AS l INNER JOIN `usuarios` AS u
        ON l.idUsuario = u.idUsuario
        WHERE l.nombre = '$nombre' AND 
        l.clave = '$clave'");
        $consulta->execute();
        $loginBuscado = $consulta->fetchObject('Login');
        return $loginBuscado; 
    }

    //agrega fecha y hora de cada login
    public static function nuevaFechaLogin($id) {
        var_dump($id);
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $tiempo = time();
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        INSERT INTO `fechas_login` (idUsuario, fechaLogin)
        VALUES (:idUsuario,:fechaLogin)");
        $consulta->bindValue(':idUsuario', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaLogin', $tiempo, PDO::PARAM_INT);
        $consulta->execute();
    }
}
?>