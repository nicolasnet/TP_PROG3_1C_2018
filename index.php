<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once './composer/vendor/autoload.php';
require_once './clases/loginApi.php';
require_once './clases/clienteApi.php';
require_once './clases/mesasApi.php';
require_once './clases/pedidosApi.php';
require_once './clases/pedido_productoApi.php';
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
    echo("conectado");
});


$app->post('/login', \loginApi::class. ':consulta');



$app->group('/clientes', function(){
    $this->post('/estado', \clienteApi::class. ':consulta');
    $this->post('/encuesta', \clienteApi::class. ':nuevaEncuesta');
});





$app->group('', function () {

    $this->group('/usuario', function(){
        $this->get('/', \loginApi::class. ':traerTodos');
        $this->post('/', \loginApi::class. ':nuevoUsuario');
        $this->post('/estado', \loginApi::class. ':darDeBajaUsuario');
    })->add(\MWparaAutentificar::class . ':VerificarPerfilSocio');

    
    $this->group('/Pedido', function(){
        $this->post('/', \pedidosApi::class. ':nuevoPedido')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');      
        $this->get('/', \pedidosApi::class. ':traerTodos')->add(\MWparaAutentificar::class . ':VerificarGetPedidos');
        $this->post('/listoServir', \pedidosApi::class. ':actualizarPedidoListoParaServir')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');
        $this->post('/servido', \pedidosApi::class. ':actualizarPedidoServido')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');
        $this->post('/aPagar', \pedidosApi::class. ':actualizarPedidoAPagar')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');
        $this->post('/cerrado', \pedidosApi::class. ':actualizarPedidoMesaCerrado')->add(\MWparaAutentificar::class . ':VerificarPerfilSocio');        
    });


    $this->group('/productos', function(){
        $this->get('/pendientes', \pedido_productoApi::class. ':traerProductosPendientes')->add(\MWparaAutentificar::class . ':VerificarJWT');

        $this->post('/preparacion', \pedido_productoApi::class. ':actualizarProductoEnPreparacion')->add(\MWparaAutentificar::class . ':VerificarJWT');
        $this->post('/listoServir', \pedido_productoApi::class. ':actualizarProductoListoParaServir')->add(\MWparaAutentificar::class . ':VerificarJWT');

        $this->get('/listoServir', \pedido_productoApi::class. ':traerProductosListosParaServir')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');
        $this->post('/servido', \pedido_productoApi::class. ':actualizarProductoServido')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');
    });


    $this->group('/mesa', function(){
        $this->get('/', \mesasApi::class. ':nuevaMesa')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');
        $this->get('/todas', \mesasApi::class. ':traerTodas')->add(\MWparaAutentificar::class . ':VerificarMozoYSocio');
        $this->post('/traerPorEstado', \mesasApi::class. ':traerPorEstado')->add(\MWparaAutentificar::class . ':VerificarJWT');
        $this->post('/limpiar', \mesasApi::class. ':actualizarLimpia')->add(\MWparaAutentificar::class . ':VerificarJWT');
    });



})->add(\MWparaAutentificar::class . ':GuardarUsuarioRuta');


$app->run();

?>