<?php
use \Firebase\JWT\JWT;
require_once "./clases/AccesoDatos.php";
require_once './clases/AutJWT.php';

/*
SELECT DATEDIFF(hora_ingreso, "2017-06-15 15:25:35") as hora, id, nombre
from tabla
where codigo=xxxx



SELECT TIMESTAMPDIFF(MINUTE,`fechaInicio`, "2018-12-01 19:42:37") as LAhora, codigo, idProducto, estado, fechaInicio
from pedido_producto
where codigo="JwN68"


SELECT (`fechaInicio`+ INTERVAL 2 MINUTE) as LAhora, fechaInicio, codigo
from pedido_producto
where codigo="JwN68"


UPDATE `pedido_producto` SET `tiempo`=2,`fechaTerminado`=(`fechaInicio`+ INTERVAL 2 MINUTE)
where codigo="JwN68" AND idProducto=1

*/


class pedido{

    public $codigo;
    public $usuario;    
    public $estado;
    public $mesa;
    public $precioFinal;    
    public $fechaInicio;
    public $tiempo;
    public $fechaTerminado;
    public $cliente;
    public $imagen;        
    

    public static function crearPedido($arrayDeParametros, $usuario){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("INSERT into pedidos (usuario, codigo, mesa, cliente)values(:usuario,:codigo,:mesa,:cliente)");
            
            $codigo = AutJWT::generateRandomString(5);
            
            $sql->bindValue(':codigo', $codigo, PDO::PARAM_STR);
            $sql->bindValue(':usuario', $usuario, PDO::PARAM_STR);            
            $sql->bindValue(':mesa', $arrayDeParametros['mesa'], PDO::PARAM_INT);
            $sql->bindValue(':cliente', $arrayDeParametros['cliente'], PDO::PARAM_STR);

            $sql->execute();
            return self::TraerPorCodigo($codigo);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }




    public static function TraerTodos(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select * from pedidos");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "pedido");   

        return $resultado;

    }


    public static function TraerPorUsuario($usuario){
        //var_dump($usuario);

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT * FROM pedidos WHERE usuario=:usuario");
        $sql->bindValue(':usuario',$usuario, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "pedido");
        
        return $resultado;

    }


    public static function TraerPorCodigo($codigo){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT * FROM pedidos WHERE codigo=:codigo");
        $sql->bindValue(':codigo',$codigo, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "pedido");
        
        return $resultado;

    }



    public static function TraerTodosProductos(){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select distinct `estado`, `codigo` FROM `pedidos`");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "pedido");
        
        return $resultado;
    }
}



?>