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
                    <li class="nav-item">
                        <a class="nav-link" href="gestionarPedidos.php">Gestionar Pedidos</a>
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

      <table class="table table-responsive" >
        <thead class="bg-light">
          <tr>
            <th></th>
            <th>Tatuador</th>
            <th>Id</th>
            <th>Rol</th>
            <th>Estilo</th>
            <th>Descripción</th>
            <th>Imagen</th>
          
          </tr>
        </thead>
        <tbody>

        <?php
          $dao->Listar(); 

          foreach ($dao->tatuadores as $tatuador )
          {
              echo "<tr>"; 
              echo "<td><input type=checkbox name=selec[".$tatuador->__GET("id")."]></td>";
              echo '
              <td>
                <div class="d-flex align-items-center">
                  <img src="../../assets/img/perfil/' . $tatuador->__GET("imagen") . '" alt="perfil" style="width: 45px; height: 45px" class="rounded-circle" />
                  <div class="ms-3">
                    <input class="fw-bold mb-1" name=nombre value=' . $tatuador->__GET("nombre") . '>
                    <input class="fw-bold mb-1" name=apellido value=' . $tatuador->__GET("apellido") . '>
                    <input class="text-muted mb-0" type=text name=email value=' . $dao->RecogerEmail($tatuador->__GET("id_usuario")) . '>
                  </div>
                </div>
              </td>';

              echo "<td><input type=text name=id[".$tatuador->__GET("id")."]  value=".$tatuador->__GET("id")." readonly=readonly></td>";

              echo "<td><input type=text name=rol value=".$dao->RecogerRol($tatuador->__GET("id_usuario"))."></td>";
              
              echo "<td><input type=text name=estilo[".$tatuador->__GET("estilo")."] value=".$tatuador->__GET("estilo")."></td>";
              echo " <td><textarea name=descripcion[" . $tatuador->__GET("descripcion") . "] class=form-control>" . $tatuador->__GET("descripcion") . "</textarea></td>";
             
              echo "<td><input class=form-control form-control-sm type=file name=LogoN[".$tatuador->__GET("id")."] </td>"; 
              echo "<td><input type=hidden name=NomFot[".$tatuador->__GET('id') ."] value=".$tatuador->__GET("imagen"). ">";
              echo "<td><input type=hidden name=id_usuario[".$tatuador->__GET("id_usuario")."] value=".$tatuador->__GET("id_usuario")."></td>";

               
              
              echo "</tr>"; 
              
          }

          
        ?>
        </tbody>
      </table>



      <button type="button" class="btn btn-info" data-mdb-ripple-init data-toggle="modal" 
      data-target="#insertarModal">Insertar Tatuador</button>
      <input type="submit" name=Actualizar class="btn btn-info"  value="Actualizar Seleccionado">
      <button type="button" class="btn btn-info" data-mdb-ripple-init data-toggle="modal" 
      data-target="#borrarModal">Borrar Tatuadores</button>




      <!-- Modal de insertar -->
      <div class="modal" id="insertarModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title text-white" id="modalInsertar">Insertar tatuador</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
                echo '<div data-mdb-input-init class="form-outline mb-4">
                      <label class="form-label" for="form4Example1">Email</label>
                      <input type="text" name="emailNuevo" class="form-control" />
                    </div>';

                echo '<div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form4Example1">Nombre</label>
                        <input type="text" name="nombreNuevo" class="form-control" />
                      </div>';
                
                echo '<div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form4Example1">Apellido</label>
                        <input type="text" name="apellidoNuevo" class="form-control" />
                      </div>';
                
                echo '<div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form4Example1">Estilo</label>
                        <input type="text" name="estiloNuevo" class="form-control" />
                      </div>';
                
                echo '<div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form4Example1">Descripción</label>
                        <textarea name="descNuevo" class="form-control" rows="4"></textarea>
                      </div>';
                
                echo '<div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form4Example1">Rol</label>
                        <input type="text" name="rolNuevo" class="form-control" />
                      </div>';
                
                echo '<div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form4Example1">Contraseña</label>
                        <input type="text" name="passwordNueva" class="form-control" />
                      </div>';
                
                echo '<div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form4Example1">Imagen</label>
                        <input type="file" name="imagenNueva" class="form-control" />
                      </div>';

              ?>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
              <input type="submit" name=Insertar class="btn btn-info"  value=Insertar>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal de eliminar -->
      <div class="modal" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="modalEliminar">Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <p>¿Seguro que desea eliminarlos?</p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" name="Borrar" class="btn btn-danger" value="Borrar">
                    </div>
                </div>
            </div>
        </div>
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

    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>
