  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reportes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="reportes">Reportes</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

<div class="content">
     <div class="row">
      <!-- FORMULARIO -->
        <div class="col-lg-12 col-md-6">
            <div class="card card-success card-outline">
             <div class="card-body">
                <div id="reportrange2" class="float-left"><i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
                </div>
                <div class="box-tools pull-right float-right">
                  <?php
                    if (isset($_GET["fechaInicial"])) {
                      echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial="'.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';
                    }else{
                      echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';
                    }
                   ?>
                <button class="btn btn-success">Descargar reporte en excel</button>
                </a>
                </div>
                <br>
                <hr>

                <div class="row">
                  <div class="col">
                    <?php include "reportes/graficos-ventas.php" ?>
                  </div>
                </div>
              </div>
          </div>
        </div>

   </div>
 </div>
    <!-- /.content -->
  </div>
