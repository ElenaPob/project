<?php 
 
    require_once 'DAOtatuador.php';  
    require_once 'DAOpedido.php';  

    $base="estudiotat";
    
    $dao = new Daopedido($base);

    $daoT = new Daotatuador($base); 


    if (isset($_POST["Pedir"]) )
    {
        $pedido = new pedido();

        $id_usuario = $_SESSION["idUsuario"];
        $id_tatuador = $daoT->idConIdUsuario($id_usuario);

        $fecha = date("d-m-Y");
        $estado = 0;
        $colorSelec = $_POST['selec'];
        $colorSeleccionado = "";

        $colorSeleccionado = implode(',', array_keys($colorSelec));

        $pedido->__SET("detalle",  $colorSeleccionado);
        $pedido->__SET("fecha", $fecha);
        $pedido->__SET("id_tatuador", $id_tatuador);
        $pedido->__SET("estado", $estado);

        $dao->Insertar($pedido);

    }

        
    if (isset($_POST["Actualizar"])  && isset($_POST["selectPedido"]) )   
    {


        $selec=$_POST["selectPedido"];  

        $estado=1; 
        
        foreach ($selec as $clave=>$valor) 
        {
            
            $pedido= new pedido();
            
            $pedido->__set("id", $clave);
            $pedido->__set("estado", $estado);
            
                
            $dao->Actualizar($pedido);  
        }
        
    }

    $filtro = "";
    if (isset($_POST['estado'])){

        $filtro = $_POST['estado'];

    }


?>
