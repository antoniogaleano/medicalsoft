

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

              <li class="breadcrumb-item active">Ventas</li>
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
          <a href="crear-venta" > <button class="btn btn-primary btn-sm">Agregar Ventas
           </button></a>
   <?php
            if(isset($_GET["fechaInicial"])) {
              // echo "fecha".$_GET["fechaInicial"];
              $itemCierre = "fecha";
               $valorCierre = $_GET["fechaInicial"];
               $traeCierre   = ControladorVentas::ctrMostrarCierre($itemCierre, $valorCierre);
               // echo date('d/m/Y',strtotime($valorCierre));
             // echo   json_encode( $traeCierre);
               // var_dump($traeCierre);
           }
          ?>
            <a href='extensiones/tcpdf/pdf/libro_ventas.php?fechaInicial=<?php echo $valorCierre ?>' target="_blank"> <button class="btn btn-default btn-sm">Imprimir
           </button></a>

           <div id="reportrange" class="float-right"><i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
            </div>
            <hr>
              <table   class="table table-striped table-bordered dt-responsive  tablaVentaDet" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th style="width:10px">Factura</th>
                  <th>Cliente</th>
                  <th style="width:150px">Vendedor</th>
                  <th style="width:100px">Pago</th>
                  <th style="width:40px">Imp</th>
                  <th style="width:40px">Total</th>
                  <th style="width:100px">Fecha</th>
                  <th style="width:0px">ID</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php

            if (isset($_GET["fechaInicial"])) {
                     $fechaInicial = $_GET["fechaInicial"];
                     $fechaFinal = $_GET["fechaFinal"];
              }else{
                     $fechaInicial = null;
                     $fechaFinal = null;
             }
                    $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
                       // var_dump($respuesta);



                    foreach ($respuesta as $key => $value) {
                      $item = "usuario";
                     $valor = $value["id_vendedor"];
                     $traeCaja = ControladorVentas::ctrMostrarCaja($item, $valor);
                     // var_dump($traeCaja);
                     $sucursal = $traeCaja["sucursal"];
                     $caja = $traeCaja["caja"];
                       $factura = $sucursal."-".$caja."-".str_pad($value["codigo"], 7, "0000000", STR_PAD_LEFT);
                      $fecha = date_format (new DateTime($value["fecha"]), 'd-m-Y H:i:s');
                       echo '<tr>
                     <td>'.($key+1).'</td>
                     <td>'.$factura.'</td>
                     <td>'.$value["cliente"].'</td>
                     <td>'.$value["vendedor"].'</td>
                     <td>'.$value["metodo_pago"].'</td>
                     <td>'.number_format(($value["neto"]/11 ),0).'</td>
                     <td>'.number_format($value["total"],0).'</td>
                     <td>'.$fecha.'</td>
                     <td>'.$value["id"].'</td>
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
