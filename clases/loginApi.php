<?php
require_once 'login.php';
require_once 'usuario.php';
require_once 'IApiUsable.php';

class loginApi extends Login /*implements IApiUsable*/{

    public function CrearToken($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $nombre= $ArrayDeParametros['nombre'];
        $clave= $ArrayDeParametros['clave'];
        $miLogin = new Login();
        $resultado = $miLogin->TraerUnLogin($nombre, $clave);
        //var_dump($resultado);
        if (!$resultado) {
            $newResponse = "Los datos ingresados son incorrectos";
        } else {
            $usuario = new Usuario();
            $usuario = Usuario::TraerUnUsuario($nombre, $clave);
            
            Login::nuevaFechaLogin($usuario->idUsuario);
            $data = array('nombre' => $nombre, 'clave' => $clave,'perfil' => $usuario->idFuncion);
            $token = AutentificadorJWT::CrearToken($data);
            $newResponse = $response->withJson($token, 200);
        }

        return $newResponse;
   }

    public function TraerTodosLogins($request, $response, $args) {
        $todosLosLogin=Login::TraerTodosLosLogins();
        // var_dump($todosLosLogin);
        // foreach ($todosLosLogin as $value) {
        //     print_r ($value, true);
        // } 
        $newresponse = $response->withJson($todosLosLogin, 200); 
        //include "secciones/usuarios.php";
        return $newresponse;
        // return Usuario::TraerTodosLosHorarios();
    }
}
?>