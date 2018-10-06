<?php
class Mesa{
    public $id;
    public $idMesa;
    public $idFoto;
    public $idEstado;
    public $codigoCliente;
    
    public function InsertarUsuarioParametros() {
        $cant = 23;
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

    public static function TraerUnaMesaPedido($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
        SELECT M.codigoMesa AS 'Mesa numero', P.tiempoEstimado as 'Tiempo estimado'
        FROM `pedidos` AS P INNER JOIN `mesaPedido` AS MP
        ON P.idMesaPedido = MP.id INNER JOIN `mesas` AS M
        ON MP.idMesa = M.id
        WHERE $id = M.id");
        $consulta->execute();
        $usuarioBuscado = $consulta->fetchObject('pedidos');
        return $mesaBuscada; 
    }
}
?>