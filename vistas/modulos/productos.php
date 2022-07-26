  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
           <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarProducto">Agregar Producto
           </button>
           <button class="btn btn-info btn-sm btnResumen">Resumen</button>
           <button class="btn btn-info btn-sm btnDetalle">Detalle</button>
        <!-- <div style="margin-top: 5px; margin-bottom: 5px;"></div> -->
        <hr>
            <!-- <table  class="table table-bordered table-striped dt-responsive tablas"> -->
              <table   class="table table-striped table-bordered dt-responsive  tablaProductos" style="width:100%">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Imagen</th>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Categoria</th>
                  <th>Stock</th>
                  <th>Precio Compra</th>
                  <th>Precio Venta</th>
                  <th>Agregado</th>
                  <th>Barcode</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarProducto">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="post" enctype="multipart/form-data">
            <!-- CATEGORIA -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="nuevaCategoria" name="nuevaCategoria" required>
                  <option selected="selected" >Seleccionar Categoria</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $categorias = ControladorCategorias::ctrMostrarCategoria($item, $valor);
                    foreach ($categorias as $key => $value) {
                       echo ' <option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                    }
                   ?>


                </select>
                <!--   <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Ingresar descripción" required name="nuevaDescripcion"> -->
            </div>
            </div>
            <!-- FIN CATEGORIA -->
          <!-- CODIGO -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-code"></i></div>
                  </div>
                  <input type="text" class="form-control" placeholder="Ingresar código" name="nuevoCodigo" id="nuevoCodigo" required  readonly="">
                </div>
            </div>
            <!-- DESCRIPCION -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <input type="text" class="form-control"  placeholder="Ingresar descripción" required name="nuevaDescripcion">
            </div>
            </div>
             <!-- BARCODE -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <input type="text" class="form-control"  placeholder="Codigo de barra"   name="nuevoCodigoBarra">
            </div>
            </div>

            <!-- STOCK -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <input type="text" class="form-control"  placeholder="Stock" required name="nuevoStock" id="nuevoStock">
            </div>
            </div>
             <!-- PRECIO COMPRA Y VENTA -->
            <div class="col-auto">
            <!-- <div class="card-body"> -->
                <div class="row">
                  <div class="col-6">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-arrow-up"></i></div>
                        </div>
                        <input type="numeric" class="form-control" placeholder="Precio compra" id="nuevoPrecioCompra" name="nuevoPrecioCompra" required>
                    </div>

                  </div>
                  <div class="col-6">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-arrow-down"></i></div>
                        </div>
                        <input type="numeric" class="form-control"  placeholder="Precio venta" id="nuevoPrecioVenta"  name="nuevoPrecioVenta" required>
                    </div>
                  <!-- Check box-->
                    <div class="col-6">
                        <div class="form-group">
                          <label>
                            <input type="checkbox"  class="minimal porcentaje" checked>
                            Utilizar porcentaje
                          </label>
                        </div>
                    </div>
                  <!-- Check box fin-->
                  <div class="col-6" style="padding: 0">
                      <div class="input-group">
                          <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                          <span class="input-group-addon"><i class="fas fa-percentage"></i></span>

                      </div>
                  </div>
                  </div>

                </div>

            </div>
            <!--FIN PRECIO COMPRA Y VENTA-->

            <!-- FOTO -->
                  <div class="col-auto">
                    <div class="panel">Subir Imagen</div>
                    <input type="file" class="nuevaImagen" name="nuevaImagen">
                    <p class="help-block">Subir maximo 2Mb.</p>
                    <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                  </div>
              <!-- botones -->

             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar Productos</button>
            </div>
        </form>
        <?php
              $crearProducto = new ControladorProductos();
              $crearProducto ->ctrCrearProducto();
         ?>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarProducto">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="post" enctype="multipart/form-data">
            <!-- CATEGORIA -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true"  name="editarCategoria" required readonly>
                  <option selected="selected" id="editarCategoria" >Seleccionar Categoria</option>



                </select>
                <!--   <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Ingresar descripción" required name="nuevaDescripcion"> -->
            </div>
            </div>
            <!-- FIN CATEGORIA -->
          <!-- CODIGO -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-code"></i></div>
                  </div>
                  <input type="text" class="form-control" name="editarCodigo" id="editarCodigo" required  readonly>
                </div>
            </div>
            <!-- DESCRIPCION -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <input type="text" class="form-control"   required name="editarDescripcion" id="editarDescripcion">
            </div>
            </div>
              <!-- EDITAR CODIGO DE BARRA -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <input type="text" class="form-control"   name="editarCodigoBarra" id="editarCodigoBarra">
            </div>
            </div>

            <!-- STOCK -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <input type="text" class="form-control" required name="editarStock" id="editarStock">
            </div>
            </div>
             <!-- PRECIO COMPRA Y VENTA -->
            <div class="col-auto">
            <!-- <div class="card-body"> -->
                <div class="row">
                  <div class="col-6">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-arrow-up"></i></div>
                        </div>
                        <input type="numeric" class="form-control" id="editarPrecioCompra" name="editarPrecioCompra" required>
                    </div>

                  </div>
                  <div class="col-6">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-arrow-down"></i></div>
                        </div>
                        <input type="numeric" class="form-control"    id="editarPrecioVenta"  name="editarPrecioVenta" min="0"  readonly  required>
                    </div>
                  <!-- Check box-->
                    <div class="col-6">
                        <div class="form-group">
                          <label>
                            <input type="checkbox"  class="minimal porcentaje" checked>
                            Utilizar porcentaje
                          </label>
                        </div>
                    </div>
                  <!-- Check box fin-->
                  <div class="col-6" style="padding: 0">
                      <div class="input-group">
                          <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                          <span class="input-group-addon"><i class="fas fa-percentage"></i></span>

                      </div>
                  </div>
                  </div>

                </div>

            </div>
            <!--FIN PRECIO COMPRA Y VENTA-->

            <!-- FOTO -->
                  <div class="col-auto">
                    <div class="panel">Subir Imagen</div>
                    <input type="file" class="nuevaImagen" name="editarImagen">
                    <p class="help-block">Subir maximo 2Mb.</p>
                    <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                    <input type="hidden" name="imagenActual" id="imagenActual">
                  </div>
              <!-- botones -->

             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
         <?php
              $editarProducto = new ControladorProductos();
              $editarProducto ->ctrEditarProducto();
         ?>
      </div>

    </div>
  </div>
</div>
 <?php
   $eliminarProducto = new ControladorProductos();
   $eliminarProducto ->ctrEliminarProducto();
 ?>