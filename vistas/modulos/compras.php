  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compras</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

              <li class="breadcrumb-item active">Compras</li>
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
          <a href="crear-compra"> <button class="btn btn-primary btn-sm">Agregar compras
           </button></a>
           <div id="reportrange" class="float-right"><i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
            </div>
            <hr>
              <table   class="table table-striped table-bordered dt-responsive  tablaCompraDet" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th style="width:10px">Fecha</th>
                  <th style="width:15px">Factura</th>
                  <th>Proveedor</th>
                  <th style="width:10px">Tipo</th>
                  <th style="width:150px">Vence</th>
                  <th style="width:50px">Neto</th>
                  <th style="width:50px">Total</th>
                  <th style="width:40px">Estado</th>
                  <th style="width:0px">Id</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
  function fechabd1($fecha){
                 $db = "";
                  $var = $fecha;
                  $dia = substr($var,8,2);
                  $mes = substr($var,5,2);
                  $anio = substr($var,0,4);
                  return $db = $dia."/".$mes."/".$anio;
               }
               // echo fechabd1("2020-05-25");
            if (isset($_GET["fechaInicial"])) {
                     $fechaInicial = $_GET["fechaInicial"];
                     $fechaFinal = $_GET["fechaFinal"];
              }else{
                     $fechaInicial = null;
                     $fechaFinal = null;
             }
                    $respuesta = ControladorCompras::ctrRangoFechasCompras($fechaInicial, $fechaFinal);
                    // var_dump($respuesta);
                    foreach ($respuesta as $key => $value) {
                       echo '<tr>
                     <td>'.($key+1).'</td>
                     <td>'.fechabd1($value["fecha"]).'</td>
                     <td>'.$value["factura"].'</td>
                     <td>'.$value["razon_social"].'</td>
                     <td>'.$value["tipo"].'</td>
                     <td>'.fechabd1($value["vencimiento"]).'</td>
                     <td>'.$value["neto"].'</td>
                     <td>'.$value["total"].'</td>
                     <td>'.$value["estado"].'</td>
                     <td>'.$value["id_compra"].'</td>
                      <td></td>
                   </tr>';
                    }
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
