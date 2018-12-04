<?php
require_once './composer/vendor/autoload.php';
require_once './clases/cliente.php';

class clienteApi{

    public function consulta($request, $response, $args){
        $arrayDeParametros = $request->getParsedBody(); 
        $respuesta = cliente::consultaPedido($arrayDeParametros);
        //var_dump($respuesta);
        if($respuesta != NULL)
            if($respuesta[0]->estado = "pagado" || $respuesta[0]->estado = "servido"){
                $newResponse = $response->withJson("el pedido ya esta listo", 200);
            }else{
                $newResponse = $response->withJson($respuesta, 200);
            }
            
        else
            $newResponse = $response->withJson("error", 404);

        return $newResponse;        
    }


    public function nuevaEncuesta($request, $response, $args){
        $arrayDeParametros = $request->getParsedBody();
        $respuesta = cliente::nuevaEncuesta($arrayDeParametros);

        if($respuesta>0){
            $objDelaRespuesta->respuesta="Nuevo encuesta cargada.";
        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;  
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }



}


?>