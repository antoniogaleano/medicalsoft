 <?php
 $item = "usuario";
 $valor = $_SESSION["id"];
 $traeCaja = ControladorVentas::ctrMostrarCaja($item, $valor);
 // var_dump($traeCaja);
 $sucursal = $traeCaja["sucursal"];
 $caja = $traeCaja["caja"];
 $nroConsecutivo = $traeCaja["inicia"];
 // $factura = $sucursal."-".$caja."-".str_pad($facturainicial, 7, "0000000", STR_PAD_LEFT);

  ?>
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
              <li class="breadcrumb-item"><a href="ventas">Planilla de venta</a></li>
              <li class="breadcrumb-item active">Ventas</li>
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

                  <div class="form-group">
                    <!-- ENTRADA VENDEDOR -->
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $_SESSION['nombre'];?>" id="nuevoVendedor"   readonly>
                      <input type="hidden" name="idVendedor" value="<?php echo $_SESSION['id'];?>" >
                    </div>
                  </div>
                    <!-- ENTRADA FACTURA -->
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <?php
                      $item = null;
                      $valor = null;
                        $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                         $codigo = intval($nroConsecutivo) +intval(1) ;
                        $nroFactura = $sucursal."-".$caja."-".str_pad($codigo, 7, "0000000", STR_PAD_LEFT);
                        // echo "Numero ".$nroFactura;

                        if (!$ventas) {
                          echo '<input type="text" class="form-control"  value="'.$nroFactura.'">';
                          echo '<input type="hidden" class="form-control" value="'.$nroFactura.'" id="nuevaVenta" name="nuevaVenta">';
                        }else{
                          foreach ($ventas as $key => $value) {

                          }

                          echo '<input type="text" class="form-control" value="'.$nroFactura.'">';
                           echo '<input type="hidden" class="form-control" value="'.$nroFactura.'" id="nuevaVenta" name="nuevaVenta" readonly required>';
                        }
                       ?>
                   <!--    <input type="text" class="form-control" value="" id="nuevaVenta" name="nuevaVenta"> -->
                    </div>
                  </div>
                    <!-- ENTRADA CLIENTE -->
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" style="padding-right: 4px;" required>
                          <option>Seleccionar cliente</option>
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
                                        <input type="number" class="form-control" value="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta">
                                        <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                                        <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                                      </div>
                                    </td>
                                    <td style="width: 50%">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" readonly>
                                        <input type="hidden" name="totalVenta" id="totalVenta">
                                      </div>
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <hr>
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
                    <button type="submit" class="btn btn-primary pull-right" id="btnGrabarVenta">Guardar venta</button>
                  </div>
                  </form>
                  <?php
                    $crearVenta = new ControladorVentas();
                    $crearVenta -> ctrCrearVenta();
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
                  <input type="text" min="0" class="form-control input-group-lg"  placeholder="Ingresar documento" name="nuevoDocumentoId"  required>
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