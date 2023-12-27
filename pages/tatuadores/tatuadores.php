<?php
  session_start();
  //require_once "../../backend/login.php";

  require_once "../../backend/admin/CRUDtatuador.php";
  require_once "../../backend/admin/DAOtatuador.php";
  require_once "../../backend/admin/DAOusuario.php"; 
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rosa Ink Studio</title>
    <link rel="icon" href="../../assets/icon/rosa.png" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <script src="https://kit.fontawesome.com/6f1c8192e7.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="../../assets/css/new.css">


  </head>
    
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="../../index.php"><img src="../../assets/icon/rosa50.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="home nav-link" href="../../index.php">Inicio</a>
          </li>
          <li class="tatuadores nav-item active">
            <a class="contacto nav-link" href="tatuadores.php">Tatuadores <span class="sr-only">(current)</span></a>
          </li>
          <li class="tatuadores nav-item">
            <a class="contacto nav-link" href="galeriaTatuador.php">Galeria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contacto/contacto.php">Contacto</a>
          </li>
          
          <?php
          if (isset($_SESSION["rol"])){

            // Verifica si el usuario está autenticado y tiene el rol de administrador
            if ($_SESSION["rol"] == "admin") {
              echo '<li class="nav-item">
                        <a class="nav-link" href="../admin/gestion.php">Gestionar Tatuadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/gestionarPedidos.php">Gestionar Pedidos</a>
                    </li>
                    ';
            }

            // Verifica si el usuario está autenticado y tiene el rol de tatuador
            if ($_SESSION["rol"] == "tatuador") {
                echo '<li class="nav-item">
                          <a class="nav-link" href="../tatuador/galeria.php">Gestionar Galería</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="../tatuador/pedido.php">Hacer Pedido</a>
                      </li>
                      ';
            }


          }
          ?>
        </ul>
        <?php
          if (isset($_SESSION["rol"])) {
            echo '<a class="ml-auto" href="../../backend/cerrar_sesion.php">
            <button class="btn btn-outline-danger"> Cerrar Sesion</button>
            </a>';
          }else{
            echo '<button class="btn btn-outline-light btn-rounded ml-auto" data-mdb-ripple-init data-mdb-ripple-color="dark"
            data-toggle="modal" data-target="#loginModal" onclick="openForm()">Iniciar Sesión</button>';
          }


        ?>
        
      </div>
    </nav>

    <!--FORMULARIO LOGIN-->

    <div id="formularioDeLogin" class="form-popup">
        <form name=f1 id="loginForm"  class="form-container" method="POST">
        <h3>Iniciar Sesión</h3>
        <hr class="divider">
            <i class="fas fa-user"></i>
            <label>Usuario:</label>
            <input class="form-control validate" type="text" id="usuario" name="usuario" required>
            <br>
            <i class="fas fa-lock"></i>
            <label>Contraseña:</label>
            <input class="form-control validate" type="password" id="password" name="password" required>
            <br>
            <div id="error-message" class="alert" role="alert">
            <div id="result"></div>
            </div>
            <button id="login" name="login" type="submit" class="btn btn-outline-info btn-rounded" >Iniciar Sesión</button>
            <button class="btn btn-outline-danger btn-rounded" onclick="closeForm()">Cerrar</button>
        </form>
        
    </div>

    <!--INTERIOR-->

    <?php
$dao->Listar();

echo '<div class="container">'; // Agregado container para envolver el contenido

echo '<div class="row row-cols-1 row-cols-md-3 justify-content-center">';

