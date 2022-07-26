<?php
// $dir = "index.php?ruta=";
  session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="" href="vistas/img/tiendaico.ico">
  <title>Mi tienda</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

 <!-- DataTables -->

  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <!-- EDITOR -->
  <link rel="stylesheet" href="vistas/css/editor.css">

  <!--WYSYNH-->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
<!-- iCheck for checkboxes and radio inputs -->
 <!--  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 -->
  <!-- daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">

    <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="vistas/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="vistas/plugins/timepicker/bootstrap-timepicker.min.css">

  <!-- jQuery -->
<!-- <script src="vistas/plugins/jquery/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/js/adminlte.min.js"></script>
<!-- DATA TABLE -->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- SWEET ALERT 2 -->
<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>

<!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>
<!-- InputMask -->
<script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
<script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script src="vistas/plugins/jqueryNumber/jquery.number.min.js"></script>
<!-- InputMask -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- ChartJS -->
<!-- <script src="vistas/plugins/chart.js/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script> -->
<!-- https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js -->
<!-- <script src="vistas/plugins/chart.js/Chart.min.js"></script> -->
<!-- EDITOR -->
<!-- <script src="vistas/js/editor.js"></script> -->

<!-- Tempusdominus Bootstrap 4 -->
<script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- bootstrap datepicker -->
<script src="vistas/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="vistas/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.es-es.js" type="text/javascript"></script>

<style type="text/css">
  #nuevoCambioEfectivo{
    height: 100px;
    width: 100%;
    background-color: green;
    color: white;
    text-align: center;
    font-size: 70px;
    font-weight: bold;
  }
</style>
</head>
<!-- <body class="hold-transition sidebar-mini"> -->
  <?php
if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
  echo '<body class="hold-transition sidebar-mini sidebar-collapse text-sm">';
}else{
 echo '<body class="hold-transition sidebar-mini sidebar-collapse login-page">';

}
   ?>


  <?php
   if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
        echo '<div class="wrapper">';
                include "modulos/navbar.php";
                include "modulos/menu.php";

                if (isset($_GET["ruta"])) {
                    if ($_GET["ruta"] == "inicio"||
                      $_GET["ruta"] == "usuario"||
                      $_GET["ruta"] == "categorias"||
                      $_GET["ruta"] == "notas"||
                      $_GET["ruta"] == "productos"||
                      $_GET["ruta"] == "clientes"||
                      $_GET["ruta"] == "ventas"||
                      $_GET["ruta"] == "crear-venta"||
                      $_GET["ruta"] == "editar-venta"||
                      $_GET["ruta"] == "reportes"||
                      $_GET["ruta"] == "compras"||
                      $_GET["ruta"] == "proveedores"||
                      $_GET["ruta"] == "crear-compra"||
                      $_GET["ruta"] == "editar-compra"||
                      $_GET["ruta"] == "empresa"||
                      $_GET["ruta"] == "historial"||
                      $_GET["ruta"] == "historial-editar"||
                      $_GET["ruta"] == "consultas"||
                      $_GET["ruta"] == "salir"
                    ) {
                      include "modulos/".$_GET["ruta"].".php";
                    }else{
                    include "modulos/404.php";
                    }
                }else{
              include "modulos/inicio.php";
                }

        include "modulos/footer.php";
        echo '</div>';
      }else{
        include "modulos/login.php";
      }
   ?>
</div>
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/textos.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/ventadetalle.js"></script>
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/proveedores.js"></script>
<script src="vistas/js/compras.js"></script>
<script src="vistas/js/compras.detalle.js"></script>
<script src="vistas/js/empresa.js"></script>
<script src="vistas/js/editar-venta.js"></script>
<script src="vistas/js/historial.js"></script>
</body>
</html>
