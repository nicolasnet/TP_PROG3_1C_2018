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


function generateRandomString($length, $fijosIniciales="") {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = $fijosIniciales;
    for ($i = 0; $i < $length - strlen($fijosIniciales) ; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


$app = new \Slim\App(["settings" => $config]);


//entrada de prueba!!!!
$app->get('/prueba', function(){
    echo(generateRandomString(5,"P"));
});


$app->post('/login', \loginApi::class. ':consulta');


$app->group('', function () {

    $this->group('/usuario', function(){
        $this->get('/', \loginApi::class. ':traerTodos');
        $this->post('/', \loginApi::class. ':nuevoUsuario');
    })->add(\MWparaAutentificar::class . ':VerificarPerfilUsuario');




    /*
    $this->group('/Compra', function(){
        $this->get('/', \compraApi::class. ':traerTodos')->add(\MWparaAutentificar::class . ':VerificarPerfilUsuarioCompras');
        $this->post('/', \compraApi::class. ':nuevaCompra')->add(\MWparaAutentificar::class . ':VerificarJWT');
        $this->get('/marca', \compraApi::class. ':traerTodosMarca')->add(\MWparaAutentificar::class . ':VerificarPerfilUsuario');    

    });

    $this->group('/productos', function(){
        $this->get('/', \compraApi::class. ':traerProductos');
    });
    */

})->add(\MWparaAutentificar::class . ':GuardarUsuarioRuta');


$app->run();

?>