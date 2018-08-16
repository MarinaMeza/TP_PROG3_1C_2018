<?php
require_once 'login.php';
require_once 'IApiUsable.php';

class loginApi extends Login /*implements IApiUsable*/{

    public function CrearToken($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $nombre= $ArrayDeParametros['nombre'];
        $clave= $ArrayDeParametros['clave'];
//        $sexo= $ArrayDeParametros['sexo'];
//        $perfil= $ArrayDeParametros['perfil'];
        //var_dump($ArrayDeParametros);
        $miLogin = new Login();
        $resultado = $miLogin->TraerUnLogin($nombre, $clave);
        //var_dump($resultado);
        if (!$resultado) {
            $newResponse = "Los datos ingresados son incorrectos";
        } else {
            $data = array('nombre' => $nombre, 'clave' => $clave);
            $token = AutentificadorJWT::CrearToken($data);
            $newResponse = $response->withJson($token, 200);
        }

        return $newResponse;
   }
}
?>