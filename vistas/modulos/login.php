<div class="back"></div>
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
    <img src="vistas/img/tiendalogo.png" class="img-responsive" style="padding:30px 100px 0px 100px">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body ">
      <p class="login-box-msg">Iniciar sessión</p>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->

        </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();

      ?>
      </form>
      <div class="row">
          <div class="col-12">
            <!-- <a href="https://api.whatsapp.com/send?phone=595983386288&amp;text= Hola! solicitando un soporte para el sistema medico !medico " target="_blank">Solicitar Soporte</a> -->


        </div>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
