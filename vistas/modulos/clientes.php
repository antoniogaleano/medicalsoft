  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
           <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarCliente">Agregar clientes
           </button>
        <!-- <div style="margin-top: 5px; margin-bottom: 5px;"></div> -->
        <hr>
          <!--   <table   class="table table-striped table-bordered dt-responsive  tablaVentaDet" style="width:100%"> -->
              <table   class="table table-striped table-bordered dt-responsive tablaClientes" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th style="width: 150px;">Nombre</th>
                  <th style="width: 15px;">Ruc</th>
                  <th style="width: 150px;">Email</th>
                  <th>Teléfono</th>
                  <th style="width: 150px;">Dirección</th>
                  <th>Fecha nacimiento</th>
                  <th>Total compras</th>
                  <th>Ingreso Sist.</th>
                  <th  style="width: 120px;">Acciones</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarCliente">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Agregar clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="post">
          <!-- NUEVA CATEGORIA -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-signature"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg"  placeholder="Ingresar nombre" name="nuevoCliente"  required>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                  </div>
                  <input type="text"   class="form-control input-group-lg"  placeholder="Ingresar Ruc/CI" name="nuevoDocumentoId"  required>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-envelope"></i></div>
                  </div>
                  <input type="email" class="form-control input-group-lg"  placeholder="Ingresar correo" name="nuevoEmail" required>
                </div>
            </div>
            <!-- ENTRADA PARA TELEFONO CON IMASK -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-phone"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg"  placeholder="Ingresar telefono" name="nuevoTelefono" data-inputmask="'mask':'(9999)999-999'" data-mask required>
                </div>
            </div>
             <!-- ENTRADA PARA DIRECCION -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fas fa-map-marker-alt"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg"  placeholder="Ingresar direccion" name="nuevaDireccion" required>
                </div>
            </div>
            <!-- ENTRADA PARA NACIMIENTO -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-birthday-cake"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg"  placeholder="Ingresar fecha de nacimiento" name="nuevaFechaNacimiento" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                </div>
            </div>
              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar cliente</button>
            </div>

        </form>
        <?php
              $crearCliente = new ControladorClientes();
              $crearCliente -> ctrCrearCliente();
             ?>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarCliente">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Editar clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="post">
          <!-- NUEVA CATEGORIA -->

            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-signature"></i></div>
                  </div>
                  <input type="hidden" value="" id="codigoClienteEditar" name="codigoClienteEditar">
                  <input type="text" class="form-control input-group-lg" name="editarCliente" id="editarCliente" required>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                  </div>
                  <input type="text"   class="form-control input-group-lg"   name="editarDocumentoId"  id="editarDocumentoId"  required>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-envelope"></i></div>
                  </div>
                  <input type="email" class="form-control input-group-lg"  name="editarEmail" id="editarEmail" required>
                </div>
            </div>
            <!-- ENTRADA PARA TELEFONO CON IMASK -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-phone"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg" id="editarTelefono" name="editarTelefono" data-inputmask="'mask':'(9999)999-999'" data-mask required>
                </div>
            </div>
             <!-- ENTRADA PARA DIRECCION -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fas fa-map-marker-alt"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg" id="editarDireccion" name="editarDireccion" required>
                </div>
            </div>
            <!-- ENTRADA PARA NACIMIENTO -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-birthday-cake"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg" id="editarFechaNacimiento" name="editarFechaNacimiento" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                </div>
            </div>
              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>

        </form>
        <?php
              $editarCliente = new ControladorClientes();
              $editarCliente -> ctrEditarCliente();
             ?>
      </div>

    </div>
  </div>
</div>
<!--=====================================
=            Section comment            =
======================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEliminarCliente">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Eliminar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="post">
                     <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-signature"></i></div>
                  </div>
                  <input type="hidden" value="" id="codigoCliente" name="codigoCliente" required>
                  <input type="text" class="form-control input-group-lg" name="razonCliente" id="razonCliente" readonly>
                </div>
            </div>
              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Realizar cambios</button>
            </div>

        </form>
        <?php
              $editarProveedor = new ControladorClientes();
              $editarProveedor -> ctrEliminarCliente();
             ?>
      </div>

    </div>
  </div>
</div>


<!--====  End of Section comment  ====-->