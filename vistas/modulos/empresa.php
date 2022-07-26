
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos de la empresa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="empresa">Inicio</a></li>
              <li class="breadcrumb-item active">Empresa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
           <?php
           $total = 568700;
           $imp = $total /11;
           $neto = $total - $imp;
           // echo "Neto ".number_format($neto)." IMP. ".number_format($imp)." Total ".number_format($total);

            $item = null;
            $valor = null;
            $empresa = ControladorEmpresas::ctrMostrarEmpresa($item, $valor);
              // var_dump($empresa);
            $id = 0;
            $denominacion = "Nombre de la empresa";
            $ruc = "Ruc de la empresa";
            $dir = "Ubicación de la empresa";
            $logo = "";
            $tel = "Numero telefónico";
            $mail = "Correo empresa";
            $boton = "AGREGAR";
            if ($empresa != null) {
               $boton = "EDITAR";
              foreach ($empresa as $key => $value) {
               // echo "Empresa ".$value["denominacion"];
              }

              $id =$value["id_empresa"];
              $denominacion = $value["denominacion"];
              $ruc =$value["ruc"];
              $dir = $value["direccion"];
              $logo  =$value["logo"];
              $tel = $value["telefono"];
              $mail = $value["correo"];
            }
            // echo "id ".$id;

           ?>
      <button class="btn btn-primary btnEmpresa"  data-toggle="modal" data-target="#modalEmpresa"><?php echo $boton; ?></button>
     <hr>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-sm-6">
                  <h5>Logo de la empresa 500x183px</h5>
                <div class="col-sm-6">
                  <?php
                  if ($logo == "") {
                   echo '<img src="vistas/img/plantilla/logo-default.png" class="border">';
                  }else{
                    echo '<img src="'.$value["logo"].'" class="border">';
                  }
                   ?>


                </div>
                <hr>
                  <h4>
                    <i class="fas fa-globe"></i> Razon Social: <?php echo $denominacion; ?>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                   <address>
                    <strong>Ruc: <?php echo $ruc; ?></strong><br>
                    <strong>Dirección: </strong><br>
                    <?php echo $dir; ?><br>
                    Telefono: <?php echo $tel; ?><br>
                    Correo: <?php echo $mail; ?>
                  </address>
                </div>


              </div>
              <!-- /.row -->
            </div>

        </div>
        </div>
      </section>
    <!-- /.content -->
  </div>

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEmpresa">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title"><?php echo $boton. " EMPRESA" ;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="post" enctype="multipart/form-data">
          <!-- NOMBRE -->
          <input type="hidden" name="ope" id="ope" value="<?php echo $boton;?>">
          <input type="hidden" name="codigoEmpresa" id="codigoEmpresa" value="<?php echo $id;?>" required>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-check-circle"></i></div>
                  </div>
                  <?php
                   if ($id != "") {
                        echo '<input type="text" class="form-control" id="inlineFormInputGroup" required name="editarRazon" value="'.$denominacion.'">';
                     }else{
                      echo '<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Razon social" required name="nuevaRazon">';
                     }
                   ?>

                </div>
            </div>
            <!-- USUARIO -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-check-circle"></i></div>
                  </div>
                  <?php
                   if ($id != "") {
                    echo ' <input type="text" class="form-control" id="inlineFormInputGroup"  required name="editarRuc" value="'.$ruc.'">';
                   }else{
                    echo ' <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Ruc" required name="nuevoRuc">';
                   }
                   ?>

                </div>
            </div>
            <!-- CONTRASEÑA -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-check-circle"></i></div>
                  </div>
                  <?php
                   if ($id != "") {
                    echo '<input type="text" class="form-control" id="inlineFormInputGroup"  name="editarTelefono" value="'.$tel.'">';
                   }else{
                    echo '<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Teléfono"  name="nuevoTelefono">';
                   }
                   ?>

                </div>
            </div>
            <!-- PERFIL -->

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-check-circle"></i></div>
                  </div>
                  <?php
                  if ($id != "") {
                    echo '<input type="text" class="form-control" id="inlineFormInputGroup" name="editarDirección" value="'.$dir.'">';
                  }else{
                    echo '<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Dirección"  name="nuevaDirección">';
                  }
                   ?>


                </div>
            </div>
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-check-circle"></i></div>
                  </div>
                  <?php
                    if ($id != "") {
                      echo ' <input type="text" class="form-control" id="inlineFormInputGroup" name="editarCorreo" value="'.$mail.'">';
                    }else{
                      echo '<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Correo"  name="nuevoCorreo">';
                    }
                   ?>

                </div>
            </div>
              <!-- FOTO -->
                <div class="col-auto">
                  <?php
                     if ($id != "") {
                      echo ' <div class="col-auto">
                    <div class="panel">Subir Foto</div>
                    <input type="file" class="nuevaFoto" name="editarFoto">
                    <p class="help-block">Subir maximo 2Mb.</p>';
                    if ($logo != "") {
                     echo '<img src="'.$logo.'" class="img-thumbnail previsualizar">
                     <input type="hidden" id="fotoActual" name="fotoActual" value="'.$logo.'">';
                    }else{
                      echo '<img src="vistas/img/plantilla/logo-default.png" class="img-thumbnail previsualizar">';
                    }
                     // echo '<img src="vistas/img/plantilla/logo-default.png" class="img-thumbnail previsualizar">';
                    echo '
                  </div>';
                     }else{
                      echo '<div class="panel">Subir Foto</div>
                    <input type="file" class="nuevaFoto" name="nuevaFoto">
                    <p class="help-block">Load imagen maximo 2Mb.</p>
                    <img src="vistas/img/plantilla/logo-default.png" class="img-thumbnail previsualizar">
                    <input type="hidden" id="fotoActual" name="fotoActual">';

                     }
                   ?>

                </div>
              <!-- botones -->

             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <?php
              $crudEmpresa = new ControladorEmpresas();
              $crudEmpresa -> ctrAbmEmpresa();
             ?>
        </form>
      </div>

    </div>
  </div>
</div>