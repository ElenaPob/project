<?php 
 
    require_once 'Daogaleria.php';  
    require_once 'Daogaleria.php';  

    $base="estudiotat";
    
    $dao = new Daogaleria($base);

    $daoT = new Daotatuador($base); 


    if (isset($_POST["Insertar"]) )
    {

    $galeria = new galeria();


    $galeria->__SET("id_tatuador", $id_tatuador);

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
    
    $galeria->__SET("imagen",$NombreImagen );
    
    $dao->Insertar($galeria);
    
    
        
    }


    if (isset($_POST["Borrar"])  && isset($_POST["selec"]) )  
    {
        
        $selec=$_POST["selec"]; 

        foreach ($selec as $clave=>$valor  )  
        { 
            $dao->Borrar($clave);
            
        }
        
    }
        

?>
