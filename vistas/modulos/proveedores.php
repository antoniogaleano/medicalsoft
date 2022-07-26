  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proveedores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Proveedores</li>
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
           <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">Agregar proveedor
           </button>
           <hr>
        <div style="margin-top: 5px; margin-bottom: 5px;"></div>
          <!--   <table   class="table table-striped table-bordered dt-responsive  tablaVentaDet" style="width:100%"> -->
              <table   class="table table-striped table-bordered dt-responsive tablaProveedor" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Razon Social</th>
                  <th style="width: 15px;">Ruc</th>
                  <th style="width: 150px;">Telefono</th>
                  <th>Dirección</th>
                  <th style="width: 150px;">Correo</th>
                  <!-- <th>Fecha nacimiento</th> -->
                  <th style="width: 15px;">Estado</th>
                  <th style="width: 15px;">Compras</th>
                  <th style="width: 100px;">Acciones</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarProveedor">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Agregar proveedor</h5>
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
                  <input type="text" class="form-control input-group-lg"  placeholder="Ingresar razon social" name="nuevoProveedor"  required>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                  </div>
                  <input type="text"   class="form-control input-group-lg"  placeholder="Ingresar Ruc" name="nuevoDocumentoId"  required>
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

              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar proveedor</button>
            </div>

        </form>
        <?php
              $crearProveedor = new ControladorProveedor();
              $crearProveedor -> ctrCrearProveedor();
             ?>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarProveedor">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Editar proveedor</h5>
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
                  <input type="hidden" value="" id="codigoProveedorEditar" name="codigoProveedorEditar">
                  <input type="text" class="form-control input-group-lg" name="editarProveedor" id="editarProveedor" required>
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

              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>

        </form>
        <?php
              $editarProveedor = new ControladorProveedor();
              $editarProveedor -> ctrEditarProveedor();
             ?>
      </div>

    </div>
  </div>
</div>
<!--=====================================
=            Section comment            =
======================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEliminarProveedor">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Eliminar proveedor</h5>
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
                  <input type="hidden" value="" id="codigoProveedorEliminar" name="codigoProveedorEliminar" required>
                  <input type="text" class="form-control input-group-lg" name="eliminarProveedor" id="eliminarProveedor" readonly>
                </div>
            </div>
              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Realizar cambios</button>
            </div>

        </form>
        <?php
              $editarProveedor = new ControladorProveedor();
              $editarProveedor -> ctrEliminarProveedor();
             ?>
      </div>

    </div>
  </div>
</div>


<!--====  End of Section comment  ====-->
