<?php

    require_once 'LibreriaPDO.php';
    require_once 'models/tatuador.php';

    class Daotatuador extends DB {
        
            public $tatuadores=array();    //Array de objetos de la clase tatuador
            
            public function Listar()
            {
                
                $this->tatuadores=array();   //Reseteamos el array de tatuadores
                
                $consulta="select * from tatuadores";
                
                $param=array(); 
                
                $this->ConsultaDatos($consulta, $param);
                
                foreach ($this->filas as  $fila )
                {
                    $tatuador= new tatuador();       //Creamos una instancia de la clase tatuador
                    
                    $tatuador->__SET("id",$fila['id']);           //Pasamos los datos del array fila al objeto tatuador
                    $tatuador->__SET("nombre",$fila['nombre']);
                    $tatuador->__SET("apellido",$fila['apellido']);
                    $tatuador->__SET("descripcion",$fila['descripcion']);
                    $tatuador->__SET("estilo",$fila['estilo']);
                    $tatuador->__SET("id_usuario",$fila['id_usuario']);
                    $tatuador->__SET("imagen",$fila['imagen']);
                
                    $this->tatuadores[]=$tatuador;         //Guardamos esa tatuador en el array de objetos tatuadores
                    
                }
                
                
            }

            public function RecogerEmail($id){

                $consulta="select email from usuarios where id=$id";
                
                $param=array(); 
                
                $this->ConsultaDatos($consulta, $param);

                return $this->filas[0]["email"];

            }
            
            
            public function Insertar($tatuador)     //Inserta una tatuador en la tabla
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
                
                $this->ConsultaDatos($consulta, $param);  //Ejecutmos la consulta de insercci�n
            
            }
        
            
            public function Borrar($id)     //Borra una tatuador a partir de su Id
            {
                $consulta="delete from tatuadores where id=:id";
                
                $param=array(":id"=>$id);
                
                $this->ConsultaSimple($consulta, $param);  //Ejecutmos la consulta de insercci�n
                
                
            }
            
            public function Actualizar($tatuador)     //Actualiza una tatuador de la tabla
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
                
                $this->ConsultaDatos($consulta, $param);  //Ejecutmos la consulta de actualizacion
            
            }
        
    }

?>