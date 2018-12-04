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


UPDATE `pedido_producto` SET `tiempo`=2,`fechaTerminado`=(`fechaInicio`+ INTERVAL 2 MINUTE) where codigo="JwN68" AND idProducto=1



UPDATE `pedido_producto` AS pp
INNER JOIN menu AS m ON pp.idProducto = m.id
SET pp.precio = m.precio*pp.cantidad
	
WHERE codigo="JwN68"





UPDATE `pedido_producto` AS pp
INNER JOIN menu AS m ON pp.idProducto = m.id
SET pp.precio = m.precio*pp.cantidad,
	pp.tiempo = 5,
    pp.fechaTerminado=(pp.fechaInicio + INTERVAL 5 MINUTE)
WHERE codigo="JwN68"






//ejemplo de internet:
UPDATE business AS b
INNER JOIN business_geocode AS g ON b.business_id = g.business_id
SET b.mapx = g.latitude,
  b.mapy = g.longitude
WHERE  (b.mapx = '' or b.mapx = 0) and
  g.latitude > 0

*/


class pedido_producto{

    public $codigo;
    public $idProducto; 
    public $estado;
    public $cantidad;
    public $precio;
    public $fechaInicio;
    public $tiempo;
    public $fechaTerminado;
    

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



    public function actualizarProductoEnPreparacion($arrayDeParametros, $usuario)
    {
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("UPDATE pedido_producto AS pp
            INNER JOIN menu AS m ON pp.idProducto = m.id
            INNER JOIN pedidos AS p ON pp.codigo = p.codigo
            INNER JOIN mesas AS me ON me.id = p.mesa
            SET pp.precio = m.precio*pp.cantidad,
                pp.tiempo = :tiempo,
                pp.fechaTerminado=(pp.fechaInicio + INTERVAL :tiemposuma MINUTE),
                pp.usuario = :usuario,
                me.estado = 2,
                me.limpia = 2,
                pp.estado= 2,
                p.estado= 2,
                p.tiempo = IF(p.tiempo<:tiempoPedido,:tiempoPedido2, p.tiempo),
                p.fechaTerminado = (p.fechaInicio + INTERVAL :tiemposuma2 MINUTE)
            WHERE pp.codigo=:codigo AND pp.idProducto=:idProducto");
            
            $sql->bindValue(':codigo', $arrayDeParametros['codigo'], PDO::PARAM_STR);
            $sql->bindValue(':usuario', $usuario, PDO::PARAM_INT);
            $sql->bindValue(':tiempo', $arrayDeParametros['tiempo'], PDO::PARAM_INT);
            $sql->bindValue(':tiempoPedido', $arrayDeParametros['tiempo'], PDO::PARAM_INT);
            $sql->bindValue(':tiempoPedido2', $arrayDeParametros['tiempo'], PDO::PARAM_INT);
            $sql->bindValue(':tiemposuma', $arrayDeParametros['tiempo'], PDO::PARAM_INT);
            $sql->bindValue(':tiemposuma2', $arrayDeParametros['tiempo'], PDO::PARAM_INT);
            $sql->bindValue(':idProducto', $arrayDeParametros['idProducto'], PDO::PARAM_INT);

            $sql->execute();
            return $sql->rowCount();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }



    public function actualizarProductoListoParaServir($arrayDeParametros)
    {
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("UPDATE pedido_producto
            SET  estado= 3
            WHERE codigo=:codigo AND idProducto=:idProducto AND estado=2");
            
            $sql->bindValue(':codigo', $arrayDeParametros['codigo'], PDO::PARAM_STR);
            $sql->bindValue(':idProducto', $arrayDeParametros['idProducto'], PDO::PARAM_INT);

            $sql->execute();
            return $sql->rowCount();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }



    public function actualizarProductoServido($arrayDeParametros)
    {
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("UPDATE pedido_producto AS pp
            INNER JOIN pedidos AS p ON pp.codigo = p.codigo
            INNER JOIN mesas AS me ON me.id = p.mesa
            SET pp.estado = 4,
                me.estado = 3
            WHERE pp.codigo=:codigo AND pp.idProducto=:idProducto");
            
            $sql->bindValue(':codigo', $arrayDeParametros['codigo'], PDO::PARAM_STR);
            $sql->bindValue(':idProducto', $arrayDeParametros['idProducto'], PDO::PARAM_INT);

            $sql->execute();
            return $sql->rowCount();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }






    public static function TraerTodos(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select * from pedido_producto");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "pedido_producto");   

        return $resultado;
    }    



    public static function TraerPorCodigo($codigo){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT * FROM pedido_producto WHERE codigo=:codigo");
        $sql->bindValue(':codigo',$codigo, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "pedido_producto");
        
        return $resultado;
    }



    public static function TraerProductosPorPerfil($perfil, $idUsuario){
        //var_dump($perfil);
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $resultado;
        switch ($perfil){
            case "cocinero":
                $sql = $pdo->RetornarConsulta("SELECT pp.codigo, pp.estado, pp.cantidad, pp.idProducto, m.producto FROM pedido_producto AS pp INNER JOIN menu AS m ON pp.idProducto = m.id WHERE pp.estado='pendiente' AND m.sector='cocina' OR m.sector='candy'");
                $sql->execute();
                $resultado = $sql->fetchall(PDO::FETCH_OBJ);
                //echo("Entro en cocinero\n");
                break;
            
            case "bartender":
                $sql = $pdo->RetornarConsulta("SELECT pp.codigo, pp.estado, pp.cantidad, pp.idProducto, m.producto FROM pedido_producto AS pp INNER JOIN menu AS m ON pp.idProducto = m.id WHERE pp.estado='pendiente' AND m.sector='barra'");
                $sql->execute();
                $resultado = $sql->fetchall(PDO::FETCH_OBJ);
                break;

            case "cervecero":
                $sql = $pdo->RetornarConsulta("SELECT pp.codigo, pp.estado, pp.cantidad, pp.idProducto, m.producto FROM pedido_producto AS pp INNER JOIN menu AS m ON pp.idProducto = m.id WHERE pp.estado='pendiente' AND m.sector='cerveza'");
                $sql->execute();
                $resultado = $sql->fetchall(PDO::FETCH_OBJ);
                break;

            case "socio":
                $resultado = self::TraerTodos();
                break;
            
            case "mozo":
                $resultado = self::TraerPorUsuario($idUsuario);
                break;
        }
        //var_dump($resultado);
        return $resultado;

    }

    


    public static function TraerPorUsuario($usuario){
        //var_dump($usuario);

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT pp.codigo, pp.idProducto, pp.cantidad, pp.fechaInicio, p.mesa, p.cliente FROM pedido_producto AS pp INNER JOIN pedidos AS p ON pp.codigo = p.codigo WHERE p.usuario=:usuario");
        $sql->bindValue(':usuario',$usuario, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_OBJ);
        
        return $resultado;
    }


    public static function TraerListosParaServirPorUsuario($usuario){
        //var_dump($usuario);

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT pp.codigo, pp.idProducto, pp.cantidad, pp.fechaTerminado, p.mesa, p.cliente FROM pedido_producto AS pp INNER JOIN pedidos AS p ON pp.codigo = p.codigo WHERE pp.estado=3 AND p.usuario=:usuario");
        $sql->bindValue(':usuario',$usuario, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_OBJ);
        
        return $resultado;
    }



    public static function TraerSumaPrecioPorCodigo($codigo){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("SELECT SUM(precio) AS precioFinal FROM pedido_producto WHERE codigo=:codigo");
        $sql->bindValue(':codigo',$codigo, PDO::PARAM_STR);
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_OBJ);
        
        return $resultado[0]->precioFinal;
    }





    /*

    public static function TraerTodosProductos(){

        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select distinct `estado`, `codigo` FROM `pedidos`");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "pedido");
        
        return $resultado;
    }
    */

    
}



?>