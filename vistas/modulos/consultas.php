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
            <h1>Historico de consultas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
               <li class="breadcrumb-item active"><a href="clientes">Clientes</a></li>
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


          <div class="col-md-12">
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
                  <th>Documento</th>
                  <th>Cliente</th>
                  <th>Motivo</th>
                  <th>#</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $itema = null;
                    $valora = null;
                  $historial = ControladorHistorial::ctrMostrarHistorial($itema, $valora);
                  foreach ($historial as $key => $value) {
                     $item = "id";
                      $valor = $value["id"];
                      $traerCliente =ControladorClientes::crtMostrarClientes($item, $valor);
                     echo '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.$value["fecha"].'</td>
                            <td>'. $traerCliente["documento"].'</td>
                            <td>'. $traerCliente["nombre"].'</td>
                            <td>'.$value["motivo"].'</td>
                            <td>'.$value["id_historial"].'</td>
                            ';
                            echo '

                            <td>
                              <div class="btn-group-xs">
                                <button class="btn btn-warning btnEditarConsultas" idUsuario="'.$value["id_historial"].'" name="btnEditarUsuario"><i class="far fa-edit"></i></button>

                                <button class="btn btn-danger btnEliminarConsultas" idUsuario="'.$value["id_historial"].'" "><i class="far fa-trash-alt"></i></button>
                                <button class="btn btn-success btnMostrarConsultas" idUsuario="'.$value["id_historial"].'" "><i class="fas fa-print"></i></button>
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