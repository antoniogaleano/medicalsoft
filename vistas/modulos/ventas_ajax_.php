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
          <a href="crear-venta"> <button class="btn btn-primary btn-sm">Agregar Ventas
           </button></a>
           <div id="reportrange" class="float-right"><i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
            </div>
        <!--     <button type="button" class="btn btn-default float-right" id="daterange-btn">
                      <i class="far fa-calendar-alt"></i> Filtro Fecha
                      <i class="fas fa-caret-down"></i>
                    </button> -->

        <!-- <div style="margin-top: 5px; margin-bottom: 5px;"></div> -->
        <hr>
            <!-- <table  class="table table-bordered table-striped dt-responsive tablas"> -->
              <!-- <table class="table table-bordered table-striped dt-responsive tablas"> -->
              <table   class="table table-striped table-bordered dt-responsive  tablaVentaDet" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th style="width:10px">Factura</th>
                  <th style="width:150px">Cliente</th>
                  <th style="width:150px">Vendedor</th>
                  <th>Pago</th>
                  <th style="width:40px">Neto</th>
                  <th style="width:40px">Total</th>
                  <th style="width:10px">Fecha</th>
                  <th>Acciones</th>
                </tr>
                </thead>
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
