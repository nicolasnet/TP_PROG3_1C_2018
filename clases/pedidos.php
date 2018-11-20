<?php
use \Firebase\JWT\JWT;
require_once "./clases/AccesoDatos.php";

class pedido{

    public $usuario;
    public $codigo;
    public $estado;
    public $fecha;
    public $precio;
    

    public static function crearPedido($arrayDeParametros, $usuario){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("INSERT into pedidos (usuario, codigo, estado, fecha, precio)values(:usuario,:codigo,:estado,:fecha,:precio)");

            $sql->bindValue(':usuario', $usuario, PDO::PARAM_STR);
            $sql->bindValue(':codigo',$arrayDeParametros['codigo'], PDO::PARAM_STR);
            $sql->bindValue(':estado', $arrayDeParametros['estado'], PDO::PARAM_STR);
            $sql->bindValue(':fecha', $arrayDeParametros['fecha'], PDO::PARAM_STR);
            $sql->bindValue(':precio', $arrayDeParametros['precio'], PDO::PARAM_INT);
            $sql->execute();
            return $pdo->RetornarUltimoIdInsertado();
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


    public static function TraerUnoPorUsuario($usuario){
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