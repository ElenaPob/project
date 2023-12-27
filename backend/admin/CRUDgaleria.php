<?php 
 
    require_once 'DAOgaleria.php';  
    require_once 'DAOtatuador.php';  

    $base="estudiotat";
    
    $daoG = new Daogaleria($base);

    $daoT = new Daotatuador($base); 


    if (isset($_POST["Insertar"]) )
    {

        $galeria = new galeria();

        $id_usuario = $_SESSION["idUsuario"];
        $id_tatuador = $daoT->idConIdUsuario($id_usuario);

        $galeria->__SET("id_tatuador", $id_tatuador);

        if (!empty($_FILES['imagenNueva']['name']) ) 
        {

            $NombreImagen = $_FILES['imagenNueva']['name'];  

            $RutaTemp = $_FILES['imagenNueva']['tmp_name'];  
            
            
            copy($RutaTemp,"../../assets/img/tatuajes/".$NombreImagen);
            
        }
        else 
        {
            $NombreImagen="noimagen";
        }
        
        $galeria->__SET("imagen",$NombreImagen );
        
        $daoG->Insertar($galeria);
        
    }


    if (isset($_POST["Eliminar"])  && isset($_POST["selec"]) )  
    {
        
        $selec=$_POST["selec"]; 

        foreach ($selec as $clave=>$valor  )  
        { 
            $daoG->Borrar($clave);
            
        }
        
    }

    $idTatuador = "";
    if (isset($_POST['selecGaleria'])){
        $idTatuador = $_POST['selecGaleria'];
    }
        

?>
