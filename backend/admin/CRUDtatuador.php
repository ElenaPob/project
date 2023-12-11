<?php 
 
require_once 'Daotatuador.php';  
require_once 'Daousuario.php'; 
require_once 'Daogaleria.php';   

$base="estudiotat";
 
$dao = new Daotatuador($base);

$daoU = new Daousuario($base); 

$daoG = new Daogaleria($base); 


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
      
      
    copy($RutaTemp,"../../assets/img/perfil/$NombreImagen");
      
  }
  else 
  {
    $NombreImagen="noimagen";
  }
  
  $tatuador->__SET("imagen",$NombreImagen );
  
  $dao->Insertar($tatuador);
  
  
    
}


if (isset($_POST["Borrar"])  && isset($_POST["selec"]))  
{
    
    $selec=$_POST["selec"]; 

      
    foreach ($selec as $clave=>$valor  )  
    { 
        $id_usuario=$dao->CogerIdUsuario($clave);

        $dao->Borrar($clave);

        $daoU->Borrar($id_usuario);

        $daoG->BorrarGaleriaEntera($clave);

    }

}


    
if (isset($_POST["Actualizar"])  && isset($_POST["selec"]) )   
{
    $selec=$_POST["selec"];  
    
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $estilo=$_POST["estilo"];
    $descripcion=$_POST["descripcion"];

    $email=$_POST["email"];
    $rol=$_POST["rol"];
    
    $NomFot=$_POST["NomFot"];  
    
    foreach ($selec as $clave=>$valor  ) 
    {
        
        $tatuador= new tatuador();
        
        $tatuador->__SET("id", $clave);
        $tatuador->__SET("nombre", $nombre);
        $tatuador->__SET("apellido", $apellido);
        $tatuador->__SET("estilo", $estilo);
        $tatuador->__SET("descripcion", $descripcion);
        
        
        if (!empty($_FILES['imagenNueva']['name'])    )  
        {
            $NombreImagen = $_FILES['LogoN']['name'];  
            
            $RutaTemp = $_FILES['LogoN']['tmp_name'];  
            
            copy($RutaTemp,"../../assets/img/perfil/$NombreImagen");
            
            $tatuador->__SET("imagen", $NombreImagen );  
        }
        else 
        {

            $tatuador->__SET("imagen", $NomFot); 
        }
        
               
        $dao->Actualizar($tatuador);  
        
    }


    
   
}


?>
