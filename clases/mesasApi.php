<?php
require_once './composer/vendor/autoload.php';
require_once './clases/mesas.php';
require_once './clases/pedidos.php';
require_once './clases/pedido_producto.php';
require_once './clases/AutJWT.php';

class mesasApi{

    
    public function nuevaMesa($request, $response, $args){

        $respuesta = mesas::crearMesas();

        if($respuesta>0){
            $objDelaRespuesta->respuesta="Nuevo mesa guardada ID: ".$respuesta;
        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;  
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }



    public function traerTodas($request, $response, $args){
        $usuarios = mesas::TraerTodos();
        $newResponse = $response->withJson($usuarios, 200);
        return $newResponse;
    }



    public function traerPorEstado($request, $response, $args){
        $arrayDeParametros = $request->getParsedBody();
        $usuarios = mesas::TraerTodosPorLimpia($arrayDeParametros);
        $newResponse = $response->withJson($usuarios, 200);
        return $newResponse;
    }




    public function actualizarLimpia($request, $response, $args){

        $arrayDeParametros = $request->getParsedBody();
        
        $respuesta = mesas::actualizarLimpiaMesa($arrayDeParametros);
        if($respuesta>0){

            $objDelaRespuesta->respuesta="Mesa Limpiada.";
        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;   
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }




}






?>