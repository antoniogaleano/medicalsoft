  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Historial</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Historial</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
           <div class="col-md-5">
            <!-- Line chart -->
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Pacientes atendidos
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">
                         <table id="tablaPaciente" class="table table-striped table-bordered  dt-responsive nowrap tablaPaciente" style="width:100%">
                            <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Position</th>
                                      <th>Office</th>
                                      <th>Age</th>
                                      <th>Start date</th>
                                      <th>Salary</th>
                                  </tr>
                              </thead>
                              <tbody>
                                      <tr>
                                          <td>Tiger Nixon</td>
                                          <td>System Architect</td>
                                          <td>Edinburgh</td>
                                          <td>61</td>
                                          <td>2011/04/25</td>
                                          <td>$320,800</td>
                                      </tr>
                                      <tr>
                                          <td>Garrett Winters</td>
                                          <td>Accountant</td>
                                          <td>Tokyo</td>
                                          <td>63</td>
                                          <td>2011/07/25</td>
                                          <td>$170,750</td>
                                      </tr>
                                      <tr>
                                          <td>Ashton Cox</td>
                                          <td>Junior Technical Author</td>
                                          <td>San Francisco</td>
                                          <td>66</td>
                                          <td>2009/01/12</td>
                                          <td>$86,000</td>
                                      </tr>
                              </tbody>
                     </table>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->



          </div>



            <div class="col-md-7">
              <div class="card card-outline card-info">
                <div class="card-header">

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pad">
                  <div class="mb-3">
                 <select>
                   <option>Antonio Galeano</option>
                   <option>Maximiliano Cardozo</option>
                 </select>
                              <form method="post">
                                <textarea class="textarea" id="summernote" name="editordata"></textarea>
                                <button class="btn btn-warning btn-lg btnProbar" type="button">Recuperar</button>
                                <button class="btn btn-info btn-lg btnEnviar" type="button">Enviar</button>
                                <button class="btn btn-tool btn-lg btnReset" type="button">Reset</button>
                              </form>
                  </div>

              <!--     <p class="text-sm mb-0">
                    Editor <a href="https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg">Documentation and license
                    information.</a>
                  </p> -->
                </div>
              </div>
            </div>

      </div>
    </section>
    <!-- /.content -->
  </div>
