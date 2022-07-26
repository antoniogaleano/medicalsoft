  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar venta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item"><a href="ventas">Planilla</a></li>
              <li class="breadcrumb-item active">Editar venta</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="content">
     <div class="row">
      <!-- FORMULARIO -->
        <div class="col-lg-5 col-xs-12">
            <div class="card card-primary card-outline">
              <form method="post"  role="form" class="formularioVenta">
               <div class="card-body">
                 <?php
                      $item = "id";
                      $valor = $_GET["idVenta"];
                      $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                      $itemUsuario = "id";
                      $valorUsuario = $venta["id_vendedor"];
                      $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                      $itemCliente = "id";
                      $valorCliente = $venta["id_cliente"];
                      $cliente = ControladorClientes::crtMostrarClientes($itemCliente, $valorCliente);
                      $pocentajeImpuesto = $venta["impuesto"] * 100/ $venta["neto"];
                        // var_dump($venta);
                  ?>
                  <div class="form-group">
                    <!-- ENTRADA VENDEDOR -->
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $vendedor['nombre'];?>" id="nuevoVendedor"   readonly>
                      <input type="hidden" name="idVendedor" value="<?php echo $vendedor['id'];?>" >
                    </div>
                  </div>
                    <!-- ENTRADA FACTURA -->
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $venta['codigo'];?>" id="nuevaVenta" name="editarVenta" readonly required>
                    </div>
                  </div>
                    <!-- ENTRADA CLIENTE -->
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required style="padding-right: 4px;">
                          <option value="<?php echo $cliente['id'];?>"><?php echo $cliente['nombre'];?></option>
                          <?php
                            $item = null;
                            $valor = null;
                            $clientes = ControladorClientes::crtMostrarClientes($item, $valor);
                            foreach ($clientes as $key => $value) {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            }
                           ?>

                        </select>
                        <span class="input-group-addon"> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar</button></span>
                    </div>
                  </div>
                  <!-- ENTRADA PARA PRODUCTOS -->
                      <div class="form-group nuevoProducto">
                    <?php
                      $listaProducto = json_decode($venta["productos"], true);
                      // var_dump($listaProducto);
                      foreach ($listaProducto as $key => $value) {
                        $item = "id";
                        $valor = $value["id"];
                        $respuesta = ControladorProductos::crtMostrarProductos($item, $valor);
                        $stockAntiguo =  $respuesta["stock"] +   $value["cantidad"];

                        echo '<div class="row">
                          <div class="col-6">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><button class="btn  btn-sm btn-danger quitarProducto " idProducto="'.$value["id"].'"><i class="far fa-trash-alt"></i></button></span>
                                </div>
                                <input type="text" class="form-control  nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly>
                              </div>
                          </div>
                          <div class="col-3">
   <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1"
   value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
                          </div>
                          <div class="col-3 ingresoPrecio">
                            <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'"   name="nuevoPrecioProducto" value="'.$value["total"].'" required readonly>
                          </div>
                        </div>';
                      }
?>
                      </div>
                      <input type="hidden" name="listaProductos" id="listaProductos">
                  <!-- FIN ENTRADA PARA PRODUCTOS -->
                        <button type="button" class="btn btn-default d-lg-none btnAgregarProducto">Agregar Productos</button>
                        <!-- ENTRADA IMPUESTOS -->
                        <div class="row">
                          <div class="col-xs-8 pull-right">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Impuesto</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                    <td style="width: 50%">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                        <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $pocentajeImpuesto; ?>">
           <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>
            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>
                                      </div>
                                    </td>
                                    <td style="width: 50%">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" min="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" value="<?php echo $venta["total"]; ?>" readonly>
                                        <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $venta["neto"]; ?>">
                                      </div>
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <p>Medio de pago: <?php echo $venta["metodo_pago"]; ?></p>
                        <!-- METODO DE PAGO -->


                         <div class="row">
                          <div class="col">
                             <div class="input-group">

                              <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                <option value="">Seleccione método de pago</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="TC">Tarjeta Crédito</option>
                                <option value="TD">Tarjeta Débito</option>
                              </select>
                            </div>
                            </div>

                              <div class="cajasMetodoPago"></div>
                              <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                              </div>
               </div>
                  <div class="card-footer text-muted text-right">
                    <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
                  </div>
                  </form>
                  <?php
                    $editarVenta = new ControladorVentas();
                    $editarVenta -> ctrEditarVenta();
                   ?>
            </div>

        </div>
          <!--TABLA PRODUCTOS -->
        <!-- <div class="col-lg-7 hidden-md hidden-sm hidden-xs"> -->
          <!-- <div class="col-lg-7 d-none .d-lg-block .d-xl-none"> -->

          <div class="col-lg-7  d-none d-lg-block d-print-block">

          <div class="card card-warning card-outline">
            <div class="card-body">
            <table class="table table-striped table-bordered tablaVentas">
                <thead>
                    <tr>
                       <th style="width: 10px;">#</th>
                       <th style="width: 10px;">Imagen</th>
                        <th style="width: 10px;">Codigo</th>
                        <th>Descripcion</th>
                        <th style="width: 10px;">Stock</th>
                        <th style="width: 10px;">Barcode</th>
                        <th style="width: 10px;">Acciones</th>
                    </tr>
                </thead>

            </table>
            </div>
          </div>
        </div>


      </div>
    </div>
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
                  <input type="number" min="0" class="form-control input-group-lg"  placeholder="Ingresar documento" name="nuevoDocumentoId"  required>
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