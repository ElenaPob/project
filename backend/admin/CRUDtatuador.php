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

  $passwordHash = password_hash($_POST['passwordNueva'], PASSWORD_DEFAULT) ;
  $usuario->__SET("password", $passwordHash);
  $usuario->__SET("email", $_POST['emailNuevo']);

  $id_usuario = $daoU->Insertar($usuario);


  $tatuador->__SET("nombre", $_POST['nombreNuevo']);
  $tatuador->__SET("apellido", $_POST['apellidoNuevo']);
  $tatuador->__SET("estilo", $_POST['estiloNuevo']);
  $tatuador->__SET("descripcion", $_POST['descNuevo']);
  $tatuador->__SET("id_usuario", $id_usuario);

  if (!empty($_FILES['imagenNueva']['name']) )          //Si hemos seleccionado alguna foto
  {

    $NombreImagen = $_FILES['imagenNueva']['name'];  //Nombre original
      
      $RutaTemp = $_FILES['imagenNueva']['tmp_name'];  //Nombre original
      
      //$Tam = $_FILES['Foto']['size'];  //Nombre original
      
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
    
}
    
if (isset($_POST["Actualizar"])  && isset($_POST["selec"]) )     //Si hemos pulsado actualizar y hemos tatuadordo algun check
{
    $selec=$_POST["selec"];  //Recogemos el array de tatuadors seleccionadas
    
    $nombre=$_POST["Nombre"];  //Recogemos el array con los nombres
    
    $NomFot=$_POST["NomFot"];   //Recogemos el array con los nombres actuales de las fotos
    
    foreach ($selec as $clave=>$valor  )   //Borramos las tatuadors cuyo Id hemos seleccionado
    {
        
        $tatuador= new tatuador();
        
        $tatuador->__set("Id", $clave);
        $tatuador->__set("Nombre", $nombre[$clave ]);
        
        
        if (isset($_FILES["LogoN"]["name"][$clave ]   )   )      //Si en el campos file asociado hemos seleccionado una foto
        {
            $NombreImagen = $_FILES['LogoN']['name'][$clave];  //Nombre original
            
            $RutaTemp = $_FILES['LogoN']['tmp_name'][$clave];  //Nombre original
            
            //$Tam = $_FILES['Foto']['size'];  //Nombre original
            
            copy($RutaTemp,"Logos/$NombreImagen");
            
            $tatuador->__set("Logo", $NombreImagen );    //El nombre del logo ser� el seleccionado
        }
        else  //No hemos seleccinado ninguna foto para actualizar 
        {
            
            echo "No coge la foto nueva";
            
            $tatuador->__set("Logo", $NomFot[$clave ] ); 
            
        }
        
               
        $dao->Actualizar($tatuador);    //Actualizamos la tatuador con los datos del fprmulario  
        
    }
    
   
}


?>
