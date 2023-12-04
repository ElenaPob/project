<?php

    require_once 'LibreriaPDO.php';
    require_once 'models/pedido.php';

    class Daopedido extends DB {
        
            public $pedidos=array();    
            
            public function Listar()
            {
                
                $this->pedidos=array();   
                
                $consulta="select * from pedido";
                
                $param=array(); 
                
                $this->ConsultaDatos($consulta, $param);
                
                foreach ($this->filas as  $fila )
                {
                    $pedido= new pedido();       
                    
                    $pedido->__SET("id",$fila['id']);           
                    $pedido->__SET("id_tatuador",$fila['id_tatuador']);
                    $pedido->__SET("detalle",$fila['detalle']);
                    $pedido->__SET("fecha",$fila['fecha']);
                    $pedido->__SET("estado",$fila['estado']);
                
                    $this->pedidos[]=$pedido;   
                    
                }
                
                
            }
            
            
            public function Insertar($pedido)  
            {
                $consulta="insert into pedido values (NULL,:id_tatuador,:detalle,:fecha,:estado)";
                
                $param=array(
                    ":nombre"=>$pedido->__get("id_tatuador"),
                    ":apellido"=>$pedido->__get("detalle"),
                    ":estilo"=>$pedido->__get("fecha"),
                    ":descripcion"=>$pedido->__get("estado")
                );
                
                $this->ConsultaDatos($consulta, $param); 
            
            }
        
            
            public function Borrar($id) 
            {
                $consulta="delete from pedido where id=:id";
                
                $param=array(":id"=>$id);
                
                $this->ConsultaSimple($consulta, $param); 
                
                
            }
            
            public function Actualizar($pedido)  
            {

                $consulta="update pedido set :id_tatuador,:detalle,:fecha,:estado where id=:id ";
                
                $param=array(
                    ":id"=>$pedido->__get("id"),
                    ":nombre"=>$pedido->__get("id_tatuador"),
                    ":apellido"=>$pedido->__get("detalle"),
                    ":estilo"=>$pedido->__get("fecha"),
                    ":descripcion"=>$pedido->__get("estado")
                );
                
                $this->ConsultaDatos($consulta, $param); 
            
            }
        
    }

?>