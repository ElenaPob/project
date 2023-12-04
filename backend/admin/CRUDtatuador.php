<?php 
 
require_once 'Daotatuador.php';  
require_once 'Daousuario.php';  

$base="estudiotat";
 
$dao = new Daotatuador($base);

$daoU = new Daousuario($base); 


if (isset($_POST["Insertar"]) )
{

  $tatuador= new tatuador(); 
  $usuario = new usuario();

  $usuario->__SET("usuario", $_POST['nombreNuevo']);
  $usuario->__SET("rol", $_POST['rolNuevo']);

  $passwordHash = password_hash($_POST['passwordNueva'], PASSWORD_DEFAULT);
  $usuario->__SET("password", $passwordHash);
  $usuario->__SET("email", $_POST['emailNuevo']);

  $id_usuario = $daoU->Insertar($usuario);


  $tatuador->__SET("nombre", $_POST['nombreNuevo']);
  $tatuador->__SET("apellido", $_POST['apellidoNuevo']);
  $tatuador->__SET("estilo", $_POST['estiloNuevo']);
  $tatuador->__SET("descripcion", $_POST['descNuevo']);
  $tatuador->__SET("id_usuario", $id_usuario);

  if (!empty($_FILES['imagenNueva']['name']) ) 
  {

    $NombreImagen = $_FILES['imagenNueva']['name'];  

    $RutaTemp = $_FILES['imagenNueva']['tmp_name'];  
      
      
    copy($RutaTemp,"../../assets/img/perfil/".$NombreImagen);
      
  }
  else 
  {
    $NombreImagen="noimagen";
  }
  
  $tatuador->__SET("imagen",$NombreImagen );
  
  $dao->Insertar($tatuador);
  
  
    
}


if (isset($_POST["Borrar"])  && isset($_POST["selec"]) && isset($_POST["selecU"]) )  
{
    
    $selec=$_POST["selec"]; 
    $select=$_POST["selecU"];

      
    foreach ($selec as $clave=>$valor  )  
    { 
        $dao->Borrar($clave);
        
        
    }
    foreach ($select as $clave=>$valor  )  
    { 
        $daoU->Borrar($clave); 
    }
    //SI BORRA UN TATUADOR TAMBIÉN BORRA SU GALERIA

}
    
if (isset($_POST["Actualizar"])  && isset($_POST["selec"]) )   
{
    $selec=$_POST["selec"];  
    
    $nombre=$_POST["Nombre"];
    
    $NomFot=$_POST["NomFot"];  
    
    foreach ($selec as $clave=>$valor  ) 
    {
        
        $tatuador= new tatuador();
        
        $tatuador->__set("Id", $clave);
        $tatuador->__set("Nombre", $nombre[$clave ]);
        
        
        if (isset($_FILES["LogoN"]["name"][$clave ]   )   )  
        {
            $NombreImagen = $_FILES['LogoN']['name'][$clave];  
            
            $RutaTemp = $_FILES['LogoN']['tmp_name'][$clave];  
            
            copy($RutaTemp,"Logos/$NombreImagen");
            
            $tatuador->__set("Logo", $NombreImagen );  
        }
        else 
        {
            
            echo "No coge la foto nueva";
            $tatuador->__set("Logo", $NomFot[$clave ] ); 
            
        }
        
               
        $dao->Actualizar($tatuador);  
        
    }
    
   
}


?>
