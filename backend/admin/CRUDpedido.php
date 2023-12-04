<?php 
 
require_once 'Daotatuador.php';  
require_once 'Daopedido.php';  

$base="estudiotat";
 
$dao = new Daopedido($base);

$daoT = new Daotatuador($base); 


if (isset($_POST["Insertar"]) )
{

  $pedido = new pedido();

  $pedido->__SET("id", $_POST['id']);
  $pedido->__SET("id_tatuador", $id_tatuador);
  $pedido->__SET("detalle",  $_POST['detalle']);
  $pedido->__SET("fecha", $_POST['fecha']);
  $pedido->__SET("estado", $_POST['estado']);

  $id_pedido = $dao->Insertar($pedido);

}


if (isset($_POST["Borrar"])  && isset($_POST["selec"]))  
{
    
    $selec=$_POST["selec"]; 
  
    foreach ($selec as $clave=>$valor  )  
    { 
        $dao->Borrar($clave);
        
    }
    
}
    
if (isset($_POST["Actualizar"])  && isset($_POST["selec"]) )   
{


    $selec=$_POST["selec"];  

    $estado=$_POST["estado"]; 
    
    foreach ($selec as $clave=>$valor  ) 
    {
        
        $pedido= new pedido();
        
        $pedido->__set("Id", $clave);
        $pedido->__set("estado", $estado[$clave ]);
        
               
        $dao->Actualizar($pedido);  
        
    }
    
   
}


?>
