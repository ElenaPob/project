<?php 
session_start();
require_once "../../backend/admin/CRUDgaleria.php";
require_once "../../backend/admin/DAOgaleria.php";
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
          <li class="nav-item active">
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
              echo '<li class="nav-item active">
                        <a class="nav-link " href="galeria.php">Gestionar Galería</a>
                    </li>
                    <li class="nav-item">
                          <a class="nav-link" href="pedido.php">Hacer Pedido</a>
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

    <form id="formularioGaleria" name=f2 method="post" action='' enctype="multipart/form-data">
        <div data-mdb-input-init class="form-outline mb-4 mt-5 ml-4">
          <label class="form-label" for="form4Example1">Imagen para añadir:</label>
          <input type="file" name="imagenNueva" class="form-control" required />
        </div>

        <input type="submit" name=Insertar class="btn btn-info mb-5 ml-4"  value="Insertar">
    </form>

    <form  name=f1 method="post" action='' enctype="multipart/form-data">
      <div class="container mt-5">
      
        
        <div class="row">
          <?php
           
            $id_tatuador=$daoT->idConIdUsuario($_SESSION["idUsuario"]);
            $daoG->GestionarGaleria($id_tatuador); 

            foreach ($daoG->galerias as $galeria) {
              echo '<div class="col-md-3 galeria-item">'; // Ajusta el número de columnas según tus necesidades
              echo "<input type='checkbox' name='selec[" . $galeria->__GET("id") . "]' id='checkbox-" . $galeria->__GET("id") . "'>";

              echo '<div class="d-flex align-items-center">
                    <img src="../../assets/img/tatuajes/' . $galeria->__GET("imagen") . '" alt="tatuaje" class="img-fluid" style="width: 95%; height: 100%;" />
                  </div>';

              echo "<input type='hidden' name='selec[" . $galeria->__GET("id_tatuador") . "]' id='checkbox-" . $galeria->__GET("id_tatuador") . "'>";
              echo '</div>';
            }
          ?>
        </div>

        <input type="submit" name=Eliminar class="btn btn-danger mt-5"  value="Eliminar Seleccionados">
      
    </div>
    
  </form>




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
