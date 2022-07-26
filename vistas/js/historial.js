//$('.tablas').DataTables();

    var tableHistorial = $(".tblHistorial").DataTable({
        "columnDefs": [
                {
                "targets": -2,
                "visible": false
                }],
                "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
    })

$('.tblHistorial tbody').on( 'click', 'button.btnMostrarHistorial', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableHistorial.row( $(this).parents('tr') ).data();
         }else{
            var data = tableHistorial.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log(data["3"]);
          window.open("extensiones/tcpdf/pdf/historial.php?id="+data[3],  "_blank");
});


 $('#chk_monofocal').on('change',function(event){
   // Si el checkbox esta "checkeado"
   if($('#chk_monofocal').is(':checked')){
   	$("#monofocal").val("true");
   // En caso contrario..
   } else {
		$("#monofocal").val("false");
   }
});
  $('#chk_bifocal').on('change',function(event){
   // Si el checkbox esta "checkeado"
   if($('#chk_bifocal').is(':checked')){
   	$("#bifocal").val("true");
   // En caso contrario..
   } else {
		$("#bifocal").val("false");
   }
});
    $('#chk_progresivo').on('change',function(event){
   // Si el checkbox esta "checkeado"
   if($('#chk_progresivo').is(':checked')){
   	$("#progresivo").val("true");
   // En caso contrario..
   } else {
		$("#progresivo").val("false");
   }
});
 //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showMeridian: false
    })
$('.tblHistorial tbody').on( 'click', 'button.btnEliminarHistorial', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableHistorial.row( $(this).parents('tr') ).data();
         }else{
            var data = tableHistorial.row( $(this).parents('tbody tr ul li') ).data();
         }

         Swal.fire({
                  title: 'Estas seguro de eliminar el registro?',
                  text: "No podras recuperar una vez eliminado!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Deseo Borrar!'
                }).then((result) => {
                  if (result.value) {
                    console.log("eliminar");
                  var idHistorial = data["3"];
                  var datos = new FormData();
                  datos.append("idHistorial",idHistorial);
                   $.ajax({
                              url : "ajax/historial.ajax.php",
                              method : "POST",
                              data : datos,
                              cache :false,
                              contentType :false,
                              processData: false,
                              dataType: "json",
                              success:function(respuesta){
                                  // console.log("respuesta dad ",respuesta);
                                   Swal.fire(
                                          'Eliminado!',
                                          'El registro a sido eliminado',
                                          'success'
                                        )
                                   window.location = 'consultas';
                              }
                          })


                  }
                })

          // window.open("extensiones/tcpdf/pdf/historial.php?id="+data[3],  "_blank");
});
// btnEditarHistorial
$('.tblHistorial tbody').on( 'click', 'button.btnEditarHistorial', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableHistorial.row( $(this).parents('tr') ).data();
         }else{
            var data = tableHistorial.row( $(this).parents('tbody tr ul li') ).data();
         }
          console.log(data["3"]);
// $('#editarMotivo').val("Hola");
         window.location = "index.php?ruta=historial-editar&codigo="+data[3];

});
//*editar**/
 $('#editar_chk_monofocal').on('change',function(event){
   // Si el checkbox esta "checkeado"
   if($('#editar_chk_monofocal').is(':checked')){
    $("#monofocal").val("true");
   // En caso contrario..
   } else {
    $("#monofocal").val("false");
   }
});
  $('#editar_chk_bifocal').on('change',function(event){
   // Si el checkbox esta "checkeado"
   if($('#editar_chk_bifocal').is(':checked')){
    $("#bifocal").val("true");
   // En caso contrario..
   } else {
    $("#bifocal").val("false");
   }
});
    $('#editar_chk_progresivo').on('change',function(event){
   // Si el checkbox esta "checkeado"
   if($('#editar_chk_progresivo').is(':checked')){
    $("#progresivo").val("true");
   // En caso contrario..
   } else {
    $("#progresivo").val("false");
   }
});

    $('.tblHistorial tbody').on( 'click', 'button.btnEditarConsultas', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableHistorial.row( $(this).parents('tr') ).data();
         }else{
            var data = tableHistorial.row( $(this).parents('tbody tr ul li') ).data();
         }
          console.log(data["5"]);
          window.location = "index.php?ruta=historial-editar&codigo="+data[5];

});

    $('.tblHistorial tbody').on( 'click', 'button.btnEliminarConsultas', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableHistorial.row( $(this).parents('tr') ).data();
         }else{
            var data = tableHistorial.row( $(this).parents('tbody tr ul li') ).data();
         }

         Swal.fire({
                  title: 'Estas seguro de eliminar el registro?',
                  text: "No podras recuperar una vez eliminado!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Deseo Borrar!'
                }).then((result) => {
                  if (result.value) {
                    console.log("eliminar");
                  var idHistorial = data["5"];
                  var datos = new FormData();
                  datos.append("idHistorial",idHistorial);
                   $.ajax({
                              url : "ajax/historial.ajax.php",
                              method : "POST",
                              data : datos,
                              cache :false,
                              contentType :false,
                              processData: false,
                              dataType: "json",
                              success:function(respuesta){
                                  // console.log("respuesta dad ",respuesta);
                                   Swal.fire(
                                          'Eliminado!',
                                          'El registro a sido eliminado',
                                          'success'
                                        )
                                   window.location = 'consultas';
                              }
                          })


                  }
                })

          // window.open("extensiones/tcpdf/pdf/historial.php?id="+data[3],  "_blank");
});
    $('.tblHistorial tbody').on( 'click', 'button.btnMostrarConsultas', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableHistorial.row( $(this).parents('tr') ).data();
         }else{
            var data = tableHistorial.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log(data["3"]);
          window.open("extensiones/tcpdf/pdf/historial.php?id="+data[5],  "_blank");
});

     $('#editarRegistro').datepicker({
        format: 'dd/mm/yyyy',
        locale: 'es-es',
        uiLibrary: 'bootstrap4'
        });
      $('#editarRetiro').datepicker({
        format: 'dd/mm/yyyy',
        locale: 'es-es',
        uiLibrary: 'bootstrap4'
        });
 $('#nuevoRegistro').datepicker({
        format: 'dd/mm/yyyy',
        locale: 'es-es',
        uiLibrary: 'bootstrap4'
        });
$('#nuevoRetiro').datepicker({
        format: 'dd/mm/yyyy',
        locale: 'es-es',
        uiLibrary: 'bootstrap4'
        });

// editarTotal
$("#editarTotal").change(function(){
  var total = $("#editarTotal").val();
  var entrega = $("#editarEntrega").val();
  var saldo = Number(total) - Number(entrega);
  $('#editarSaldo').val(saldo);
  console.log( total - entrega  );
});
$("#editarEntrega").change(function(){
  var total = $("#editarTotal").val();
  var entrega = $("#editarEntrega").val();
  var saldo = Number(total) - Number(entrega);
  $('#editarSaldo').val(saldo);
  console.log( total - entrega  );
});

$("#nuevoTotal").change(function(){
  var total = $("#nuevoTotal").val();
  var entrega = $("#nuevaEntrega").val();
  var saldo = Number(total) - Number(entrega);
  $('#nuevoSaldo').val(saldo);

});
$("#nuevaEntrega").change(function(){
    var total = $("#nuevoTotal").val();
  var entrega = $("#nuevaEntrega").val();
  var saldo = Number(total) - Number(entrega);
  $('#nuevoSaldo').val(saldo);

});