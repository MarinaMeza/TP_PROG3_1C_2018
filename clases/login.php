<?php
class Login{
    public $id;
    public $idUsuario;
    public $nombre;
    public $clave;

    public function InsertarLoginParametros() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into login (nombre,clave)values(:nombre,:clave)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }   

    public static function TraerTodosLosLogins() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,idUsuario,nombre,clave from login");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Login");		
    }

    public static function TraerUnLogin($nombre, $clave) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        select id,idUsuario,nombre,clave
        from login 
        where nombre = '$nombre' and 
        clave = '$clave'");
        $consulta->execute();
        $loginBuscado = $consulta->fetchObject('Login');
        return $loginBuscado; 
    }
}
?>