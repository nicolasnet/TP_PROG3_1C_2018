<?php
require_once './composer/vendor/autoload.php';
require_once './clases/pedidos.php';
require_once './clases/AutJWT.php';

class pedidosApi{

    public function nuevoPedido($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();

        //var_dump($request->getParsedBody());
        $arrayConToken = $request->getHeader('token');
        $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);        
        
        $respuesta = pedido::crearPedido($arrayDeParametros, $payload[0]->id);
        //var_dump($respuesta);
        //var_dump($arrayDeParametros);
        //var_dump(json_decode ($arrayDeParametros["productos"]));
/*
        $archivos = $request->getUploadedFiles();

        $foto= $archivos['imagen'];
        
*/
        if(!is_null($respuesta)){
/*
            $nuevaCarpeta="IMGpedidos";
            if(!file_exists($nuevaCarpeta))
            {
                mkdir($nuevaCarpeta);
            }
            $nuevoNombre="./".$nuevaCarpeta."/".$respuesta."-".$arrayDeParametros["codigo"]."-".$arrayDeParametros["modelo"].".jpg";
            //var_dump($nuevoNombre);
            $foto->moveTo($nuevoNombre);
*/

/* Asi es como hay q pasar los prductos por el Postman
 [
        {
            "idProducto": 1,
            "cantidad": 2
        },
        {
            "idProducto": 6,
            "cantidad": 1
        },
        {
            "idProducto": 2,
            "cantidad": 1
        }
    ]
*/

            foreach (json_decode($arrayDeParametros["productos"]) as $objeto) {
                //var_dump($objeto->cantidad);
                pedido::agregarProducto($objeto, $respuesta[0]->codigo);
            }

            $objDelaRespuesta->respuesta="Nuevo pedido creado.";
        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;   
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }


    public function traerTodos($request, $response, $args){   
        $pedidos = pedido::TraerTodos();
        $newResponse = $response->withJson($pedidos, 200);
        return $newResponse;
    }


    public function traerUnoUsuario($request, $response){
        $arrayConToken = $request->getHeader('token');
	    $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);
        //var_dump($payload);
        //var_dump($payload[0]->email);
        
        $pedidos = pedido::TraerUnoPorUsuario($payload[0]->email);
        $newResponse = $pedidos;
        return $newResponse;
    }


    public function traerUnoMarca($request, $response){
        
        $pedidos = pedido::TraerPorCodigo($_GET["marca"]);
        //var_dump($pedidos);
        $newResponse = $response->withJson($pedidos, 200);
        return $newResponse;
    }
    
    /*
    public function traerProductos($request, $response){
        
        $listadoPedidos = pedido::TraerTodosProductos();
        $output = array();
        var_dump($listadoPedidos);
        foreach($listadoPedidos as $pedido)
        {
            $objeto = "{'marca':".$pedido->marca.", 'modelo':". $pedido->modelo."}";
            var_dump(json_decode($objeto));

            array_push($output, $pedido->marca." ".$pedido->modelo);
        }

        $newResponse = $response->withJson($output, 200);
        return $newResponse;
    }
    */



}






?>