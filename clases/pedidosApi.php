<?php
require_once './composer/vendor/autoload.php';
require_once './clases/pedidos.php';
require_once './clases/pedido_producto.php';
require_once './clases/AutJWT.php';

class pedidosApi{

    public function nuevoPedido($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        $arrayConToken = $request->getHeader('token');
        $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);        
        
        $respuesta = pedido::crearPedido($arrayDeParametros, $payload[0]->id);
        //var_dump($respuesta);
        //var_dump($arrayDeParametros);
        //var_dump(json_decode ($arrayDeParametros["productos"]));
/*imagen
        $archivos = $request->getUploadedFiles();

        $foto= $archivos['imagen'];
        
*/
        if(!is_string($respuesta)){
/*imagen
            $nuevaCarpeta="IMGpedidos";
            if(!file_exists($nuevaCarpeta))
            {
                mkdir($nuevaCarpeta);
            }
            $nuevoNombre="./".$nuevaCarpeta."/".$respuesta."-".$arrayDeParametros["codigo"]."-".$arrayDeParametros["modelo"].".jpg";
            //var_dump($nuevoNombre);
            $foto->moveTo($nuevoNombre);
*/

/* Asi es como hay q pasar los productos por el Postman
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
                pedido_producto::agregarProducto($objeto, $respuesta[0]->codigo);
            }

            $objDelaRespuesta->respuesta="Nuevo pedido creado.";
            $objDelaRespuesta->codigo=$respuesta[0]->codigo;
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

    
    
    public function traerPedidoUsuario($request, $response){
        $arrayConToken = $request->getHeader('token');
	    $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);
        //var_dump($payload);
        //var_dump($payload[0]->email);
        
        $pedidos = pedido::TraerPorUsuario($payload[0]->id);
        $newResponse = $pedidos;
        return $newResponse;
    }



    public function actualizarPedidoListoParaServir($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        
        $respuesta = pedido::actualizarPedidoListoParaServir($arrayDeParametros);

        if($respuesta>0){
            $objDelaRespuesta->respuesta="Pedido listo para servir.";
            $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
        }
        else{
            if($respuesta==0){
                $objDelaRespuesta->respuesta="El pedido aun tiene productos sin terminar";
                $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
            }else{
                $objDelaRespuesta->respuesta=$respuesta;
            }
               
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }



    public function actualizarPedidoServido($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        
        $respuesta = pedido::actualizarPedidoServido($arrayDeParametros);

        if($respuesta>0){
            $objDelaRespuesta->respuesta="Pedido Servido.";
            $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
        }
        else{
            if($respuesta==0){
                $objDelaRespuesta->respuesta="El pedido aun tiene productos sin terminar";
                $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
            }else{
                $objDelaRespuesta->respuesta=$respuesta;
            }               
        }        
        return $response->withJson($objDelaRespuesta, 200);
    }


    public function actualizarPedidoAPagar($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        
        $respuesta = pedido::actualizarPedidoAPagar($arrayDeParametros);

        if($respuesta>0){
            $objDelaRespuesta->respuesta="Ticket de pago entregado.";
            $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
        }
        else{
            if($respuesta==0){
                $objDelaRespuesta->respuesta="El pedido aun tiene productos sin terminar";
                $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
            }else{
                $objDelaRespuesta->respuesta=$respuesta;
            }               
        }        
        return $response->withJson($objDelaRespuesta, 200);
    }



    public function actualizarPedidoMesaCerrado($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        
        $respuesta = pedido::actualizarPedidoMesaCerrado($arrayDeParametros);

        if($respuesta>0){
            $objDelaRespuesta->respuesta="Pedido cobrado, mesa cerrada y lista para limpiar.";
            $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
        }
        else{
            if($respuesta==0){
                $objDelaRespuesta->respuesta="El cliente aun no recibio su boleta de pago";
                $objDelaRespuesta->codigo=$arrayDeParametros["codigo"];
            }else{
                $objDelaRespuesta->respuesta=$respuesta;
            }               
        }        
        return $response->withJson($objDelaRespuesta, 200);
    }
    


}






?>