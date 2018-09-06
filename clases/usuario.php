<?php
class Usuario{
    public $id;
    public $nombre;
    public $apellido;
    public $dni;
    public $idFuncion;
    public $idSector;
    public $idFechaLogin;
    public $cantidadOperaciones;
    public $idEstado;
    
    //Crea un usuario y su login
    public function InsertarUsuarioParametros() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            INSERT INTO `usuarios` (nombre,apellido,dni,idFuncion,idSector,idEstado)
            VALUES (:nombre,:apellido,:dni,:idFuncion,:idSector,:idEstado)");
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
    

    //Borra un usuario de la base de datos
    public function BorrarUsuario() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
            DELETE 
            FROM `usuarios`
            WHERE id=:id");	
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }
     
    public static function TraerTodosLosUsuarios() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            SELECT id,nombre,apellido,dni,perfil FROM `usuarios`");
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
            GROUP BY Sector ORDER BY s.id");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
    }


    //trae cantidad de operaciones de todos por sector listado por cada empleado
    public static function TraerOperacionesSectorEmpleado() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            SELECT s.nombre AS Sector,
            u.nombre+' '+u.apellido AS Nombre, 
            SUM(u.cantidadOperaciones) AS 'Cantidad de operaciones'
            FROM `sectores` AS s 
            INNER JOIN `usuarios` AS u 
            GROUP BY Sector, Nombre ORDER BY s.id, Nombre");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
    }

    //trae cantidad de operaciones de cada uno por separado
    public static function TraerOperacionesEmpleado() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            SELECT u.nombre+' '+u.apellido AS Nombre,
            SUM(u.cantidadOperaciones) AS 'Cantidad de operaciones'
            FROM `usuarios` AS u
            GROUP BY Nombre ORDER BY Nombre");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
    }

    public static function TraerUnUsuario($nombre, $dni) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("
            SELECT id,nombre,apellido,perfil 
            FROM `usuario` 
            WHERE nombre = '$nombre' AND 
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

}
?>