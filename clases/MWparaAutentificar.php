<?php

require_once './clases/AutJWT.php';
//require_once './clases/compraApi.php';

class MWparaAutentificar
{
 /**
   * @api {any} /MWparaAutenticar/  Verificar Usuario
   * @apiVersion 0.1.0
   * @apiName VerificarUsuario
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare verifico las credeciales antes de ingresar al correspondiente metodo 
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next  The next middleware callable.
   *
   * @apiExample Como usarlo:
   *    ->add(\MWparaAutenticar::class . ':VerificarUsuario')
   */
	public function VerificarUsuario($request, $response, $next) {
         
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
	   
		if($request->isGet())
		{
		// $response->getBody()->write('<p>NO necesita credenciales para los get </p>');
		 $response = $next($request, $response);
		}
		else
		{
			$arrayConToken = $request->getHeader('token');
			$token=$arrayConToken[0];			
			
			//var_dump($token);
			$objDelaRespuesta->esValido=true; 
			try 
			{				
				AutJWT::VerificarToken($token);
				$objDelaRespuesta->esValido=true; 
			}
			catch (Exception $e) {      
				//guardar en un log
				$objDelaRespuesta->excepcion=$e->getMessage();
				$objDelaRespuesta->esValido=false;     
			}

			if($objDelaRespuesta->esValido)
			{						
				if($request->isPost())
				{		
					// el post sirve para todos los logeados			    
					$response = $next($request, $response);
				}
				else
				{
					$response = $next($request, $response);
					/*
					$payload=AutJWT::ObtenerData($token);
					//var_dump($payload);
					// DELETE,PUT y DELETE sirve para todos los logeados y admin
					if($payload->perfil=="Administrador")
					{
						$response = $next($request, $response);
					}		           	
					else
					{	
						$objDelaRespuesta->respuesta="Solo administradores";
					}
					*/
				}		          
			}    
			else
			{
				//   $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
				$objDelaRespuesta->respuesta="Solo usuarios registrados";
				$objDelaRespuesta->elToken=$token;

			}  
		}		  
		if($objDelaRespuesta->respuesta!="")
		{
			$nueva=$response->withJson($objDelaRespuesta, 401);  
			return $nueva;
		}
		  
		 //$response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
		 return $response;   
	}











	public function VerificarJWT($request, $response, $next) {
         
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";	   
		
		$arrayConToken = $request->getHeader('token');
		$token=$arrayConToken[0];			
		
		//var_dump($token);
		$objDelaRespuesta->esValido=true; 
		try 
		{				
			AutJWT::VerificarToken($token);
			$objDelaRespuesta->esValido=true; 
		}
		catch (Exception $e) {      
			//guardar en un log
			$objDelaRespuesta->excepcion=$e->getMessage();
			$objDelaRespuesta->esValido=false;
		}

		if($objDelaRespuesta->esValido)
		{			    
			$response = $next($request, $response);
			
		}    
		else
		{
			//   $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
			$objDelaRespuesta->respuesta="Solo usuarios registrados";
			$objDelaRespuesta->elToken=$token;

		}  
				  
		if($objDelaRespuesta->respuesta!="")
		{
			$nueva=$response->withJson($objDelaRespuesta, 401);  
			return $nueva;
		}
		  
		 //$response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
		 return $response;   
	}













	public function VerificarPerfilUsuario($request, $response, $next) {
	   $objDelaRespuesta= new stdclass();
	   $objDelaRespuesta->respuesta="";
	  
	   
		$arrayConToken = $request->getHeader('token');
		$token=$arrayConToken[0];			
		
		//var_dump($token);
		$objDelaRespuesta->esValido="";
		try 
		{				
			AutJWT::VerificarToken($token);
			$objDelaRespuesta->esValido=true; 
		}
		catch (Exception $e) {      
			//guardar en un log
			$objDelaRespuesta->excepcion=$e->getMessage();
			$objDelaRespuesta->esValido=false;     
		}

		if($objDelaRespuesta->esValido)
		{
			
			$payload=AutJWT::ObtenerData($token);
			if($payload[0]->perfil=="socio")
			{
				$response = $next($request, $response);
			}		           	
			else
			{	
				$objDelaRespuesta->respuesta="Exclusivo uso de Socios"; 
			}		          
		}    
		else
		{
			//   $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
			$objDelaRespuesta->respuesta="Solo usuarios registrados";
			$objDelaRespuesta->elToken=$token;

		}  

	   if($objDelaRespuesta->respuesta!="")
	   {
		   $nueva=$response->withJson($objDelaRespuesta, 401);
		   return $nueva;
	   }
		 
		//$response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
		return $response;   
   }











   public function VerificarPerfilUsuarioCompras($request, $response, $next) {
	$objDelaRespuesta= new stdclass();
	$objDelaRespuesta->respuesta="";
   
	
	 $arrayConToken = $request->getHeader('token');
	 $token=$arrayConToken[0];
	 
	 //var_dump($token);
	 $objDelaRespuesta->esValido="";
	 try 
	 {				
		 AutJWT::VerificarToken($token);
		 $objDelaRespuesta->esValido=true; 
	 }
	 catch (Exception $e) {      
		 //guardar en un log
		 $objDelaRespuesta->excepcion=$e->getMessage();
		 $objDelaRespuesta->esValido=false;     
	 }

	 if($objDelaRespuesta->esValido)
	 {		 
		$payload=AutJWT::ObtenerData($token);
			if($payload[0]->perfil=="admin")
			{
				$response = $next($request, $response);
			}		           	
			else
			{	
				$objDelaRespuesta->respuesta= compraApi:: traerUno($request, $response);
			}		  
	 }    
	 else
	 {
		 //   $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
		 $objDelaRespuesta->respuesta="Solo usuarios registrados";
		 $objDelaRespuesta->elToken=$token;

	 }  

	if($objDelaRespuesta->respuesta!="")
	{
		$nueva=$response->withJson($objDelaRespuesta, 401);
		return $nueva;
	}
	  
	 //$response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
	 return $response;   
}


   public function GuardarUsuarioRuta($request, $response, $next) {
        $objDelaRespuesta= new stdclass();
        $objDelaRespuesta->respuesta="";
        
        $usuario='';
        $metodo='';
        $ruta='';

        if($request->isPost())
        {
            $metodo="post";
        }
        else
        {
            $metodo="get";
        }

		$uri=$request->getUri();
		$ruta=$uri->getPath();
		/*
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date("H:i:s");
		*/
        $arrayConToken = $request->getHeader('token');
        if(count($arrayConToken)>0)
        {
            $token=$arrayConToken[0];
			$payload=AutJWT::ObtenerData($token);
			$usuario = $payload[0]->usuario;
        }
        else
        {
            $usuario="Usuario no logueado";
        }
        
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("insert into `datos_ingresos`(`usuario`, `metodo`, `ruta`) values ('$usuario', '$metodo', '$ruta')");
        $consulta->execute();
		
        $response = $next($request, $response);
        return $response;
    }










}