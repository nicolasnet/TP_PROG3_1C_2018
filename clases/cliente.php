<?php
use \Firebase\JWT\JWT;
require_once "./clases/AccesoDatos.php";

class cliente{

    public static function consultaPedido($arrayDeParametros){        
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        
        $sql = $pdo->RetornarConsulta("SELECT TIMESTAMPDIFF(MINUTE,CURDATE(), fechaTerminado) AS Minutos_Restantes, estado FROM pedidos WHERE codigo=:codigo AND mesa=:mesa");
        $sql->bindValue(':codigo',$arrayDeParametros['codigo'], PDO::PARAM_STR);
        $sql->bindValue(':mesa', $arrayDeParametros['mesa'], PDO::PARAM_STR);
        
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        
        return $resultado;
    }


    public static function nuevaEncuesta($arrayDeParametros){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("INSERT into encuesta (codigo, ptoMesa, ptoResto, ptoMozo, ptoCocinero, texto)values(:codigo,:ptoMesa,:ptoResto,:ptoMozo,:ptoCocinero, :texto)");

            $sql->bindValue(':codigo', $arrayDeParametros['codigo'], PDO::PARAM_STR);
            $sql->bindValue(':ptoMesa', $arrayDeParametros['ptoMesa'], PDO::PARAM_INT);
            $sql->bindValue(':ptoResto', $arrayDeParametros['ptoResto'], PDO::PARAM_INT);
            $sql->bindValue(':ptoMozo', $arrayDeParametros['ptoMozo'], PDO::PARAM_INT);
            $sql->bindValue(':ptoCocinero', $arrayDeParametros['ptoCocinero'], PDO::PARAM_INT);
            $sql->bindValue(':texto', $arrayDeParametros['texto'], PDO::PARAM_STR);

            $sql->execute();            
            return $sql->rowCount();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }



}



?>