  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
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
        <div style="margin-top: 5px; margin-bottom: 5px;"></div>
            <!-- <table  class="table table-bordered table-striped dt-responsive tablas"> -->
              <table   class="table table-striped table-bordered dt-responsive nowrap tablas" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Dirección</th>
                  <th>Fecha nacimiento</th>
                  <th>Total compras</th>
                  <th>Ingreso Sist.</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                  <td>1</td>
                  <td>Antonio Galeano</td>
                  <td>3518733</td>
                  <td>galeanoantonio6@gmail.com</td>
                  <td>0983386288</td>
                  <td>3 de mayo luque</td>
                  <td>17/01/1982</td>
                  <td>0</td>
                  <td>03/05/2020</td>

                  <td>
                    <div class="btn-group-xs">
                      <button class="btn btn-warning"><i class="far fa-edit"></i></button>
                      <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </div>
                  </td>
                </tr>

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
                  <input type="text" class="form-control input-group-lg"  placeholder="Ingresar nombre" name="nuevaCliente"  required>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                  </div>
                  <input type="number" min="0" class="form-control input-group-lg"  placeholder="Ingresar documento" name="nuevaDocumentoId"  required>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-envelope"></i></div>
                  </div>
                  <input type="email" class="form-control input-group-lg"  placeholder="Ingresar correo" name="nuevaEmail" required>
                </div>
            </div>
            <!-- ENTRADA PARA TELEFONO CON IMASK -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-phone"></i></div>
                  </div>
                  <input type="text" class="form-control input-group-lg"  placeholder="Ingresar telefono" name="nuevaTelefono" data-inputmask="'mask':'(9999)999-999'" data-mask required>
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
      </div>

    </div>
  </div>
</div>