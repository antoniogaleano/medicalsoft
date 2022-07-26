  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body card-success">
           <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar usuario
           </button>
        <!-- <div style="margin-top: 5px; margin-bottom: 5px;"></div> -->
        <hr>
            <!-- <table  class="table table-bordered table-striped dt-responsive tablas"> -->
              <table   class="table table-striped table-bordered dt-responsive nowrap tablas tbuser" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>Foto</th>
                  <th>Perfil</th>
                  <th>Estado</th>
                  <th>Ultimo Login</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $item = null;
                  $valor = null;
                  $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                  foreach ($usuarios as $key => $value) {
                     echo '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.$value["nombre"].'</td>
                            <td>'.$value["usuario"].'</td>
                            ';
                            if ($value["foto"] != "") {
                              echo ' <td><img src="'.$value["foto"].'" class="thumbnail" width="40px"></td>';
                            }else{
                              echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="thumbnail" width="40px"></td>';
                            }
                            echo '
                            <td>'.$value["perfil"].'</td>';
                             if ($value["estado"] != 0) {
                               echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'"  estadoUsuario="0">Activado</button></td>';
                              } else{
                                 echo '  <td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';
                              }


                            echo '
                            <td>'.$value["ultimo_login"].'</td>
                            <td>
                              <div class="btn-group-xs">
                                <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario" name="btnEditarUsuario"><i class="far fa-edit"></i></button>

                                <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" nombreUsuario="'.$value["usuario"].'"><i class="far fa-trash-alt"></i></button>
                              </div>
                            </td>
                          </tr>';
                  }
                  //var_dump($usuarios);
                 ?>


                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
       <!--  <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

<!-- MODAL AGRAGAR USUARIO -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarUsuario">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" enctype="multipart/form-data">
          <!-- NOMBRE -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                  </div>
                  <input type="text" class="form-control"  placeholder="Nombre y Apellido" name="nuevoNombre" required>
                </div>
            </div>
            <!-- USUARIO -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user-secret"></i></div>
                  </div>
                  <input type="text" class="form-control"  placeholder="Alias"  name="nuevoUsuario"  id="nuevoUsuario" required>
                </div>
            </div>
            <!-- CONTRASEÑA -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                  </div>
                  <input type="password" class="form-control"  placeholder="Contraseña" name="nuevoPassword" required >
                </div>
            </div>
            <!-- PERFIL -->

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                  </div>
                   <select class="form-control" id="exampleFormControlSelect1" name="nuevoPerfil" >
                      <option>Seleccionar Perfil</option>
                      <option>Administrador</option>
                      <option>Especial</option>
                      <option>Vendedor</option>
                    </select>
                </div>
            </div>
              <!-- FOTO -->
                  <div class="col-auto">
                    <div class="panel">Subir Foto</div>
                    <input type="file" class="nuevaFoto" name="nuevaFoto">
                    <p class="help-block">Subir maximo 2Mb.</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                  </div>
              <!-- botones -->

             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

            <?php
              $crearUsuario = new ControladorUsuarios();
              $crearUsuario -> ctrCrearUsuario();
            ?>
        </form>
      </div>

    </div>
  </div>
</div>


<!-- MODAL MODIFICAR USUARIO -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarUsuario">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Modificar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" enctype="multipart/form-data">
          <!-- NOMBRE -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                  </div>
                  <input type="text" class="form-control"  value="" id="editarNombre" name="editarNombre" required>
                </div>
            </div>
            <!-- USUARIO -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user-secret"></i></div>
                  </div>
                  <input type="text" class="form-control"  value="" id="editarUsuario" name="editarUsuario" readonly>
                </div>
            </div>
            <!-- CONTRASEÑA -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                  </div>
                  <input type="password" class="form-control"  placeholder="Escriba la nueva contraseña" name="editarPassword">
                    <input type="hidden" id="passwordActual" name="passwordActual" value="">
                </div>
            </div>
            <!-- PERFIL -->

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                  </div>
                   <select class="form-control" id="exampleFormControlSelect1" name="editarPerfil" >
                      <option value="" id="editarPerfil"></option>
                      <option>Administrador</option>
                      <option>Especial</option>
                      <option>Vendedor</option>
                    </select>
                </div>
            </div>
              <!-- FOTO -->
                  <div class="col-auto">
                    <div class="panel">Subir Foto</div>
                    <input type="file" class="nuevaFoto" name="editarFoto">
                    <p class="help-block">Subir maximo 2Mb.</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                    <input type="hidden" id="fotoActual" name="fotoActual">
                  </div>
              <!-- botones -->

             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Modificar</button>
            </div>

            <?php
              $editarUsuario = new ControladorUsuarios();
              $editarUsuario -> ctrEditarUsuario();
            ?>
        </form>
      </div>

    </div>
  </div>
</div>
<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
 ?>