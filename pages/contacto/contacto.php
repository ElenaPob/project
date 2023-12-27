<?php 
session_start();
//require_once "../../backend/login.php";
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
          <li class="nav-item ">
            <a class="home nav-link" href="../../index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="tatuadores nav-link" href="../tatuadores/tatuadores.php">Tatuadores</a>
          </li>
          <li class="nav-item">
            <a class="tatuadores nav-link" href="../tatuadores/galeriaTatuador.php">Galeria</a>
          </li>
          <li class="nav-item active">
            <a class="contacto nav-link" href="contacto.php">Contacto</a>
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
            <button id="login" name="login" type="submit" class="btn btn-outline-info btn-rounded">Iniciar Sesión</button>
            <button class="btn btn-outline-danger btn-rounded" onclick="closeForm()">Cerrar</button>
        </form>
        
    </div>


    <!--FORMULARIO-->
    

    <div class="container mt-5">
        <div class="row">

            <div class="col-md-6">
                <form id="formularioContacto" class="formularioContacto mt-4" style="width: 26rem;">
                <h2>Contáctanos</h2>
                <p>Cualquier duda que tengas: precios, horarios, disponibilidad... Respondemos rápido.</p>

                  <div data-mdb-input-init class="form-outline mb-4">
                  <i class="fas fa-user"></i>
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej: María"/>
                    <span class="errorShow" style="color:red"></span>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fa-solid fa-envelope"></i>
                    <label class="form-label" for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Ej: maría@gmail.com"/>
                    <span class="errorShow" style="color:red"></span>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fa-solid fa-lightbulb"></i>
                    <label class="form-label" for="asunto">Asunto</label>
                    <input type="text" id="asunto" name="asunto" class="form-control" placeholder="Ej: Precio, cita..."/>
                    <span class="errorShow" style="color:red"></span>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fas fa-pencil"></i>
                    <label class="form-label" for="mensaje">Mensaje</label>
                    <textarea class="form-control" name="mensaje" id="mensaje" rows="4" placeholder="Exposición de la idea o pregunta."></textarea>
                    <span class="errorShow" style="color:red"></span>
                  </div>
                  <input type="hidden" id="to" value="<?php echo $daoU->RecogerEmail(1); ?>"> <br>

                  <span class="errorForm text-center" style="color:red"></span>
                  <span class="succesForm text-center" style="color:green"></span>
                  <button type="submit" class="btn btn-info btn-block mb-4">
                  <i class="fa-regular fa-paper-plane"></i>
                  Enviar
                  </button>
                </form>
            </div>

            <div class="col-md-6 mt-5">
                <h3>También atendemos dudas en nuestro estudio:</h3>
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


    <script src="../../js/validateContact.js" ></script>
    <script src="../../js/popup.js" ></script>
    <script src="../../js/map.js"></script>

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
