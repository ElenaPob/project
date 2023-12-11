<?php 
session_start();
require_once("../../backend/login.php");
require_once "../../backend/admin/CRUDtatuador.php";
require_once "../../backend/admin/DAOusuario.php";


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rosa Ink Studio</title>
    <link rel="icon" href="../../assets/icon/rosa.png" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <script src="https://kit.fontawesome.com/6f1c8192e7.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/new.css">
    <!--Para el email-->
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>

    <!--Para el map-->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>


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
          <li class="nav-item">
            <a class="tatuadores nav-link" href="../tatuadores/tatuadores.php">Tatuadores</a>
          </li>
          <li class="nav-item">
            <a class="contacto nav-link" href="contacto.php">Contacto <span class="sr-only">(current)</span></a>
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
    <div class="modal rounded-5" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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


    <!--FORMULARIO-->
    

    <div class="container mt-5">
        <div class="row">

            <div class="col-md-6">
                <form class="formularioContacto mt-4" style="width: 26rem;">
                <h2>Contáctanos</h2>
                <p>Cualquier duda que tengas: precios, horarios, disponibilidad... Respondemos rápido.</p>

                  <div data-mdb-input-init class="form-outline mb-4">
                  <i class="fas fa-user"></i>
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fa-solid fa-envelope"></i>
                    <label class="form-label" for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fa-solid fa-lightbulb"></i>
                    <label class="form-label" for="asunto">Asunto</label>
                    <input type="text" id="asunto" name="asunto" class="form-control" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fas fa-pencil"></i>
                    <label class="form-label" for="mensaje">Mensaje</label>
                    <textarea class="form-control" name="mensaje" id="mensaje" rows="4"></textarea>
                  </div>
                  <input type="hidden" id="to" value="<?php echo $dao->RecogerEmail(1); ?>"> <br>

                  <button type="button" class="btn btn-info btn-block mb-4" data-mdb-ripple-init onclick="sendEmail();">
                  <i class="fa-regular fa-paper-plane"></i>
                  Enviar
                  </button>
                </form>
            </div>

            <div class="col-md-6 mt-5">
                <h3>También atendemos dudas presencialmente:</h3>
                <div id="mapaConJs"></div>
            </div>
        </div>
    </div>


    
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

    
    <script src="../../js/map.js"></script>
    <script src="../../js/email.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>
