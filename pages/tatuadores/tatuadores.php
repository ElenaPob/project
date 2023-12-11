<?php session_start();
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
          <li class="nav-item active">
            <a class="home nav-link" href="../../index.php">Home</a>
          </li>
          <li class="tatuadores nav-item">
            <a class="contacto nav-link" href="pages/tatuadores/tatuadores.php">Tatuadores <span class="sr-only">(current)</span></a>
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
            data-toggle="modal" data-target="#loginModal">Iniciar Sesión</button>';
          }


        ?>
        
      </div>
    </nav>

    <!--FORMULARIO LOGIN-->
    <div class="modal fade" id="loginModal" tabindex="-1"  aria-labelledby="loginModalLabel" aria-hidden="true">
        <div >
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5  class="modal-title text-white" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input name="usuario" type="text" class="form-control" id="usuario" placeholder="Introduce tu usuario">
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña:</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Introduce tu contraseña">
                        </div>
                        <button name="login" type="submit" class="btn btn-outline-info btn-rounded" data-mdb-ripple-init data-mdb-ripple-color="dark">Iniciar Sesión</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--INTERIOR-->

    <?php
      $dao->Listar();

      echo '<div class="d-flex flex-wrap justify-content-center">';

      foreach ($dao->tatuadores as $tatuador) {
          echo '<div class="card ml-3 mt-4 cardTatuador" >';
          echo '<img src="../../assets/img/perfil/' . $tatuador->__GET("imagen") . '" class="card-img-top imagenPequeTatuador" alt="Imagen del tatuador más pequeña">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $tatuador->__GET("nombre") . ' ' . $tatuador->__GET("apellido") . '</h5>';
          echo '<p class="card-text">' . $tatuador->__GET("estilo") . '</p>';
          echo '</div>';
          echo '<div class="card-footer">';
          echo '<button type="button" class="btn btn-info" data-mdb-ripple-init data-toggle="modal" data-target="#miModal' . $tatuador->__GET("id") . '">Más información</button>';
          echo '</div>';
          echo '</div>';

          echo '<div class="modal" id="miModal' . $tatuador->__GET("id") . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">';
          echo '<div class="modal-dialog" role="document">';
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
          echo '<li><strong>Email: </strong>' . $dao->RecogerEmail($tatuador->__GET("id_usuario")) . '</li>';
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

                      <a class="btn btn-outline-light btn-floating m-1 btn-sm" role="button">
                          <i class="fab fa-google"></i>
                      </a>

                      <a class="btn btn-outline-light btn-floating m-1 btn-sm" role="button">
                          <i class="fab fa-instagram"></i>
                      </a>
                  </div>
              </div>
          </section>
      </div>
    </footer>



    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>
