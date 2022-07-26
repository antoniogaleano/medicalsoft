  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
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
        <div style="margin-top: 5px; margin-bottom: 5px;"></div>
            <!-- <table  class="table table-bordered table-striped dt-responsive tablas"> -->
              <table   class="table table-striped table-bordered dt-responsive nowrap tablas" style="width:100%">
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
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $item = null;
                  $valor = null;
                  $productos = ControladorProductos::crtMostrarProductos($item, $valor);
                  // var_dump($productos);
                  foreach ($productos as $key => $value) {
                          echo  '<tr>
                  <td>'.($key+1).'</td>
                  <td><img src="vistas/img/productos/default/anonymous.png" class="thumbnail" width="40px"></td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["descripcion"].'</td>';
                    $item = "id";
                    $valor =$value["id_categoria"];
                    $categorias = ControladorCategorias::ctrMostrarCategoria($item, $valor);

                  echo '<td>'.$categorias["categoria"].'</td>
                  <td>'.$value["stock"].'</td>
                  <td>'.$value["precio_compra"].'</td>
                  <td>'.$value["precio_venta"].'</td>
                  <td>'.$value["fecha"].'</td>
                  <td>
                    <div class="btn-group-xs">
                      <button class="btn btn-warning"><i class="far fa-edit"></i></button>
                      <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </div>
                  </td>
                </tr>';
                  }
                 ?>

                  <tr>
                  <td>1</td>
                  <td><img src="vistas/img/productos/default/anonymous.png" class="thumbnail" width="40px"></td>
                  <td>0001</td>
                  <td>Lorem ipsum dolor sit amet..</td>
                  <td>Lorem ipsum</td>
                  <td>20</td>
                  <td>5.00</td>
                  <td>10.00</td>
                  <td>14/04/2020 15:00</td>
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
          <!-- CODIGO -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-code"></i></div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Ingresar código" required name="nuevoCodigo">
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
            <!-- CATEGORIA -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
                <!--   <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Ingresar descripción" required name="nuevaDescripcion"> -->
            </div>
            </div>
            <!-- FIN CATEGORIA -->
            <!-- STOCK -->
            <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-list-alt"></i></div>
                  </div>
                  <input type="text" class="form-control"  placeholder="Stock" required name="nuevaDescripcion">
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
                        <input type="numeric" class="form-control" placeholder="Precio compra" required name="nuevoPrecioCompra">
                    </div>

                  </div>
                  <div class="col-6">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-arrow-down"></i></div>
                        </div>
                        <input type="numeric" class="form-control"  placeholder="Precio venta" required name="nuevoPrecioVenta">
                    </div>
                  <!-- Check box-->
                    <div class="col-6">
                        <div class="form-group">
                          <label>
                            <input type="checkbox"  class="minimal" name="" >
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
                    <input type="file" id="nuevaImagen" name="nuevaImagen">
                    <p class="help-block">Subir maximo 2Mb.</p>
                    <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">
                  </div>
              <!-- botones -->

             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>