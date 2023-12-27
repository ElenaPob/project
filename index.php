<?php
session_start();
//require_once "backend/login.php";

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rosa Ink Studio</title>
    <link rel="icon" href="assets/icon/rosa.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/new.css"/>
  </head>
    
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="#"><img src="assets/icon/rosa50.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a  class="home nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a  class="tatuadores nav-link" href="pages/tatuadores/tatuadores.php">Tatuadores</a>
          </li>
          <li class="nav-item">
            <a  class="galeria nav-link" href="pages/tatuadores/galeriaTatuador.php">Galeria</a>
          </li>
          <li class="nav-item">
            <a class="contacto nav-link" href="pages/contacto/contacto.php">Contacto</a>
          </li>
          
          <?php
          
          if (isset($_SESSION["rol"])){

            // Verifica si el usuario está autenticado y tiene el rol de administrador
            if ($_SESSION["rol"] == "admin") {
              echo '<li class="nav-item">
                        <a class="nav-link" href="pages/admin/gestion.php">Gestionar Tatuadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/admin/gestionarPedidos.php">Gestionar Pedidos</a>
                    </li>
                    ';
            }

            // Verifica si el usuario está autenticado y tiene el rol de tatuador
            if ($_SESSION["rol"] == "tatuador") {
                echo '<li class="nav-item">
                          <a class="nav-link" href="pages/tatuador/galeria.php">Gestionar Galería</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="pages/tatuador/pedido.php">Hacer Pedido</a>
                      </li>
                      ';
            }


          }
          
          ?>
        </ul>
        <?php
          if (isset($_SESSION["rol"])) {
            echo '<a class="ml-auto" href="backend/cerrar_sesion.php">
            <button class="btn btn-outline-danger"> Cerrar Sesion</button>
            </a>';
          }else{
            echo '<button class="btn btn-outline-light btn-rounded ml-auto" data-mdb-ripple-init data-mdb-ripple-color="dark"
            onclick="openForm()">Iniciar Sesión</button>';
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
    <div class="text-center contenedorDelLogoDelEstudio">
      <img class="imagenDelEstudio" src="assets/icon/rosaInk.jpeg" alt="Logo del estudio de tatuajes">
    </div>
    <hr class="divider">

    <div class="container">
    <div class="row justify-content-center align-items-center">

      <div class="col-md-6">
        <h4 class="ml-4">¿QUÉ OFRECEMOS?</h4>
        <ul class="list-unstyled ml-4">
          <li class="d-flex align-items-center mb-3">
            <i class="fa-solid fa-briefcase fa-2x mr-3"></i> 
            <div>
              <p class="mb-0">Profesionalidad</p>
              <small class="text-body-secondary">Tomar la decisión de qué tatuarse puede ser desafiante, pero con nuestra experiencia, te asistiremos en la elección del diseño, la ubicación, el color o el sombreado que mejor se adapten a tus preferencias.</small>
            </div>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="fa-solid fa-street-view fa-2x mr-3"></i>
            <div>
              <p class="mb-0">Atención personalizada</p>
              <small class="text-body-secondary">Convertimos tu idea en una realidad. Solicita una visita previa para que podamos conocerte, comprender tus gustos y reflejar tu esencia en tu nuevo tatuaje.</small>
            </div>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="fa-regular fa-comments fa-2x mr-3"></i> 
            <div>
              <p class="mb-0">Seguimiento</p>
              <small class="text-body-secondary">Te guiaremos a través del proceso de curación, y estaremos a tu disposición para responder cualquier pregunta que puedas tener.</small>
            </div>
          </li>
          <li class="d-flex align-items-center">
            <i class="fa-solid fa-hand-sparkles fa-2x mr-3"></i> 
            <div>
              <p class="mb-0">Máxima higiene</p>
              <small class="text-body-secondary"> Contamos con la certificación en higiene sanitaria. Utilizamos exclusivamente material desechable y de un solo uso en todas nuestras prácticas.</small>
            </div>
          </li>
        </ul>
      </div>

      <div class="col-md-6 mt-3">
        <div class="bg-image">
          <img src="assets/img/studio/estudio2.jpg" class="w-100 imagenPregunta" alt="Estudio de tatuaje" />
          <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.6)">
            <div class="d-flex flex-column justify-content-center align-items-center h-100">
              <h5 class="text-white mb-3">¿Tienes dudas?</h5>
              <a href="pages/contacto/contacto.php">
                <button type="button" class="btn btn-info" data-mdb-ripple-init>Pregunta</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br>

  <hr class="indice-divider">

  <div class="margenesizquierda">
    <div class="row justify-content-center align-items-center md-2 primera">

      <div class="col-md-5">
        <h2 class="indice-heading">Sobre Nosotros</h2>
        <p class="lead">Explora nuestras experiencias y descubre lo que podemos ofrecerte. Más detalles al pulsar el botón.</p>
        <a href="pages/tatuadores/tatuadores.php">
          <button type="button" class="btn btn-info" data-mdb-ripple-init>Conocer</button>
        </a>
      </div>

      <div class="col-md-7">
        <img class="indice-image img-fluid " src="assets/img/studio/estudio4.jpg" alt="Calle del estudio">
      </div>
    </div>

    <hr class="indice-divider">

    
  </div>

  <div class="margenesizquierda">
    <div class="row justify-content-center align-items-center md-2 primera">
        <div class="col-md-5">
          <h2 class="indice-heading">Pide presupuesto <br> <span class="text-muted">sin compromiso</span></h2>
          <p class="lead"> Rellena nuestro formulario con la idea que tengas y te daremos un presupuesto aproximado.</p>
          <a href="pages/contacto/contacto.php">
            <button type="button" class="btn btn-info" data-mdb-ripple-init>Rellenar</button>
          </a>
        </div>

        <div class="col-md-7">
          <img class="indice-image img-fluid " src="assets/img/studio/estudio5.jpg" alt="Calle del estudio2">
        </div>
      </div>
  </div>

    
    
    <!--FOOTER-->
    <br>
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

    <script src="js/popup.js" ></script>
    <script src="js/js.js"></script>

   
    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap y jQuery -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6f1c8192e7.js" crossorigin="anonymous"></script>

  </body>

</html>
