  <?php
  if (isset($_GET["codigo"])) {

      $item_h = "id_historial";
      $valor_h = $_GET["codigo"];
      $historial = ControladorHistorial::ctrTraerHistorial($item_h, $valor_h);
      $id_historial = $historial["id_historial"];
      $motivo =  $historial["motivo"];
      $cli = $historial["id"];
      $date = date_create($historial["fecha"]);
      $fecha = date_format($date, 'd/m/Y');
      $date1 = date_create($historial["retiro"]);
      $fecha1 = date_format($date1, 'd/m/Y');
      $hs = date_create($historial["retiro"]);
      $hora = date_format($hs, 'H:i:s');

      $esfod = $historial["esf_od"];
      $esfoi = $historial["esf_oi"];

      $cilod =  $historial["cilindro_od"];
      $ciloi =  $historial["cilindro_oi"];

      $ejeod =  $historial["eje_od"];
      $ejeoi =  $historial["eje_oi"];

      $adod =  $historial["adicion_od"];
      $adoi =  $historial["adicion_oi"];
      $_dnpod =  $historial["dnp_od"];
      $_dnpoi =  $historial["dnp_oi"];

      $_di =  $historial["di"];
      $_alt =  $historial["alt"];
      $_mono_descri =  $historial["monofocal_descri"];
      $_estuche =  $historial["estuche"];
      $_bifocal_descri  =  $historial["bifocal_descri"];
      $_progresivo_descri =  $historial["progresivo_descri"];

      $_armazon = $historial["armazon"];
      $_doctor =  $historial["doctor"];
      $totalx = $historial["total"];
      $anticipo=  $historial["anticipo"];
      $saldox =$totalx - $anticipo;
      $saldo = number_format($saldox);
      $total = number_format($totalx);

    $item = "id";
    $valor = $cli;
    $traerCliente =ControladorClientes::crtMostrarClientes($item, $valor);
   // var_dump($traerCliente);
    // $encriptar = crypt(1347, '$2a$07$usesomesillystringforsalt$');

  }
   ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar historial de consultas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <!-- <li class="breadcrumb-item active"><a href="historial">Historial</a></li> -->
              <li class="breadcrumb-item"><a href="clientes">Clientes</a></li>
              <li class="breadcrumb-item active"><a href="consultas">Consultas</a></li>
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
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title nombreCliente">
                  <i class="fas fa-user-edit"></i>
                  <?php echo $traerCliente["documento"]." - ".$traerCliente["nombre"]." ".$hora   ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <form method="post">
                <input type="hidden" id="id_historial" name="id_historial" value="<?php echo $id_historial ?>">
                <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $traerCliente["id"] ?>">
                 <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                  <label>Fecha</label>
                  <div class="input-group">
                  <!--   <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div> -->
                    <input id="editarRegistro" name="editarRegistro" width="auto" value="<?php echo $fecha; ?>"  />
                   <!--  <input type="text" class="form-control fechaHisto" id="editarRegistro" name="editarRegistro" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask> -->
                  </div>
                  <!-- /.input group -->
                </div>
                  </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label>Motivo:</label>
                        <!-- <input type="text" class="form-control form-control-sm" id="editarMotivo" name="editarMotivo" > -->
                           <input type="text" class="form-control form-control-sm" id="editarMotivo" name="editarMotivo" value="<?php echo $motivo ?>">
                      </div>
                    </div>


                  </div>
                <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Esferico</label>
                        <input type="text" class="form-control form-control-sm"  id="editarEsfOd" name="editarEsfOd" value="<?php  echo $esfod; ?>">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Cilindro</label>
                        <input type="text" class="form-control form-control-sm" id="editarCilOd" name="editarCilOd" value="<?php  echo $cilod; ?>">
                      </div>
                    </div>
                     <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Eje</label>
                        <input type="text" class="form-control form-control-sm" id="editarEjeOd" name="editarEjeOd" value="<?php  echo $ejeod; ?>">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Adición</label>
                        <input type="text" class="form-control form-control-sm" id="editarAdicionOd" name="editarAdicionOd" value="<?php  echo $adod; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">

                        <input type="text" class="form-control" id="editarEsfOi" name="editarEsfOi" value="<?php  echo $esfoi; ?>">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">

                        <input type="text" class="form-control" id="editarCilOi" name="editarCilOi" value="<?php  echo $ciloi; ?>">
                      </div>
                    </div>
                     <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">

                        <input type="text" class="form-control" id="editarEjeOi" name="editarEjeOi" value="<?php  echo $ejeoi; ?>">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">

                        <input type="text" class="form-control" id="editarAdicionOi" name="editarAdicionOi" value="<?php  echo $adoi; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>D.N.P</label>
                        <input type="text" class="form-control form-control-sm" id="editarDnpOd"  name="editarDnpOd" value="<?php  echo $_dnpod; ?>">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>D.N.P</label>
                        <input type="text" class="form-control form-control-sm" id="editarDnpOi"  name="editarDnpOi"  value="<?php  echo $_dnpoi; ?>">
                      </div>
                    </div>
                     <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>D.I</label>
                        <input type="text" class="form-control form-control-sm" id="editarDi"  name="editarDi"  value="<?php  echo $_di; ?>">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>ALT</label>
                        <input type="text" class="form-control form-control-sm" id="editarAlt"  name="editarAlt" value="<?php  echo $_alt; ?>">
                      </div>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="custom-control custom-checkbox">
                      <?php

                        $_monofocal = $historial["monofocal"];

                          if ($_monofocal){
                            echo '<input class="custom-control-input" type="checkbox" id="editar_chk_monofocal" checked="checked">
                            <label for="editar_chk_monofocal" class="custom-control-label" >Monofocal&nbsp</label>
                      <input type="hidden" id="monofocal" name="monofocal" value="'.$_monofocal.'">

                            ';
                          }else{
                            echo '<input class="custom-control-input" type="checkbox" id="editar_chk_monofocal">
                      <label for="editar_chk_monofocal" class="custom-control-label" >Monofocal&nbsp</label>
                      <input type="hidden" id="monofocal" name="monofocal" value="">';
                          }
                       ?>

                   </div>
                   <div class="col-sm-6">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="editar_mono_descri"  name="editar_mono_descri" class="form-control form-control-sm" value="<?php  echo $_mono_descri; ?>">
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="editar_estuche" name="editar_estuche" class="form-control form-control-sm" value="<?php  echo $_estuche; ?>">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="custom-control custom-checkbox">
                    <?php
                      $_bifocal = $historial["bifocal"];
                      // echo "bifocal ". $_bifocal;
                      if ($_bifocal) {
                        echo '<input class="custom-control-input" type="checkbox" id="editar_chk_bifocal" checked="checked">
                      <label for="editar_chk_bifocal" class="custom-control-label">Bifocal&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                      <input type="hidden" id="bifocal" name="bifocal" value="'.$_bifocal.'">';
                      }else{
                      echo '<input class="custom-control-input" type="checkbox" id="editar_chk_bifocal">
                      <label for="editar_chk_bifocal" class="custom-control-label">Bifocal&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                      <input type="hidden" id="bifocal" name="bifocal" value="">';
                      }

                     ?>

                   </div>
                   <div class="col">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="editar_bifocal_descri"  name="editar_bifocal_descri" class="form-control form-control-sm" value="<?php  echo $_bifocal_descri; ?>">
                      </div>
                    </div>

                  </div>
                      <div class="row">
                      <?php
                        $_progresivo = $historial["progesivo"];
                          if ($_progresivo) {
                            echo '<div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="editar_chk_progresivo" checked="checked">
                                <label for="editar_chk_progresivo" class="custom-control-label">Progresivo</label>
                                <input type="hidden" id="progresivo" name="progresivo" value="'.$_progresivo.'">
                             </div>';
                          }else{
                            echo '<div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="editar_chk_progresivo" >
                            <label for="editar_chk_progresivo" class="custom-control-label">Progresivo</label>
                            <input type="hidden" id="progresivo" name="progresivo" value="">
                         </div>';
                          }
                       ?>

                   <div class="col">
                      <div class="form-group">
                        <!-- <label>ALT</label> -->
                        <input type="text" id="editar_progresivo_descri"  name="editar_progresivo_descri" class="form-control form-control-sm" value="<?php  echo $_progresivo_descri; ?>">
                      </div>
                    </div>

                  </div>
                    <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Armazón</label>
                        <input type="text" class="form-control form-control-sm" id="editarArmazon" name="editarArmazon" value="<?php  echo $_armazon; ?>">
                      </div>
                    </div>
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Doctor</label>
                        <input type="text" class="form-control form-control-sm" id="editarDoctor" name="editarDoctor" value="<?php  echo $_doctor; ?>">
                      </div>
                    </div>
                  </div>
                <div class="row">
                   <div class="col-sm-6">
                    <div class="form-group">
                  <label>Retiro</label>
                  <div class="input-group">
                    <!-- <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div> -->
                     <input id="editarRetiro" name="editarRetiro" width="auto" value="<?php echo $fecha1; ?>"  />
                    <!-- <input type="text" class="form-control fechaHisto" id="editarRetiro" name="editarRetiro"> -->
                  </div>
                  <!-- /.input group -->
                </div>
                  </div>
                     <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <div class="bootstrap-timepicker">
                                      <div class="form-group">
                                        <label for="nuevaHora">HORA:</label>

                                      <div class="input-group">
                                        <input class="timepicker" id="editarHora" name="editarHora" value="<?php echo $hora ?>" required readonly>

                                    </div>
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
                        <?php
                        $totalx = $historial["total"];
                          $anticipo=  $historial["anticipo"];
                           $saldox =$totalx - $anticipo;
                           $saldo = number_format($saldox);
                           $total = number_format($totalx);
                         ?>
                        <input type="number" class="form-control form-control-sm" id="editarTotal" name="editarTotal" min="0" value="<?php echo $totalx ?>">
                      </div>
                    </div>
                      <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Seña</label>
                        <input type="number" class="form-control form-control-sm" id="editarEntrega" name="editarEntrega" min="0" value="<?php echo $anticipo ?>">
                      </div>
                    </div>
                      <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Saldo</label>
                        <input type="number" class="form-control form-control-sm" id="editarSaldo" name="editarSaldo" min="0" value="<?php echo $saldox ?>" readonly="">
                      </div>
                    </div>
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
                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
              <?php
                $editarHistorial = new ControladorHistorial();
                $editarHistorial -> ctrEditarHistorial();
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
                    $valora =$cli;
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

