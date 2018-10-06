<?php
class Usuario{
    public $idUsuario;
    public $nombre;
    public $apellido;
    public $dni;
    public $idFuncion;
    public $idSector;
    public $cantidadOperaciones;
    public $idEstado;
    
    //Crea un usuario y su login
    public function InsertarUsuarioParametros() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            INSERT INTO `usuarios` (idSector,idFuncion,idEstado,nombre,apellido,dni)
            VALUES (:idSector,:idFuncion,:idEstado,:nombre,:apellido,:dni)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':dni', $this->dni, PDO::PARAM_STR);
        $consulta->bindValue(':idFuncion', $this->idFuncion, PDO::PARAM_INT);
        $consulta->bindValue(':idSector',$this->idSector, PDO::PARAM_INT);
        $consulta->bindValue(':idEstado', $this->idEstado, PDO::PARAM_INT);
        $consulta->execute();
        $nombreUsuario = strtolower($this->nombre[0].$this->apellido);
        $this->id = $objetoAccesoDato->RetornarUltimoIdInsertado();
        $consulta = $objetoAccesoDato->RetornarConsulta("
            INSERT into logins (idUsuario,nombre,clave)
            values(:idUsuario,:nombre,:clave)");
        $consulta->bindValue(':nombre',$nombreUsuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->dni, PDO::PARAM_STR);
        $consulta->bindValue(':idUsuario', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    

    //Borra un usuario de la base de datos
    public function BorrarUsuario() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
            DELETE 
            FROM `usuarios`
            WHERE `idUsuario`=:idUsuario");	
        $consulta->bindValue(':idUsuario',$this->idUsuario, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }


    public function ModificarUsuario() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            UPDATE `usuarios`
            SET `nombre`=:nombre,
            `apellido`=:apellido,
            `dni`=:dni,
            `idSector`=:idSector,
            `idFuncion`=:idFuncion,
            `idEstado`=:idEstado
            WHERE `idUsuario`=:idUsuario");
   
        $consulta->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':dni', $this->dni, PDO::PARAM_STR);
        $consulta->bindValue(':idFuncion', $this->idFuncion, PDO::PARAM_INT);
        $consulta->bindValue(':idSector',$this->idSector, PDO::PARAM_INT);
        $consulta->bindValue(':idEstado', $this->idEstado, PDO::PARAM_INT);
        $nombreUsuario = strtolower($this->nombre[0].$this->apellido);

        $consulta->execute();
    }

     
    public static function TraerTodosLosUsuarios() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            SELECT idUsuario,idSector,idFuncion,idEstado,nombre,apellido,dni,cantidadOperaciones
            FROM `usuarios`");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
    }


    
    //trae cantidad de operaciones de todos por sector
    public static function TraerOperacionesSector() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            SELECT s.nombre AS Sector, 
            SUM(u.cantidadOperaciones) AS 'Cantidad de operaciones'
            FROM `sectores` AS s 
            INNER JOIN `usuarios` AS u 
            GROUP BY Sector ORDER BY s.idSector");
        $consulta->execute();
    return $consulta->fetchAll(/*PDO::FETCH_CLASS, "Usuario"*/);
    }


    //trae cantidad de operaciones de todos por sector listado por cada empleado
    public static function TraerOperacionesSectorEmpleado() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            SELECT s.nombre AS Sector,
            CONCAT(u.nombre,' ',u.apellido) AS Nombre,
            SUM(u.cantidadOperaciones) AS 'Cantidad de operaciones'
            FROM `sectores` AS s INNER JOIN `usuarios` AS u
            WHERE u.idSector = s.idSector
            GROUP BY Sector, Nombre ORDER BY s.idSector, Nombre ");
        $consulta->execute();
        return $consulta->fetchAll(/*PDO::FETCH_CLASS, "Usuario"*/);
    }

    //trae cantidad de operaciones de cada uno por separado
    public static function TraerOperacionesEmpleado() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            SELECT CONCAT(u.nombre,' ',u.apellido) AS Nombre,
            SUM(u.cantidadOperaciones) AS 'Cantidad de operaciones'
            FROM `usuarios` AS u
            GROUP BY Nombre ORDER BY Nombre");
        $consulta->execute();
    return $consulta->fetchAll(/*PDO::FETCH_CLASS, "Usuario"*/);
    }

    public static function TraerUnUsuario($nombre, $dni) {
        $apellido = substr($nombre,1);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
            SELECT idUsuario, nombre, apellido, idFuncion
            FROM `usuarios` 
            WHERE apellido = '$apellido' AND
            dni = '$dni'");
        $consulta->execute();
        $usuarioBuscado = $consulta->fetchObject('Usuario');
        
        return $usuarioBuscado; 
    }

    // public static function TraerTodosLosHorarios() {
    //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    //     //$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre,apellido,dni from usuarios");
    //     $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,codigoMesa FROM `mesas`");
    //     $consulta->execute();
        
        // $tabla = "<div class='table-responsive'> <table class='table table-striped table-sm'>
        // <thead><tr><th>ID</th><th>Nombre</th></tr></thead><tbody>";
        // while($row = $consulta->fetch()){
        //     $tabla .= "<tr><td>".$row['id']."</td><td>".$row['codigoMesa']."</td></tr>";
        // }
        // $tabla .= "<tbody></table></div>";
        // $tabla = "<div class='table-responsive'> <table class='table table-striped table-sm'>
        // <thead><tr><th>ID</th><th>Nombre</th></tr></thead><tbody>";
        // while($row = $consulta->fetch()){
        //     $tabla .= "<tr><td>".$row['id']."</td><td>".$row['codigoMesa']."</td></tr>";
        // }
        // $tabla .= "<tbody></table></div>";
        
        // $respuesta = "<script>
        //     let p = document.querySelector('p');
        //     p.innerText = ".$tabla.";
        //     nav.classList.toggle('abierto');
        // </script>";
        

        // echo $tabla;
    //     return $consulta->fetchAll(PDO::FETCH_CLASS, "Mesas");
    // }

    private function CrearNombreUsuario($pNombre, $pApellido) {
        $nombreUsuario = strtolower($pNombre[0].$pApellido);
        return $nombreUsuario;
    }

}
?>