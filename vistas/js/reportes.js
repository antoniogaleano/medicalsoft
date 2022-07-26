/*===============================================
=            LOCAL STORAGE           =
===============================================*/
if (localStorage.getItem("capturarRango2") != null) {
    // alert(localStorage.getItem("capturarRango"));
     $('#reportrange2 span').html(localStorage.getItem("capturarRango2"));
}

$(function() {
var start = moment().subtract(29, 'days');
    // var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange2 span').html(start.format('YYYY') + ' - ' + end.format('YYYY'));
       var capturarRango2 = $('#reportrange2 span').html();
       // console.log("rango",rango);
       var fechaInicial = start.format('YYYY-MM-DD');
       var fechaFinal = end.format('YYYY-MM-DD');
       console.log("periodo2 ", fechaInicial+" "+fechaFinal);
         localStorage.setItem("capturarRango2", capturarRango2);
        window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
        console.log(localStorage.getItem("capturarRango2"));
    }

    $('#reportrange2').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
           'Mes actual': [moment().startOf('month'), moment().endOf('month')],
           'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    // cb(start, end);

});
