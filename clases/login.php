<?php
use \Firebase\JWT\JWT;
require_once "./clases/AccesoDatos.php";

class login{

    public $usuario;
    public $clave;
    public $perfil;
    public $nombre;
    public $apellido;
    public $estado;

    public static function consultaLogin($arrayDeParametros){        
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        
        $sql = $pdo->RetornarConsulta("SELECT * FROM usuarios WHERE usuario=:usuario");
        $sql->bindValue(':usuario',$arrayDeParametros['usuario'], PDO::PARAM_STR);
        
        $sql->execute();

        $usuario = $sql->fetchAll(PDO::FETCH_CLASS, 'login');

        if($usuario!=NULL){
            if($usuario[0]->clave == $arrayDeParametros['clave']){
                if($usuario[0]->estado ==1 || $usuario[0]->estado =="activo"){
                    $resultado = $usuario;
                }
                else{
                    $resultado="El usuario no esta activo";
                }
                
            }
            else{
                $resultado="Clave no valida";
            }
        }
        else{
            $resultado = "Usuario no valido";
        }

        //var_dump($usuario[0]->clave); 

        return $resultado;
    }


    public static function creaUsuario($arrayDeParametros){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("INSERT into usuarios (usuario,clave,perfil,nombre,apellido)values(:usuario,:clave,:perfil,:nombre,:apellido)");

            $nombre = ucwords(strtolower($arrayDeParametros['nombre']));
            $apellido = ucwords(strtolower($arrayDeParametros['apellido']));
            

            $sql->bindValue(':usuario', strtoupper(str_split($arrayDeParametros['perfil'],3)[0])."_".strtoupper($arrayDeParametros['apellido']).".".strtoupper(str_split($arrayDeParametros['nombre'],4)[0]), PDO::PARAM_STR);
            $sql->bindValue(':clave', $arrayDeParametros['clave'], PDO::PARAM_STR);
            $sql->bindValue(':perfil', strtolower($arrayDeParametros['perfil']), PDO::PARAM_STR);
            $sql->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $sql->bindValue(':apellido', $apellido, PDO::PARAM_STR);
            $sql->execute();            
            return $sql->rowCount();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }


    public static function TraerTodos(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $sql = $pdo->RetornarConsulta("select * from usuarios");
        $sql->execute();

        $resultado = $sql->fetchall(PDO::FETCH_CLASS, "login");       

        return $resultado;
    }


    public function actualizarEstadoUsuario($arrayDeParametros)
    {
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        try{
            $sql =$pdo->RetornarConsulta("UPDATE usuarios
            SET  estado= :estado
            WHERE id=:id");
            
            $sql->bindValue(':id', $arrayDeParametros['id'], PDO::PARAM_INT);
            $sql->bindValue(':estado', $arrayDeParametros['estado'], PDO::PARAM_INT);
            $sql->execute();
            return $sql->rowCount();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }


}



?>