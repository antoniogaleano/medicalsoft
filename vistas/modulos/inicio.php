

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Panel<small> de control</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="container-fluid">
        <!-- Info boxes -->
  <?php include "inicio/cajas-superiores.php" ?>

        <!-- /.row -->
       </div>
        <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

            <!-- /.card -->

            <div class="card">

              <div class="card-body table-responsive p-0">
               <?php include "reportes/graficos-ventas.php" ?>
              </div>
            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.row -->
      </div>
      <!-- Default box -->


    </section>
    <!-- /.content -->
  </div>