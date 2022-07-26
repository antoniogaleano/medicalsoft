<?php
error_reporting(0);
 if (isset($_GET["fechaInicial"])) {
    // error_reporting(0);
       $fechaInicial = $_GET["fechaInicial"];
       $fechaFinal = $_GET["fechaFinal"];
      }else{
       $fechaInicial = null;
       $fechaFinal = null;
      }
  $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
  $arrayFechas = array();
  $arrayVentas = array();
  $sumaPagoMes = array();
  foreach ($respuesta as $key => $value) {
    $fecha = substr($value["fecha"],0,7);
    array_push($arrayFechas, $fecha);
    /*Captura de las ventas*/
    $arrayVentas = array($fecha => $value["total"]);
    /*sumar pago*/
    foreach ($arrayVentas as $key => $value) {
      $sumaPagoMes[$key] += $value;
    }

  }
 // var_dump($sumaPagoMes);
  $noRepetirFechas = array_unique($arrayFechas);
  // var_dump($noRepetirFechas);
  ?>

 <div class="col">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Gráfico ventas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="line-chart" style="height: 350px"></canvas>


              </div>
              <!-- /.card-body -->
            </div>

  </div>

  <script type="text/javascript">

new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: [
      <?php
      if ($noRepetirFechas != null) {
        foreach ($noRepetirFechas as $key) {
          echo "'$key',";
        }
          echo "'$key'";
        }else{
          "N/A";
        }

      ?>
     ],


    datasets: [{

         data: [
         <?php
         if ($noRepetirFechas != null) {
            foreach ($noRepetirFechas as $key) {
            echo $sumaPagoMes[$key].",";
          }
            echo $sumaPagoMes[$key];
         }else{
            0;
         }

      ?>
         ],
        label: " Ventas",
        borderColor: "#3e95cd",
        fill: true
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Historico'
    }
  }
});

  </script>