<?php


class DB {
    
    
    //Definimos una propiedad para el objeto conexi�n
    
    private $con;  //Objeto conexion PDO
    
    
    //Definimos como privadas las principales variables de conexion
    
    private $host="localhost";
    private $user="root";
    private $clave="";
    
    //Definimos la propidad de la base de datos a conectar
    
    protected  $base;
    
    //Definimos como publica la propidad de resultado
    
    public $filas;  // Array de filas con el resultado de la consulta de datos
    
    
    public function __construct($base)
    {
        $this->base=$base;  //Inicializamos en el constructor la base de datos a la que nos vamos a conectar
    }
    
    
    private function Conectar()   //Metodo de conexion a BBDD
    {
       try {
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->base",$this->user,$this->clave); 
            $this->con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);     // Establecemos parametro b�sicos de configuaracion
            $this->con->exec("set names utf8mb4");
            
           
       } catch (PDOException $e) {
                 echo "Error al conectar".$e->getMessage() ;
       } 
       
        
    }
    
    public function ConsultaSimple($consulta,$param)   //Metodo para ejecutar una consulta simple
    {
         $this->Conectar();  //Nos conectamos con la BBDD
        
         $sta=$this->con->prepare($consulta);   //Creamos un objeto Statement para esa consulta
         
         if (!$sta->execute($param))      //Si al ejecutar la consulta hay error
         {
             echo "Error al ejecutar la consulta";
         }
                 
         $this->Cerrar();  //Nos cerramos la conexion
    }
    
    public function ConsultaDatos($consulta,$param)   //Metodo para ejecutar una consulta que retorna datos
    {
    
        $this->Conectar();  //Nos conectamos con la BBDD
     
        $this->filas=array();  //Hay que vaciar el array de las filas de consultas anteriores 
        
        $sta=$this->con->prepare($consulta);   //Creamos un objeto Statement para esa consulta
        
        if (!$sta->execute($param))      //Si al ejecutar la consulta hay error
        {
            echo "Error al ejecutar la consulta de datos";
        }
        else  //Se ha creado correctamente el objeto Statement 
        {
            $this->filas=$sta->fetchAll(PDO::FETCH_ASSOC);   //Sacamos todos los datos devueltos por la consulta
        }
             
        $this->Cerrar();  //Nos cerramos la conexion
    }
    
    
    private  function Cerrar()     //Metodo de cierre de conexion
    {
        $this->con=NULL;
    }
    
}

?>