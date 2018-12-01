<?php
use \Firebase\JWT\JWT;
require_once "./clases/AccesoDatos.php";
require_once './clases/AutJWT.php';

/*
SELECT DATEDIFF(hora_ingreso, "2017-06-15 15:25:35") as hora, id, nombre
from tabla
where codigo=xxxx
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



    public function agregarProducto($json, $codigo)
    {
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("INSERT into pedido_producto (codigo, idProducto, cantidad)values(:codigo,:idProducto,:cantidad)");
            
            $sql->bindValue(':codigo', $codigo, PDO::PARAM_STR);         
            $sql->bindValue(':idProducto', $json->idProducto, PDO::PARAM_INT);
            $sql->bindValue(':cantidad', $json->cantidad, PDO::PARAM_INT);

            $sql->execute();
            return $sql->rowCount();
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