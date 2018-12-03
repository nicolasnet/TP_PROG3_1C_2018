<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once './composer/vendor/autoload.php';
require_once './clases/loginApi.php';
require_once './clases/pedidosApi.php';
require_once './clases/MWparaAutentificar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/



$app = new \Slim\App(["settings" => $config]);


//entrada de prueba!!!!
$app->get('/prueba', function(){
    echo(AutJWT::generateRandomString(5,"P"));
});


$app->post('/login', \loginApi::class. ':consulta');


$app->group('', function () {

    $this->group('/usuario', function(){
        $this->get('/', \loginApi::class. ':traerTodos');
        $this->post('/', \loginApi::class. ':nuevoUsuario');
    })->add(\MWparaAutentificar::class . ':VerificarPerfilSocio');

    
    $this->group('/Pedido', function(){
        $this->post('/', \pedidosApi::class. ':nuevoPedido')->add(\MWparaAutentificar::class . ':VerificarHacerPedido');        
        $this->get('/', \pedidosApi::class. ':traerTodos')->add(\MWparaAutentificar::class . ':VerificarGetPedidos');

        /*
        $this->get('/marca', \pedidosApi::class. ':traerTodosMarca')->add(\MWparaAutentificar::class . ':VerificarPerfilSocio');    
        */
    });


    $this->group('/productos', function(){
        $this->get('/pendientes', \pedidosApi::class. ':traerProductosPendientes');
    });


})->add(\MWparaAutentificar::class . ':GuardarUsuarioRuta');


$app->run();

?>