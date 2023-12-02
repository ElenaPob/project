<?php

require_once 'LibreriaPDO.php';
require_once 'models/usuario.php';

class Daousuario extends DB {
    
        public $usuarios=array();  
        
        public function Listar()
        {
            
            $this->usuarios=array();   //Reseteamos el array de usuarios
            
            $consulta="select * from usuarios";
            
            $param=array(); 
            
            $this->ConsultaDatos($consulta, $param);
            
            foreach ($this->filas as  $fila )
            {
                $usuario=new usuario();       //Creamos una instancia de la clase usuario
                
                $usuario->__SET("id",$fila['id']);           //Pasamos los datos del array fila al objeto usuario
                $usuario->__SET("usuario",$fila['usuario']);
                $usuario->__SET("password",$fila['password']);
                $usuario->__SET("rol",$fila['rol']);
                $usuario->__SET("email",$fila['email']);
            
                $this->usuarios[]=$usuario;         //Guardamos esa usuario en el array de objetos usuarios
                
            }
            
            
        }


        
        
        
        public function Insertar($usuario)     //Inserta una usuario en la tabla
        {
          $consulta="insert into usuarios values (NULL,:usuario,:password,:rol,:email)";
        
          $param=array(
            ":usuario"=>$usuario->__get("usuario"),
            ":password"=>$usuario->__get("password"),
            ":rol"=>$usuario->__get("rol"),
            ":email"=>$usuario->__get("email")
          );

          
          
          return $this->ConsultaDatos($consulta, $param, true);  //Ejecutmos la consulta de insercci�n

          
        }
    
        
        public function Borrar($id)     //Borra una usuario a partir de su id
        {
            $consulta="delete from usuarios where id=:id";
            
            $param=array(":id"=>$id);
            
            $this->ConsultaSimple($consulta, $param);  //Ejecutmos la consulta de insercci�n
            
            
        }
        
        public function Actualizar($usuario)     //Actualiza una usuario de la tabla
        {
            $consulta="update usuarios set :usuario,:password,:rol,:email  where id=:id ";
            
            $param=array(
                ":usuario"=>$usuario->__get("usuario"),
                ":password"=>$usuario->__get("password"),
                ":rol"=>$usuario->__get("rol"),
                ":email"=>$usuario->__get("email")
            );
            
            $this->ConsultaDatos($consulta, $param);  //Ejecutmos la consulta de actualizacion
           
        }
              
    
}


?>