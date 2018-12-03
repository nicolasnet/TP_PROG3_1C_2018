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


    public static function TraerTodos(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select * from pedido_producto");
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