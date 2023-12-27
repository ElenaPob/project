<?php

require_once 'LibreriaPDO.php';
require_once 'models/galeria.php';

class Daogaleria extends DB {
    
        public $galerias=array();  
        
        public function Listar()
        {
            $this->galerias=array();  
            
            $consulta="SELECT * FROM galeria";
            
            $param=array(); 
            
            $this->ConsultaDatos($consulta, $param);
            //print_r($consulta);
            foreach ($this->filas as $fila)
            {
                $galeria=new galeria();      
                
                $galeria->__SET("id",$fila['id']);           
                $galeria->__SET("imagen",$fila['imagen']);
                $galeria->__SET("id_tatuador",$fila['id_tatuador']);  
            
                $this->galerias[]=$galeria;          
            }

        }

        public function GestionarGaleria($id_tatuador)
        {
            $this->galerias=array();  
            
            $consulta="SELECT * FROM galeria where id_tatuador=$id_tatuador";
            
            $param=array(); 
            
            $this->ConsultaDatos($consulta, $param);

            foreach ($this->filas as $fila)
            {
                $galeria=new galeria();      
                
                $galeria->__SET("id",$fila['id']);           
                $galeria->__SET("imagen",$fila['imagen']);
                $galeria->__SET("id_tatuador",$fila['id_tatuador']);  
            
                $this->galerias[]=$galeria;          
            }

        }


        public function Insertar($galeria)  
        {
          $consulta="insert into galeria values (NULL,:imagen,:id_tatuador)";
        
          $param=array(
            ":imagen"=>$galeria->__get("imagen"),
            ":id_tatuador"=>$galeria->__get("id_tatuador")
          );

          return $this->ConsultaDatos($consulta, $param, true); 
        }
    
        
        public function Borrar($id)  
        {
            $consulta="delete from galeria where id=:id";
            
            $param=array(":id"=>$id);
            
            $this->ConsultaSimple($consulta, $param); 
             
        }

        public function BorrarGaleriaEntera($id_tatuador)  
        {
            $consulta="delete from galeria where id_tatuador=:id_tatuador";
            
            $param=array(":id_tatuador"=>$id_tatuador);
            
            $this->ConsultaSimple($consulta, $param); 
             
        }
        
              
    
}


?>