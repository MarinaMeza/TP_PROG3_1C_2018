<?php
require_once 'log.php';



class MWLog extends Log{

    public function CargarUno($request, $response, $args) {
        //var_dump($request);
        /*$objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        $usuario= $ArrayDeParametros['usuario'];
        $metodo= $ArrayDeParametros['metodo'];
        $ruta= $ArrayDeParametros['ruta'];
        $miCompra = new Compra();
        $miCompra->usuario = $usuario;
        $miCompra->fecha = time();
        var_dump(time);
        $miCompra->metodo = $metodo;
        $miCompra->ruta = $ruta;
        $miCompra->InsertarCompraParametros();
        $objDelaRespuesta->respuesta = "Se guardó la compra.";
        
        return $response->withJson($objDelaRespuesta, 200);*/
        
    }
}
?>