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
                $consulta="insert into pedido values (NULL,:detalle,:fecha,:id_tatuador,:estado)";
                
                $param=array(
                    ":detalle"=>$pedido->__get("detalle"),
                    ":fecha"=>$pedido->__get("fecha"),
                    ":id_tatuador"=>$pedido->__get("id_tatuador"),
                    ":estado"=>$pedido->__get("estado")
                );
                //print_r($param);
                
                $this->ConsultaDatos($consulta, $param); 
            
            }
        
            
            public function Borrar($id) 
            {
                $consulta="DELETE FROM pedido WHERE id=:id";
                
                $param=array(":id"=>$id);
                
                $this->ConsultaSimple($consulta, $param); 
                
                
            }
            
            public function Actualizar($pedido)  
            {
                $consulta = "UPDATE pedido SET estado=:estado WHERE id=:id";
                
                $param = array(
                    ":id" => $pedido->__GET("id"),
                    ":estado" => $pedido->__GET("estado")
                );
                
                $this->ConsultaDatos($consulta, $param); 
            }

            public function pedidoEnCurso(){

                $this->pedidos=array();   
                
                $consulta="SELECT * from pedido where estado=0";
                
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

            public function pedidoFinalizado(){

                $this->pedidos=array();   
                
                $consulta="SELECT * from pedido where estado=1";
                
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
        
    }

?>