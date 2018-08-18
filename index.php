<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/vendor/autoload.php';
require_once 'clases/AccesoDatos.php';
require_once './clases/AutentificadorJWT.php';
require_once './clases/MWparaCORS.php';
require_once './clases/MWparaAutentificar.php';
require_once './clases/loginApi.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/login', function () {
 
  //$this->get('/', \usuarioApi::class . ':traerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->get('/{id}', \usuarioApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->post('/', \usuarioApi::class . ':CargarUno');
  
  $this->post('/', \loginApi::class . ':CrearToken')->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 

  //$this->delete('/', \usuarioApi::class . ':BorrarUno');

  //$this->put('/', \usuarioApi::class . ':ModificarUno');
     
})->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/usuario', function () {
 
  $this->get('/', \usuarioApi::class . ':traerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->get('/{id}', \usuarioApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  $this->post('/', \usuarioApi::class . ':CargarUno');
  
  $this->post('/login', \usuarioApi::class . ':CrearToken')->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 

  //$this->delete('/', \usuarioApi::class . ':BorrarUno');

  //$this->put('/', \usuarioApi::class . ':ModificarUno');
     
})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->run();
?>