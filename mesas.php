<?php
use \Firebase\JWT\JWT;
require_once "./clases/AccesoDatos.php";

class mesas{

    public $prefijoME;
    public $id;
    public $estado;    
    public $limpia;
    

    public static function crearmesas(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("INSERT into mesas (estado)values(1)");

            $sql->execute();
            return $pdo->RetornarUltimoIdInsertado();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }


    public static function TraerTodos(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select * from mesas");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "mesas");   

        return $resultado;
    }



    public static function TraerPorid($id){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT * FROM mesas WHERE id=:id");
        $sql->bindValue(':id',$id, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "mesas");
        
        return $resultado;
    }


    public static function TraerTodosPorLimpia($limpia){
        //var_dump($limpia);

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT * FROM mesas WHERE limpia=:limpia");
        $sql->bindValue(':limpia',$limpia, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "mesas");
        
        return $resultado;

    }


    /*
    public static function TraerTodosPorestado(){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select distinct `estado`, `id` FROM `mesas`");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "mesas");
        
        return $resultado;
    }      

    */

}
?>