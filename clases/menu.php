<?php
use \Firebase\JWT\JWT;
require_once "./clases/AccesoDatos.php";

class menu{
    public $id;
    public $producto;
    public $sector;
    public $precio;
    

    public static function crearMenu($arrayDeParametros){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("INSERT into menu (producto, sector, precio)values(:producto,:sector,:precio)");

            $sql->bindValue(':producto', $arrayDeParametros['producto'], PDO::PARAM_STR);
            $sql->bindValue(':sector', $arrayDeParametros['sector'], PDO::PARAM_STR);
            $sql->bindValue(':precio', $arrayDeParametros['precio'], PDO::PARAM_STR);
            $sql->execute();
            return $pdo->RetornarUltimoIdInsertado();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }


    public static function TraerTodos(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select * from menu");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "menu");   

        return $resultado;
    }



    public static function TraerPorid($id){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT * FROM menu WHERE id=:id");
        $sql->bindValue(':id',$id, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "menu");
        
        return $resultado;

    }





    /*
    public static function TraerTodosPorSector(){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select distinct `sector`, `id` FROM `menu`");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "menu");
        
        return $resultado;
    }
    

    public static function TraerUnoPorproducto($producto){
        //var_dump($producto);

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT * FROM menu WHERE producto=:producto");
        $sql->bindValue(':producto',$producto, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "menu");
        
        return $resultado;

    }
    */

}
?>