foreach ($dao->tatuadores as $tatuador) {
    echo '<div class="cardTatuador col mt-4">';
    echo '<div class=" card h-100 text-center ml-5 mt-4">';
    echo '<img src="../../assets/img/perfil/' . $tatuador->__GET("imagen") . '" class="card-img-top imagenPequeTatuador" alt="Imagen del tatuador más pequeña">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $tatuador->__GET("nombre") . ' ' . $tatuador->__GET("apellido") . '</h5>';
    echo '<p class="card-text">' . $tatuador->__GET("estilo") . '</p>';
    echo '</div>';
    echo '<div class="card-footer">';
    echo '<button type="button" class="btn btn-info" data-mdb-ripple-init data-toggle="modal" data-target="#miModalTatu' . $tatuador->__GET("id") . '">Más información</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

echo '</div>';

foreach ($dao->tatuadores as $tatuador) {
    echo '<div class="modal fade" id="miModalTatu' . $tatuador->__GET("id") . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">';
    echo '<div class="modal-dialog modal-dialog-centered" role="document">'; // Agregado modal-dialog-centered y modal-xl
    echo '<div class="modal-content">';
    echo '<div class="modal-header bg-info text-white">';
    echo '<h5 class="modal-title" id="exampleModalLabel">' . $tatuador->__GET("nombre") . ' ' . $tatuador->__GET("apellido") . '</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body">';
    echo '<img src="../../assets/img/perfil/' . $tatuador->__GET("imagen") . '" class="card-img-top imagenGrandeTatuador" alt="Imagen del tatuador más grande">';
    echo '<ul>';
    echo '<li><strong>Nombre: </strong>' . $tatuador->__GET("nombre") . '</li>';
    echo '<li><strong>Apellido: </strong>' . $tatuador->__GET("apellido") . '</li>';
    echo '<li><strong>Email: </strong>' . $daoU->RecogerEmail($tatuador->__GET("id_usuario")) . '</li>';
    echo '<li><strong>Estilo: </strong>' . $tatuador->__GET("estilo") . '</li>';
    echo '<li><strong>Descripcion: </strong>' . $tatuador->__GET("descripcion") . '</li>';
    echo '</ul>';
    echo '</div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

echo '</div>';
?>


    
    <!--FOOTER-->
    <hr class="divider">
    <footer #footer class="text-center text-sm-start text-white">
      <div class="container p-3 pb-0">
          <section>
              <div class="row">
                  <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-2">
                      <h6 class="text-uppercase mb-3 font-weight-bold">Horario</h6>
                      <table class="table text-center text-white">
                          <tbody class="font-weight-normal">
                              <tr>
                                  <td>Lun - Jue:</td>
                                  <td>9:00 - 21:00</td>
                              </tr>
                              <tr>
                                  <td>Vie - Sáb:</td>
                                  <td>9:00 - 14:00</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>

                  <hr class="w-100 clearfix d-md-none" />

                  <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-2">
                      <h6 class="text-uppercase mb-3 font-weight-bold">Contacto</h6>
                      <p><i class="fas fa-home mr-2"></i> Ciudad Real, 13004</p>
                      <p><i class="fas fa-envelope mr-2"></i> animara300@gmail.com</p>
                      <p><i class="fas fa-phone mr-2"></i> +34 636351533</p>
                  </div>

                  <hr class="w-100 clearfix d-md-none" />

                  <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-2">
                      <h6 class="text-uppercase mb-3 font-weight-bold">Síguenos:</h6>

                      <a class="btn btn-outline-light btn-floating m-1 btn-sm" href="https://twitter.com/?lang=es" role="button">
                          <i class="fab fa-twitter"></i>
                      </a>

                      <a class="btn btn-outline-light btn-floating m-1 btn-sm" href="https://www.google.es/" role="button">
                          <i class="fab fa-google"></i>
                      </a>

                      <a class="btn btn-outline-light btn-floating m-1 btn-sm" href="https://www.instagram.com/" role="button">
                          <i class="fab fa-instagram"></i>
                      </a>
                  </div>
                  <hr class="w-100 clearfix d-md-none" />
              </div>
          </section>

      </div>
    </footer>



    <script src="../../js/popup.js" ></script>
    <script>
      $("#loginForm").submit(function (event) {
          event.preventDefault();
          var formData = $(this).serialize();
          $.ajax({
              type: "POST",
              url: "../../backend/login.php",
              data: formData,
              success: function (response) {
                  console.log(response);
                  //Recargar la página para que inicie sesión
                  location.reload();
                  $("#result").html(response);
              }, error: function() {
                  // Lo que quiero que se me muestre cuando no pasa
                  $("#result").text("Contraseña o usuario incorrecto.");
                  $("#result").css("color","red");
              }
          });
      });
    </script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>
