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
        
        $respuesta = compra::crearPedido($arrayDeParametros, $payload[0]->usuario);


        $archivos = $request->getUploadedFiles();
        
        $foto= $archivos['imagen'];
        //var_dump($respuesta);

        if($respuesta>0){

            $nuevaCarpeta="IMGpedidos";
            if(!file_exists($nuevaCarpeta))
            {
                mkdir($nuevaCarpeta);
            }
            $nuevoNombre="./".$nuevaCarpeta."/".$respuesta."-".$arrayDeParametros["marca"]."-".$arrayDeParametros["modelo"].".jpg";
            //var_dump($nuevoNombre);
            $foto->moveTo($nuevoNombre);

            $objDelaRespuesta->respuesta="Nueva compra guardado.";
        }
        else{
            $objDelaRespuesta->respuesta=$respuesta;   
        }
        
        return $response->withJson($objDelaRespuesta, 200);
    }


    public function traerTodos($request, $response, $args){   
        $pedidos = compra::TraerTodos();
        $newResponse = $response->withJson($pedidos, 200);
        return $newResponse;
    }


    public function traerUnoUsuario($request, $response){
        $arrayConToken = $request->getHeader('token');
	    $token=$arrayConToken[0];
        $payload=AutJWT::ObtenerData($token);
        //var_dump($payload);
        //var_dump($payload[0]->email);
        
        $pedidos = compra::TraerUnoPorUsuario($payload[0]->email);
        $newResponse = $pedidos;
        return $newResponse;
    }


    public function traerUnoMarca($request, $response){
        
        $pedidos = compra::TraerPorCodigo($_GET["marca"]);
        //var_dump($pedidos);
        $newResponse = $response->withJson($pedidos, 200);
        return $newResponse;
    }
    
    /*
    public function traerProductos($request, $response){
        
        $listadoPedidos = compra::TraerTodosProductos();
        $output = array();
        var_dump($listadoPedidos);
        foreach($listadoPedidos as $compra)
        {
            $objeto = "{'marca':".$compra->marca.", 'modelo':". $compra->modelo."}";
            var_dump(json_decode($objeto));

            array_push($output, $compra->marca." ".$compra->modelo);
        }

        $newResponse = $response->withJson($output, 200);
        return $newResponse;
    }
    */



}






?>