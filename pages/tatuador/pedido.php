<?php 
session_start();
require_once "../../backend/admin/CRUDpedido.php";
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
      <a class="navbar-brand" href="#"><img src="../../assets/icon/rosa50.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="nav-link" href="../../index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tatuadores/tatuadores.php">Tatuadores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tatuadores/galeriaTatuador.php">Galeria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contacto/contacto.php">Contacto</a>
          </li>
          
          <?php

          // Verifica si el usuario está autenticado y tiene el rol de tatuador
          if ($_SESSION["rol"] == "tatuador") {
              echo '<li class="nav-item">
                        <a class="nav-link" href="galeria.php">Gestionar Galería</a>
                    </li>
                    <li class="nav-item active">
                          <a class="nav-link " href="pedido.php">Hacer Pedido</a>
                    </li>
                    ';
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



    <!--INTERIOR-->
    
    <div class="container mt-5">
    <form name="f1" method="post" action="" enctype="multipart/form-data">
        <h2>Selecciona los colores que quieras pedir</h2>
        <hr class="divider">

        <div class="d-inline-block">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>Color</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $colores = array('#ff00ff', '#0000ff', '#00ff00', '#ffff00', '#ff0000');
                        foreach ($colores as $color) {
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="selec[' . $color . ']"></td>';
                            echo '<td style="background-color:' . $color . '; width:30px; height:30px;"></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="d-inline-block ml-4">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>Color</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $colorines = array('#7D3C98', '#9A7D0A', '#808B96', '#17202A', '#922B21');
                        foreach ($colorines as $color) {
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="selec[' . $color . ']"></td>';
                            echo '<td style="background-color:' . $color . '; width:30px; height:30px;"></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="d-inline-block ml-4">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>Color</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $colors = array('#D2B4DE', '#A9CCE3', '#D0ECE7', '#FCF3CF', '#F6DDCC');
                        foreach ($colors as $color) {
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="selec[' . $color . ']"></td>';
                            echo '<td style="background-color:' . $color . '; width:30px; height:30px;"></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="row mt-3">
            <div class="col">
                <input type="submit" name="Pedir" class="btn btn-info" value="Hacer Pedido">
            </div>
        </div>
    </form>
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

    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>
