<?php
require_once './composer/vendor/autoload.php';
require_once './clases/login.php';
require_once './clases/AutJWT.php';

class loginApi{

    public function consulta($request, $response, $args){
        $arrayDeParametros = $request->getParsedBody(); 
        //var_dump($arrayDeParametros);
        //var_dump($arrayDeParametros["user"]);
        $respuesta = login::consultaLogin($arrayDeParametros);
        var_dump($respuesta);

        if($respuesta != NULL)
            $newResponse = $response->withJson(AutJWT::CrearToken($respuesta), 200);
        else
            $newResponse = $response->withJson("Usuario y clave no valido, intente nuevamente", 404);

        return $newResponse;        
    }


    public function nuevoUsuario($request, $response, $args){
        $arrayDeParametros = $request->getParsedBody();
        $respuesta = login::creaUsuario($arrayDeParametros);

        if($respuesta>0){
            $objDelaRespuesta->respuesta="Nuevo Usuario guardado.";
        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;  
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }


    public function traerTodos($request, $response, $args){
        $usuarios = login::TraerTodos();
        $newResponse = $response->withJson($usuarios, 200);
        return $newResponse;
    }

}


?>