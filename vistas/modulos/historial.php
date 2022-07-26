  <?php
  if (isset($_GET["id"])) {
    $item = "id";
    $valor = $_GET["id"];
    $traerCliente =ControladorClientes::crtMostrarClientes($item, $valor);
   // var_dump($traerCliente);
    $encriptar = crypt(1347, '$2a$07$usesomesillystringforsalt$');

  }
   ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de consulta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
               <li class="breadcrumb-item"><a href="consultas">Consultas</a></li>
              <li class="breadcrumb-item active">Historial</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
   <!-- <hr> -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title nombreCliente">
                  <i class="fas fa-user-edit"></i>
                  <?php echo $traerCliente["documento"]." - ".$traerCliente["nombre"];   ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <form method="post">
                <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $traerCliente["id"] ?>">
                 <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                  <label>Fecha</label>
                  <div class="input-group">
                    <input id="nuevoRegistro" name="nuevoRegistro" width="auto" />
                    <!-- <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control fechaHisto" id="nuevoRegistro" name="nuevoRegistro" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask> -->
                  </div>
                  <!-- /.input group -->
                </div>
                  </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label>Motivo:</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoMotivo" name="nuevoMotivo" placeholder="Motivo de consulta">
                      </div>
                    </div>


                  </div>
                <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Esferico</label>
                        <input type="text" class="form-control form-control-sm"  id="nuevoEsfOd" name="nuevoEsfOd" placeholder="OD">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Cilindro</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoCilOd" name="nuevoCilOd" placeholder="OD">
                      </div>
                    </div>
                     <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Eje</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoEjeOd" name="nuevoEjeOd" placeholder="OD">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Adición</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoAdicionOd" name="nuevoAdicionOd" placeholder="OD">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">

                        <input type="text" class="form-control" id="nuevoEsfOi" name="nuevoEsfOi" placeholder="OI">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">

                        <input type="text" class="form-control" id="nuevoCilOi" name="nuevoCilOi" placeholder="OI">
                      </div>
                    </div>
                     <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">

                        <input type="text" class="form-control" id="nuevoEjeOi" name="nuevoEjeOi" placeholder="OI">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">

                        <input type="text" class="form-control" id="nuevoAdicionOi" name="nuevoAdicionOi" placeholder="OI">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>D.N.P</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoDnpOd"  name="nuevoDnpOd" placeholder="OD">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>D.N.P</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoDnpOi"  name="nuevoDnpOi"  placeholder="OI">
                      </div>
                    </div>
                     <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>D.I</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoDi"  name="nuevoDi"  placeholder="D.I">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>ALT</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoAlt"  name="nuevoAlt"  placeholder="Alt">
                      </div>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="chk_monofocal">
                      <label for="chk_monofocal" class="custom-control-label" >Monofocal&nbsp</label>
                      <input type="hidden" id="monofocal" name="monofocal" value="">
                   </div>
                   <div class="col-sm-6">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="mono_descri"  name="mono_descri" class="form-control form-control-sm" placeholder="Descripción">
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="nuevo_estuche" name="nuevo_estuche" class="form-control form-control-sm" placeholder="Estuche">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="chk_bifocal">
                      <label for="chk_bifocal" class="custom-control-label">Bifocal&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                      <input type="hidden" id="bifocal" name="bifocal" value="">
                   </div>
                   <div class="col">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="bifocal_descri"  name="bifocal_descri" class="form-control form-control-sm" placeholder="Descripción">
                      </div>
                    </div>

                  </div>
                      <div class="row">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="chk_progresivo">
                      <label for="chk_progresivo" class="custom-control-label">Progresivo</label>
                      <input type="hidden" id="progresivo" name="progresivo" value="">
                   </div>
                   <div class="col">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="progresivo_descri"  name="progresivo_descri" class="form-control form-control-sm" placeholder="Descripción">
                      </div>
                    </div>

                  </div>
                    <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Armazón</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoArmazon" name="nuevoArmazon" placeholder="Descripción">
                      </div>
                    </div>
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Doctor</label>
                        <input type="text" class="form-control form-control-sm" id="nuevoDoctor" name="nuevoDoctor" placeholder="Doctor">
                      </div>
                    </div>
                  </div>
                <div class="row">
                   <div class="col-sm-6">
                    <div class="form-group">
                  <label>Retiro</label>
                  <div class="input-group">
                    <input id="nuevoRetiro" name="nuevoRetiro" width="auto" />
                    <!-- <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control fechaHisto" id="nuevoRetiro" name="nuevoRetiro" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask> -->
                  </div>
                  <!-- /.input group -->
                </div>
                  </div>
                     <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <div class="bootstrap-timepicker">
                                      <div class="form-group">
                                        <label for="nuevaHora">HORA:</label>
                                  <input class="timepicker" id="nuevaHora" name="nuevaHora" required readonly>
                                      <!-- <div class="input-group">
                                        <input type="text" class="form-control timepicker" id="nuevaHora" name="nuevaHora" required readonly>
                                      <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                    </div> -->
                                    <!-- /.input group -->
                                  </div>
                                  <!-- /.form group -->
                                </div>
                              </div>
                          </div>

                </div>
                <div class="row">
                  <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total</label>
                        <input type="number" class="form-control form-control-sm" id="nuevoTotal" name="nuevoTotal" min="0" value="0">
                      </div>
                    </div>
                      <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Seña</label>
                        <input type="number" class="form-control form-control-sm" id="nuevaEntrega" name="nuevaEntrega" min="0" value="0">
                      </div>
                    </div>
                      <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Saldo</label>
                        <input type="number" class="form-control form-control-sm" id="nuevoSaldo" name="nuevoSaldo" min="0" value="0" readonly="">
                      </div>
                    </div>
              <!--     <div class="col-sm-4">
                   <div class="form-group">
                    <label>Subir receta</label>
                      <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Seleccionar receta</label>
                    </div>
                  </div>
                 </div> -->
                 </div>
                 <div class="row">
                   <div class="col-auto">
                    <div class="panel">Subir imagen</div>
                    <input type="file" class="nuevaFoto" name="nuevaFoto">
                    <p class="help-block">Maximo 2Mb.</p>
                    <img src="vistas/img/usuarios/order.png" class="img-thumbnail previsualizar" width="100px">
                  </div>
                 </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Grabar</button>
                </div>
              <?php
                $crearHistorial = new ControladorHistorial();
                $crearHistorial -> ctrCrearHistorial();
               ?>

              </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  Historial de consultas
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
   <table   class="table table-striped table-bordered dt-responsive nowrap tblHistorial" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Fecha</th>
                  <th>Motivo</th>
                  <th>#</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $itema = "id";
                    $valora = $_GET["id"];
                  $historial = ControladorHistorial::ctrMostrarHistorial($itema, $valora);
                  foreach ($historial as $key => $value) {
                     echo '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.$value["fecha"].'</td>
                            <td>'.$value["motivo"].'</td>
                            <td>'.$value["id_historial"].'</td>
                            ';
                            echo '

                            <td>
                              <div class="btn-group-xs">
                                <button class="btn btn-warning btnEditarHistorial" idUsuario="'.$value["id_historial"].'" name="btnEditarUsuario"><i class="far fa-edit"></i></button>

                                <button class="btn btn-danger btnEliminarHistorial" idUsuario="'.$value["id_historial"].'" "><i class="far fa-trash-alt"></i></button>
                                <button class="btn btn-success btnMostrarHistorial" idUsuario="'.$value["id_historial"].'" "><i class="fas fa-print"></i></button>
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
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->




      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>