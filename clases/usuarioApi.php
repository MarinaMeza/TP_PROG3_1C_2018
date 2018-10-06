<?php
require_once 'usuario.php';
require_once 'login.php';
require_once 'IApiUsable.php';

class usuarioApi extends Usuario implements IApiUsable{

    //Crea un usuario en la base de datos
    public function CargarUno($request, $response, $args) {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $dni= $ArrayDeParametros['dni'];
        $idFuncion= $ArrayDeParametros['idFuncion'];
        $idSector= $ArrayDeParametros['idSector'];
        $idEstado= $ArrayDeParametros['idEstado'];
        $miUsuario = new Usuario();
        $miUsuario->nombre = $nombre;
        $miUsuario->apellido = $apellido;
        $miUsuario->dni = $dni;
        $miUsuario->idFuncion = $idFuncion;
        $miUsuario->idSector = $idSector;
        $miUsuario->idEstado = $idEstado;
        $miUsuario->InsertarUsuarioParametros();
        $objDelaRespuesta->respuesta = "Se guardó el usuario.";
        return $response->withJson($objDelaRespuesta, 200);
    }

    //Borra un usuario de la base de datos
    public function BorrarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $id = $ArrayDeParametros['id'];
        $usuario = new Usuario();
        $usuario->idUsuario = $id;
        $cantidadDeBorrados = $usuario->BorrarUsuario();

        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->cantidad = $cantidadDeBorrados;
        if($cantidadDeBorrados > 0) {
            $objDelaRespuesta->resultado = "El usuario ha sido borrado";
        } else {
            $objDelaRespuesta->resultado = "No fue posible borrar el usuario<br>".$ArrayDeParametros;
        }
        $newResponse = $response->withJson($objDelaRespuesta, 200);  
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        // var_dump($ArrayDeParametros);
        $miUsuario = new Usuario();
        $miUsuario->idUsuario = $ArrayDeParametros['id'];
        $miUsuario->nombre = $ArrayDeParametros['nombre'];
        $miUsuario->apellido = $ArrayDeParametros['apellido'];
        $miUsuario->dni = $ArrayDeParametros['dni'];
        $miUsuario->idSector = $ArrayDeParametros['idSector'];
        $miUsuario->idFuncion = $ArrayDeParametros['idFuncion'];
        $miUsuario->idEstado = $ArrayDeParametros['idEstado'];
        
        var_dump($miUsuario->nombre);
        $resultado = $miUsuario->ModificarUsuario();
        $objDelaRespuesta= new stdclass();
        //var_dump($resultado);
        $objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea = "modificar";
        return $response->withJson($objDelaRespuesta, 200);
    }
    //
    public function TraerUno($request, $response, $args) {
        /*$nombre=$args['nombre'];
        $apellido=$args['apellido'];
        $perfil=$args['perfil'];*/
        $elUsuario=Usuario::TraerUnUsuario($request);
        //var_dump($elUsuario);
        if(!$elUsuario) {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta el Usuario";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        } else {
            $NuevaRespuesta = $response->withJson($elUsuario, 200); 
        }     
        var_dump($NuevaRespuesta);
        return $NuevaRespuesta;
    }
    
    //
    public function TraerTodos($request, $response, $args) {
        $todosLosUsuarios=Usuario::TraerTodosLosUsuarios();
        $newresponse = $response->withJson($todosLosUsuarios, 200);  
        return $newresponse;
    }

    public function OperacionesSector($request, $response, $args) {
        $todosLosUsuarios=Usuario::TraerOperacionesSector();
        $newresponse = $response->withJson($todosLosUsuarios, 200);  
        return $newresponse;
    }

    public function OperacionesSectorEmpleado($request, $response, $args) {
        $todosLosUsuarios=Usuario::TraerOperacionesSectorEmpleado();
        $newresponse = $response->withJson($todosLosUsuarios, 200);  
        return $newresponse;
    }

    public function OperacionesEmpleado($request, $response, $args) {
        $todosLosUsuarios=Usuario::TraerOperacionesEmpleado();
        $newresponse = $response->withJson($todosLosUsuarios, 200);  
        return $newresponse;
    }
    // public function TraerTodosHorarios($request, $response, $args) {
    //     $todosLosUsuarios=Usuario::TraerTodosLosHorarios();
    //     $newresponse = $response->withJson($todosLosUsuarios, 200); 
    //     include "secciones/usuarios.php";
    //     return $newresponse;
    //     // return Usuario::TraerTodosLosHorarios();
    // }

    
    

}
?>