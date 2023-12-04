<?php

require_once 'LibreriaPDO.php';
require_once 'models/usuario.php';

class Daousuario extends DB {
    
        public $usuarios=array();  
        
        public function Listar()
        {
            
            $this->usuarios=array(); 
            
            $consulta="select * from usuarios";
            
            $param=array(); 
            
            $this->ConsultaDatos($consulta, $param);
            
            foreach ($this->filas as  $fila )
            {
                $usuario=new usuario();     
                
                $usuario->__SET("id",$fila['id']);          
                $usuario->__SET("usuario",$fila['usuario']);
                $usuario->__SET("password",$fila['password']);
                $usuario->__SET("rol",$fila['rol']);
                $usuario->__SET("email",$fila['email']);
            
                $this->usuarios[]=$usuario;    
                
            }
            
            
        }

        
        public function Insertar($usuario)     
        {
          $consulta="insert into usuarios values (NULL,:usuario,:password,:rol,:email)";
        
          $param=array(
            ":usuario"=>$usuario->__get("usuario"),
            ":password"=>$usuario->__get("password"),
            ":rol"=>$usuario->__get("rol"),
            ":email"=>$usuario->__get("email")
          );

          
          
          return $this->ConsultaDatos($consulta, $param, true);  

          
        }
    
        
        public function Borrar($id)  
        {
            $consulta="delete from usuarios where id=:id";
            
            $param=array(":id"=>$id);
            
            $this->ConsultaSimple($consulta, $param);
            
            
        }
        
        public function Actualizar($usuario)   
        {
            $consulta="update usuarios set :usuario,:password,:rol,:email  where id=:id ";
            
            $param=array(
                ":usuario"=>$usuario->__get("usuario"),
                ":password"=>$usuario->__get("password"),
                ":rol"=>$usuario->__get("rol"),
                ":email"=>$usuario->__get("email")
            );
            
            $this->ConsultaDatos($consulta, $param);  
           
        }
              
    
}


?>