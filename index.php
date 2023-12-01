<?php require_once("backend/login.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rosa Ink Studio</title>
    <link rel="icon" href="assets/icon/rosa.png" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <script src="https://kit.fontawesome.com/6f1c8192e7.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/new.css">


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
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tatuadores/tatuadores.php">Tatuadores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/contacto/contacto.php">Contacto</a>
          </li>
          
          <?php
          // Verifica si el usuario está autenticado y tiene el rol de administrador
          if ($login && $_SESSION["rol"] == "admin") {
              echo '<li class="nav-item">
                        <a class="nav-link" href="pages/admin/gestion.php">Gestionar Tatuadores</a>
                    </li>
                    ';
          }

          // Verifica si el usuario está autenticado y tiene el rol de tatuador
          if ($login && $_SESSION["rol"] == "tatuador") {
              echo '<li class="nav-item">
                        <a class="nav-link" href="pages/tatuador/galeria/galeria.php">Gestionar Galería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/tatuador/pedido/pedido.php">Gestionar Galería</a>
                    </li>
                    ';
          }
          ?>
        </ul>
        <?php
          if ($login) {
            echo '<a class="ml-auto" href="backend/cerrar_sesion.php">
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

    <!--INTERIOR-->
    <div class="container text-center">
      LOGO+NOMBRE
    </div>
    <hr class="divider">
    <div class="container">
      <h5 class="ml-4">SERVICIOS QUE OFRECEMOS</h5>
      <div class="d-flex">
        <ul class="list-unstyled ml-4">
          <li class="d-flex align-items-center mb-3">
            <i class="fa-solid fa-briefcase fa-2x mr-3"></i> 
            <div>
              <p class="mb-0">Profesionalidad</p>
              <small class="text-body-secondary">Con texto secundario descolorido</small>
            </div>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="fa-solid fa-street-view fa-2x mr-3"></i>
            <div>
              <p class="mb-0">Atención personalizada</p>
              <small class="text-body-secondary">Con texto secundario descolorido</small>
            </div>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="fa-regular fa-comments fa-2x mr-3"></i> 
            <div>
              <p class="mb-0">Seguimiento</p>
              <small class="text-body-secondary">Con texto secundario descolorido</small>
            </div>
          </li>
          <li class="d-flex align-items-center">
            <i class="fa-solid fa-hand-sparkles fa-2x mr-3"></i> 
            <div>
              <p class="mb-0">Máxima higiene</p>
              <small class="text-body-secondary">Con texto secundario descolorido</small>
            </div>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="bg-image">
      <img src="assets/img/studio/estudio2.jpg" class="w-100" alt="Estudio de tatuaje" />
      <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.6)">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
          <h5 class="text-white mb-3">¿Tienes dudas?</h5>
          <a href="pages/contacto/contacto.php">
            <button type="button" class="btn btn-info" data-mdb-ripple-init>Pregunta</button>
          </a>
        </div>
      </div>
    </div>
    <br>

    <hr class="indice-divider">
    <div class="primera row">
      <div class="col-md-3">
        <h2 class="indice-heading">Sobre Nosotros</h2>
        <p class="lead">Explora nuestras experiencias y descubre lo que podemos ofrecerte. Más detalles al pulsar el botón.</p>
        <a href="pages/contacto/contacto.php">
          <button type="button" class="btn btn-info" data-mdb-ripple-init>Conocer</button>
        </a>
      </div>
      <div class="col-md-9">
        <img class="indice-image img-fluid " src="assets/img/studio/estudio4.jpg" alt="Calle del estudio">
      </div>
    </div>

    <hr class="indice-divider">
    <div class="primera row">
      <div class="col-md-3">
        <h2 class="indice-heading">Pide presupuesto
          <br>
          <span class="text-muted">sin compromiso</span>
        </h2>
        <p class="lead"> Rellena nuestro formulario con la idea que tengas y te daremos un presupuesto aproximado.</p>
        <a href="pages/contacto/contacto.php">
          <button type="button" class="btn btn-info" data-mdb-ripple-init>Rellenar</button>
        </a>
      </div>
      <div class="col-md-9">
        <img class="indice-image img-fluid " src="assets/img/studio/estudio5.jpg" alt="Calle del estudio2">
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

                      <a class="btn btn-outline-light btn-floating m-1 btn-sm" role="button">
                          <i class="fab fa-google"></i>
                      </a>

                      <a class="btn btn-outline-light btn-floating m-1 btn-sm" role="button">
                          <i class="fab fa-instagram"></i>
                      </a>
                  </div>
                  <hr class="w-100 clearfix d-md-none" />
              </div>
          </section>
          <!--
          <hr class="my-2" />

          <section class="p-2 pt-0 ">
              <div class="row d-flex align-items-center">
                  <div class="col-md-7 col-lg-8 text-center text-md-start">
                      AÑADIR AQUÍ POLÍTICA DE PRIVACIDAD O LO QUE TENGA QUE AÑADIR. HAY QUE INVESTIGAR
                  </div>
              </div>
          </section>
          -->
      </div>
    </footer>

    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>
