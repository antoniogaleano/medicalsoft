  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar categorias</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Categorias</li>
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
           <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar categoria
           </button>
        <!-- <div style="margin-top: 5px; margin-bottom: 5px;"></div> -->
        <hr>
            <!-- <table  class="table table-bordered table-striped dt-responsive tablas"> -->
              <table   class="table table-striped table-bordered dt-responsive nowrap tablas" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $item = null;
                  $valor = null;
                  $categorias = ControladorCategorias::ctrMostrarCategoria($item, $valor);
                  //var_dump($categorias);
                  foreach ($categorias as $key => $value) {
                    echo '<tr>
                              <td>'.($key+1).'</td>
                              <td>'.$value["categoria"].'</td>
                              <td>  <div class="btn-group-xs">
                                <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'"  data-toggle="modal" data-target="#modalEditarCategoria"><i class="far fa-edit"></i></button>

                                <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'" ><i class="far fa-trash-alt"></i></button>
                                <button class="btn btn-primary btnImprimirCategoria" idCategoria="'.$value["id"].'" ><i class="fas fa-print"></i></button>
                              </div></td>
                          </tr>';
                  }
                   ?>

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
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarCategoria">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Agregar Categoria</h5>
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
                    <div class="input-group-text"><i class="fas fa-layer-group"></i></div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Ingresar Categoria" required name="nuevaCategoria">
                </div>
            </div>
              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <?php
              $crearCategoria = new ControladorCategorias();
              $crearCategoria -> ctrCrearCategoria();
             ?>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- EDITAR CATEGORIA -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarCategoria">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4d4d4d; color: white;">
        <h5 class="modal-title">Editar Categoria</h5>
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
                    <div class="input-group-text"><i class="fas fa-layer-group"></i></div>
                  </div>
                  <input type="hidden" class="form-control"  name="idCategoria" id="idCategoria">
                  <input type="text" class="form-control"  name="editarCategoria" id="editarCategoria" required>
                </div>
            </div>
              <!-- botones -->
             <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
            <?php
            /*ejecutar una vez este listo el ajax para persisir en la bd*/
              $editarCategoria = new ControladorCategorias();
              $editarCategoria -> ctrEditarCategoria();
             ?>
        </form>
      </div>

    </div>
  </div>
</div>
<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>