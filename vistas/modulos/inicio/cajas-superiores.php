<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">

                <span class="info-box-text"><a href="reportes">Reportes</a></span>
                <span class="info-box-number">
                  0
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-box-open"></i></span>
            <?php
              $item = null;
              $valor = null;
              $productos = ControladorProductos::crtMostrarProductos($item, $valor);
              $totalPro = count($productos);
             ?>
              <div class="info-box-content">
                <span class="info-box-text">Productos</span>
                <span class="info-box-number"><?php echo $totalPro; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <?php
            // SELECT SUM(neto)  FROM ventas where  date_format(fecha, '%Y-%m-%d') = '2020-05-07'
            date_default_timezone_set('America/Asuncion');
              $fechaActual = date('Y-m-d');
              $horaActual = date('H:i:s');
              // $fechaActual = $fechaActual.' '.$horaActual;
              $fechaActual = $fechaActual;
              $item = "fecha";
              // $valor = $fechaActual;
              $valor = $fechaActual;
              $respuesta = ControladorVentas::ctrMostrarVentasDiarias($item, $valor);
                // var_dump($respuesta);
             ?>
              <div class="info-box-content">
                <?php
                $fechaActual = date('Y-m-d');
                // echo "Hoy ".$fechaActual;
                $a = "index.php?ruta=ventas&fechaInicial=".$fechaActual."&fechaFinal=".$fechaActual;
                 ?>
                <span class="info-box-text"><a href="<?php echo $a ?>">Ventas del día</a></span>
                <!-- <span class="info-box-text"><p>Ventas del dia</p></span> -->
                <span class="info-box-number"><?php echo number_format($respuesta["neto"]);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <?php
                $item = null;
                $valor = null;
                $respuesta = ControladorClientes::crtMostrarClientes($item, $valor);
                $totalCliente = count($respuesta );
                // $count = 0;
                // foreach ($respuesta as $key => $value) {
                //   $count++;
                // }
                // echo $count;
               ?>
              <div class="info-box-content">
                <!-- <span class="info-box-text">Clientes</span> -->
                <span class="info-box-text"><a href="clientes">Clientes</a></span>
                <span class="info-box-number"><?php echo $totalCliente;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>