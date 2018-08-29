<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

require __DIR__.'/vendor/autoload.php';
require_once 'clases/AccesoDatos.php';
require_once './clases/AutentificadorJWT.php';
require_once './clases/MWparaCORS.php';
require_once './clases/MWparaAutentificar.php';
require_once './clases/loginApi.php';
require_once './clases/UsuarioApi.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer('./secciones/');




// $app->group('', function () {
 
//   $this->get('/', function(Request $request, Response $response){
    
//     return $this->renderer->render($response, "index.1.html");
//   })->add(\MWparaCORS::class . ':HabilitarCORSTodos');
     
// })->add(\MWparaCORS::class . ':HabilitarCORS8080');




$app->group('/login', function () {
 
  $this->get('/', function(Request $request, Response $response){
    
    return $this->renderer->render($response, "login.html");
  })/*->add(\MWparaAutentificar::class . ':VerificarUsuario')*/->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->get('/{id}', \usuarioApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->post('/', \usuarioApi::class . ':CargarUno');

  $this->post('/', \loginApi::class . ':CrearToken')->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 

  //$this->delete('/', \usuarioApi::class . ':BorrarUno');

  //$this->put('/', \usuarioApi::class . ':ModificarUno');
     
})->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/mesa', function () {
 
  $this->get('/', function(Request $request, Response $response){
    return $this->renderer->render($response, "mesa.html");
  })->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  //$this->get('/', \usuarioApi::class . ':traerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  $this->get('/{id}', \mesaApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->post('/', \usuarioApi::class . ':CargarUno');
  
  //$this->post('/login', \usuarioApi::class . ':CrearToken')->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 

  //$this->delete('/', \usuarioApi::class . ':BorrarUno');

  //$this->put('/', \usuarioApi::class . ':ModificarUno');
     
})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->group('/usuarios', function () {
 
  $this->get('/', function(Request $request, Response $response,array $args){
    
    return $this->renderer->render($response, "usuarios.html");
  })->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

  $this->get('/horarios', \UsuarioApi::class . ':traerTodosHorarios')->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  

  //$this->get('/', \usuarioApi::class . ':traerTodosHorarios')->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  //$this->get('/', \usuarioApi::class . ':traerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->get('/{id}', \usuarioApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  
  //$this->post('/', \usuarioApi::class . ':CargarUno');
  
  //$this->post('/login', \usuarioApi::class . ':CrearToken')->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 

  //$this->delete('/', \usuarioApi::class . ':BorrarUno');

  //$this->put('/', \usuarioApi::class . ':ModificarUno');
     
})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->run();
?>