<?php

    require_once 'LibreriaPDO.php';
    require_once 'models/tatuador.php';

    class Daotatuador extends DB {
        
            public $tatuadores=array();  
            
            public function Listar()
            {
                
                $this->tatuadores=array();  
                
                $consulta="select * from tatuadores";
                
                $param=array(); 
                
                $this->ConsultaDatos($consulta, $param);
                
                foreach ($this->filas as  $fila )
                {
                    $tatuador= new tatuador();   
                    
                    $tatuador->__SET("id",$fila['id']);       
                    $tatuador->__SET("nombre",$fila['nombre']);
                    $tatuador->__SET("apellido",$fila['apellido']);
                    $tatuador->__SET("descripcion",$fila['descripcion']);
                    $tatuador->__SET("estilo",$fila['estilo']);
                    $tatuador->__SET("id_usuario",$fila['id_usuario']);
                    $tatuador->__SET("imagen",$fila['imagen']);
                
                    $this->tatuadores[]=$tatuador;     
                    
                }
                
                
            }

            public function idConIdUsuario($id_usuario){

                $consulta="select id from tatuadores where id_usuario=$id_usuario";
                
                $param=array(); 

                $this->ConsultaDatos($consulta, $param);

                return $this->filas[0]["id"];

            }

            public function CogerIdUsuario($id){

                $consulta="select id_usuario from tatuadores where id=$id";
                
                $param=array(); 

                $this->ConsultaDatos($consulta, $param);

                return $this->filas[0]["id_usuario"];

            }

            public function RecogerEmail($id){

                $consulta="select email from usuarios where id=$id";
                
                $param=array(); 
                
                $this->ConsultaDatos($consulta, $param);

                return $this->filas[0]["email"];

            }

            public function RecogerRol($id){

                $consulta="select rol from usuarios where id=$id";
                
                $param=array(); 
                
                $this->ConsultaDatos($consulta, $param);

                return $this->filas[0]["rol"];

            }


            public function ConseguirEstilos(){

                $consulta="select estilo from tatuadores";
                
                $param=array(); 
                
                $this->ConsultaDatos($consulta, $param);

                return $this->filas[0]["estilo"];
            }
            
            
            public function Insertar($tatuador)   
            {
                $consulta="insert into tatuadores values (NULL,:nombre,:apellido,:estilo,:descripcion,:id_usuario,:imagen)";
                
                $param=array(
                    ":nombre"=>$tatuador->__get("nombre"),
                    ":apellido"=>$tatuador->__get("apellido"),
                    ":estilo"=>$tatuador->__get("estilo"),
                    ":descripcion"=>$tatuador->__get("descripcion"),
                    ":id_usuario"=>$tatuador->__get("id_usuario"),
                    ":imagen"=>$tatuador->__get("imagen")
                );
                
                $this->ConsultaDatos($consulta, $param);
            
            }
        
            
            public function Borrar($id)  
            {
                $consulta="delete from tatuadores where id=:id";
                
                $param=array(":id"=>$id);
                
                $this->ConsultaSimple($consulta, $param); 
                
                
            }
            
            public function Actualizar($tatuador) 
            {
                $consulta="update tatuadores set :nombre,:apellido,:estilo,:descripcion,:id_usuario,:imagen  where id=:id ";
                
                $param=array(
                    ":id"=>$tatuador->__get("id"),
                    ":nombre"=>$tatuador->__get("nombre"),
                    ":apellido"=>$tatuador->__get("apellido"),
                    ":estilo"=>$tatuador->__get("estilo"),
                    ":descripcion"=>$tatuador->__get("descripcion"),
                    ":id_usuario"=>$tatuador->__get("id_usuario"),
                    ":imagen"=>$tatuador->__get("imagen")
                );
                
                $this->ConsultaDatos($consulta, $param);
            
            }
        
    }

?>