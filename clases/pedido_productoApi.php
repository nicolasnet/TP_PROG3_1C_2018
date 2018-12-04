<?php
require_once './composer/vendor/autoload.php';
require_once './clases/pedidos.php';
require_once './clases/pedido_producto.php';
require_once './clases/AutJWT.php';

class pedido_productoApi{

    public function traerProductosPendientes($request, $response){
        $arrayConToken = $request->getHeader('token');
	    $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);
        //var_dump($payload);
        //var_dump($payload[0]->email);
        
        $newResponse = pedido_producto::TraerProductosPorPerfil($payload[0]->perfil, $payload[0]->id);
        return $response->withJson($newResponse, 200);
    }


    public function traerProductosListosParaServir($request, $response){
        
        $arrayConToken = $request->getHeader('token');
	    $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);
        //var_dump($payload);
        //var_dump($payload[0]->email);
        
        $newResponse = pedido_producto::TraerListosParaServirPorUsuario($payload[0]->id);
        return $response->withJson($newResponse, 200);
    }



    public function actualizarProductoEnPreparacion($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        $arrayConToken = $request->getHeader('token');
        $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);        
        
        $respuesta = pedido_producto::actualizarProductoEnPreparacion($arrayDeParametros, $payload[0]->id);
        
        if($respuesta>0){

            $objDelaRespuesta->respuesta="Nuevo producto en preparacion.";
            $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
            $objDelaRespuesta->idProducto=$arrayDeParametros["idProducto"];

        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;   
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }



    public function actualizarProductoListoParaServir($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        
        $respuesta = pedido_producto::actualizarProductoListoParaServir($arrayDeParametros);
        if($respuesta>0){

            $objDelaRespuesta->respuesta="Producto listo para servir.";
            $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
            $objDelaRespuesta->idProducto=$arrayDeParametros["idProducto"];

        }
        else{
            if($respuesta==0){
                $objDelaRespuesta->respuesta="El producto aun no esta en preparacion";
                $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
                $objDelaRespuesta->idProducto=$arrayDeParametros["idProducto"];
            }else{
                $objDelaRespuesta->respuesta=$respuesta;
            }
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }



    public function actualizarProductoServido($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        
        $respuesta = pedido_producto::actualizarProductoServido($arrayDeParametros);
        if($respuesta>0){

            $objDelaRespuesta->respuesta="Producto Servido.";
            $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
            $objDelaRespuesta->idProducto=$arrayDeParametros["idProducto"];

        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;   
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }




 /*

    public function traerUnoMarca($request, $response){
        
        $pedidos = pedido::TraerPorCodigo($_GET["marca"]);
        //var_dump($pedidos);
        $newResponse = $response->withJson($pedidos, 200);
        return $newResponse;
    }
    
   
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