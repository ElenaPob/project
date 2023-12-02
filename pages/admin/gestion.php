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
    <link rel="icon" href="assets/icon/rosa.png" type="image/x-icon">

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
            <a class="nav-link" href="../../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tatuadores/tatuadores.php">Tatuadores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contacto/contacto.php">Contacto</a>
          </li>
          <?php

            // Verifica si el usuario está autenticado y tiene el rol de administrador
            if ($_SESSION["rol"] == "admin") {
              echo '<li class="nav-item">
                        <a class="nav-link" href="gestion.php">Gestionar Tatuadores</a>
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

    <form  name=f1 method="post" action='' enctype="multipart/form-data">
    
      <table >
        <thead class="bg-light">
          <tr>
            <th></th>
            <th></th>
            <th>Id</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Estilo</th>
            <th>Descripción</th>
            <th>id_usuario</th>
            <th>Perfil</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <div class="ml-5">
              <input class="form-check-input" type="checkbox" name="selec"  aria-label="..."/>
            </div>
          </td>
          <td>

            <div class="d-flex align-items-center">
              <img
                  src="../../assets/img/perfil/1.jpg"
                  alt="perfil"
                  style="width: 45px; height: 45px"
                  class="rounded-circle"
                  />
              <div class="ms-3">
                <p class="fw-bold mb-1">John Doe</p>
                <p class="text-muted mb-0">john.doe@gmail.com</p>
              </div>
            </div>
          </td>
          <td>
            <input class="fw-normal mb-1">Software engineer</input>
          </td>
          <td>
            <span class="badge badge-success rounded-pill d-inline">Active</span>
          </td>
          <td>
            <button type="button" class="btn btn-link btn-sm btn-rounded">
              Editar
            </button>
            <button type="button" class="btn btn-link btn-sm btn-rounded">
              Eliminar
            </button>
          </td>
        </tr>

        <?php
          $dao->Listar(); 

          foreach ($dao->tatuadores as $tatuador )
          {
              echo "<tr>"; 
              
              echo "<td><input type=checkbox name=selec[".$tatuador->__GET("id")."]></td>";
              echo "<td><input type=hidden name=selecU[".$tatuador->__GET("id_usuario")."]></td>";
              
              //echo print_r ($dao->RecogerEmail($tatuador->__GET("id_usuario")), true);
              
              echo "<td><input type=text name=id[".$tatuador->__GET("id")."]  value=".$tatuador->__GET("id")." readonly=readonly></td>";
              echo "<td><input type=text name=email value=".$dao->RecogerEmail($tatuador->__GET("id_usuario"))."></td>";
              
              echo "<td><input type=text name=nombre[".$tatuador->__GET("nombre")."] value=".$tatuador->__GET("nombre")."></td>";
              echo "<td><input type=text name=apellido[".$tatuador->__GET("apellido")."] value=".$tatuador->__GET("apellido")."></td>";
              echo "<td><input type=text name=estilo[".$tatuador->__GET("estilo")."] value=".$tatuador->__GET("estilo")."></td>";
              echo "<td><input type=textarea name=descripcion[".$tatuador->__GET("descripcion")."] value=".$tatuador->__GET("descripcion")."></td>";
              echo "<td><input type=text name=id_usuario[".$tatuador->__GET("id_usuario")."] value=".$tatuador->__GET("id_usuario")."></td>";

              echo "<td><img src=../../assets/img/perfil/".$tatuador->__GET("imagen")." width=80 height=80>";
              
              echo "<input type=hidden name=NomFot[".$tatuador->__GET('id') ."] value=".$tatuador->__GET("imagen"). ">";
              
              echo "<input type=file name=LogoN[".$tatuador->__GET("id")."] </td>";  
              
              echo "</tr>"; 
              
          }

          
        ?>
        </tbody>
      </table>

      <table>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Estilo</th>
        <th>Descripción</th>
        <th>Rol</th>
        <th>Contraseña</th>
        <th>Imagen</th>

      <?php


        
        echo "<tr>";
            

        echo "<td><input type=text name=emailNuevo ></td>";
        echo "<td><input type=text name=nombreNuevo ></td>";
        echo "<td><input type=text name=apellidoNuevo ></td>";
        echo "<td><input type=text name=estiloNuevo ></td>";
        echo "<td><input type=text name=descNuevo ></td>";
        echo "<td><input type=text name=rolNuevo ></td>";
        echo "<td><input type=text name=passwordNueva></td>";
        echo "<td><input type=file name=imagenNueva></td>";

      ?>

      </table>



      <input type="submit" name=Insertar class="btn btn-info"  value=Insertar>
      <input type="submit" name=Actualizar  class="btn btn-info" value=Actualizar>
      <input type="submit" name=Borrar  class="btn btn-info"  value=Borrar>

      
      
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>
