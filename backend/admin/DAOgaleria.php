<?php

require_once 'LibreriaPDO.php';
require_once 'models/galeri.php';

class Daogalerias extends DB {
    
        public $galerias=array();  
        
        public function Listar()
        {
            
            $this->galerias=array();  
            
            $consulta="select * from galeria";
            
            $param=array(); 
            
            $this->ConsultaDatos($consulta, $param);
            
            foreach ($this->filas as  $fila )
            {
                $galeria=new galeria();      
                
                $galeria->__SET("id",$fila['id']);           
                $galeria->__SET("imagen",$fila['imagen']);
            
                $this->galerias[]=$galeria;          
            }
            
        }


        public function Insertar($galeria)  
        {
          $consulta="insert into galeria values (NULL,:imagen,:id_usuario)";
        
          $param=array(
            ":imagen"=>$galeria->__get("imagen"),
            ":id_usuario"=>$tatuador->__get("id_usuario")
          );

          return $this->ConsultaDatos($consulta, $param, true); 
        }
    
        
        public function Borrar($id)  
        {
            $consulta="delete from galeria where id=:id";
            
            $param=array(":id"=>$id);
            
            $this->ConsultaSimple($consulta, $param); 
             
        }
        
              
    
}


?>