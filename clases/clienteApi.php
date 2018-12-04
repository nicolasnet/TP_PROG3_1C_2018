<?php
require_once './composer/vendor/autoload.php';
require_once './clases/cliente.php';

class clienteApi{

    public function consulta($request, $response, $args){
        $arrayDeParametros = $request->getParsedBody(); 
        $respuesta = cliente::consultaPedido($arrayDeParametros);
        
        if($respuesta != NULL)
            $newResponse = $response->withJson($respuesta, 200);
        else
            $newResponse = $response->withJson("", 404);

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