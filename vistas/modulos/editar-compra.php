 <?php include "funciones.php" ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compras</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item"><a href="compras">Planilla compras</a></li>
              <li class="breadcrumb-item active">Compras</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="content">
     <div class="row">
      <!-- FORMULARIO -->
        <div class="col-lg-6 col-xs-12">
            <div class="card card-primary card-outline">
              <form method="post"  role="form" class="formularioEditarCompra">
               <div class="card-body">

                  <div class="form-group">
                    <!-- ENTRADA VENDEDOR -->
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $_SESSION['nombre'];?>" id="nuevoVendedor"   readonly>
                      <input type="hidden" name="idVendedor" value="<?php echo $_SESSION['id'];?>">
                    </div>
                  </div>

                    <!-- ENTRADA PROVEEDOR -->
                    <?php
                      if ($_GET["idCompra"]) {
                        echo '<input type="hidden" name="editarCompra" value="'.$_GET["idCompra"].'">';
                        /*COMPRAS POR ID*/
                        $item = "id_compra";
                        $valor = $_GET["idCompra"];
                        $compra = ControladorCompras::ctrMostrarCompra($item, $valor);
                        $fecha = fechaNormal($compra["fecha"]);
                        $vencimiento = fechaNormal($compra["vencimiento"]);
                        // echo "PROVEEDOR ". $compra["id_proveedor"];
                        /*DATOS DEL PROVEEDOR*/
                        $itemProv = "id_proveedor";
                        $valorProv = $compra["id_proveedor"];
                        $traerProveedor = ControladorProveedor::crtMostrarProveedores($itemProv, $valorProv);
                        // var_dump($traerProveedor);

                      }
                     ?>
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required style="padding-right: 4px;">
                          <option value="<?php echo $traerProveedor["id_proveedor"]?>"><?php echo $traerProveedor["razon_social"]?></option>
                          <?php
                            $item = null;
                            $valor = null;
                            $clientes = ControladorProveedor::crtMostrarProveedores($item, $valor);
                            foreach ($clientes as $key => $value) {
                              echo '<option value="'.$value["id_proveedor"].'">'.$value["razon_social"].'</option>';
                            }
                           ?>

                        </select>
                        <span class="input-group-addon"> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalAgregarProveedor" data-dismiss="modal">Agregar</button></span>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col">
                        <!-- <input type="text" class="form-control" placeholder="Nro. Factura"> -->
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                          </div>
                          <input type="text" class="form-control input-group-lg"  value="<?php echo $fecha?>" name="nuevaFecha" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                        </div>
                      </div>
                      <div class="col">
                        <!-- <input type="text" class="form-control" placeholder="Fecha"> -->
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fab fa-creative-commons-zero"></i></div>
                          </div>
                          <input type="text" class="form-control input-group-lg"  value="<?php echo $compra["factura"]?>" name="nuevaFactura" data-inputmask="'mask':'999-999-9999999'" data-mask required>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                      <div class="col">
                        <!-- <input type="text" class="form-control" placeholder="Nro. Factura"> -->
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar-times"></i></div>
                          </div>
                          <input type="text" class="form-control input-group-lg"  value="<?php echo $vencimiento?>" name="nuevoVencimiento" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                            <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                            <select class="form-control" id="nuevoTipo" name="nuevoTipo">
                              <?php

                               if ($compra["tipo"] == "CONTADO") {
                                  echo '<option value="CONTADO" selected>CONTADO</option>';
                                  echo '<option value="CREDITO">CREDITO</option>';
                                }else{
                                  echo '<option value="CONTADO">CONTADO</option>';
                                  echo '<option value="CREDITO" selected>CREDITO</option>';
                                }

                               ?>
                             </select>
                          </div>
                      </div>
                    </div>

                  <!-- ENTRADA PARA PRODUCTOS -->
                      <div class="form-group nuevoProductoCompra">
                        <?php
                        $listaProducto = json_decode($compra["productos"], true);
                        // var_dump($listaProducto);
                        foreach ($listaProducto as $key => $value) {
                          # code...
                        echo '<div class="row">
                          <div class="col-5">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><button class="btn  btn-sm btn-danger quitarProductoCompra " idProductoCompra="'.$value["id"].'"><i class="far fa-trash-alt"></i></button></span>
                                </div>
                                <input type="text" class="form-control  nuevaDescripcionProducto" idProductoCompra="'.$value["id"].'" name="agregarProductoCompra" value="'.$value["descripcion"].'" readonly>
                              </div>
                          </div>
                          <div class="col">
                            <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'"   required>
                          </div>
                          <div class="col ingresoImpuesto">
                            <input type="number" class="form-control nuevoIva"  name="nuevoIva" value="'.$value["impuesto"].'" required>
                          </div>
                          <div class="col-3 ingresoPrecio">
                            <input type="number" class="form-control nuevoPrecioProducto"  name="nuevoPrecioProducto" value="'.$value["precioUnt"].'"  precioReal="'.$value["precioUnt"].'" precioUnitario="0" required>
                          </div>
                         </div>';
                         }
                         ?>


                      </div>
                      <input type="hidden" name="listaProductosCompras" id="listaProductosCompras">
                  <!-- FIN ENTRADA PARA PRODUCTOS -->
                        <button type="button" class="btn btn-default d-lg-none btnAgregarProducto">Agregar Productos</button>

                      <div class="row">

                      <div class="col">
                      <p>Total</p>
                        <div class="input-group mb-2">

                          <div class="input-group-prepend">

                           <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                           </div>
                           <input type="text" class="form-control" value="0" id="nuevoTotalCompra" name="nuevoTotalCompra" total="" readonly>
                           <input type="hidden" name="totalCompra" id="totalCompra">
                        </div>
                      </div>
                      <div class="col">

                        <div class="input-group mb-2">

                        </div>
                      </div>
                    </div>

                        <hr>

                        <!-- METODO DE PAGO -->

                         <div class="row">
                          <div class="col">
                             <div class="input-group">

                            <!--   <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                <option value="">Seleccione método de pago</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="TC">Cheque</option>
                               </select> -->
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
                    $editarCompra = new ControladorCompras();
                    $editarCompra -> ctrEditarCompra();
                   ?>
            </div>

        </div>
          <!--TABLA PRODUCTOS -->
        <!-- <div class="col-lg-7 hidden-md hidden-sm hidden-xs"> -->
          <!-- <div class="col-lg-7 d-none .d-lg-block .d-xl-none"> -->

          <div class="col-lg-6  d-none d-lg-block d-print-block">

          <div class="card card-warning card-outline">
            <div class="card-body">
            <table class="table table-striped table-bordered tablaCompras">
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
<script type="text/javascript">

      var precioItem = $(".nuevoPrecioProducto");
      var arraySumarPrecio = [];
      for (var i = 0; i < precioItem.length; i++ ) {
          arraySumarPrecio.push(Number($(precioItem[i]).val()));

      }
      // console.log("array ",arraySumarPrecio );
        function sumaArrayPreciosCompra(total, numero){
            return   total + numero;
        }
        var sumaTotalPrecio = arraySumarPrecio.reduce(sumaArrayPreciosCompra);


        $("#nuevoTotalCompra").val(sumaTotalPrecio);
        $("#totalCompra").val(sumaTotalPrecio);
        $("#nuevoTotalCompra").attr("total",sumaTotalPrecio);
      $('#nuevoTotalCompra').number( true, 2);

</script>