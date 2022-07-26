 $(function () {

    // Summernote
    $('.textarea').summernote({
    	placeholder: 'Ingrese aqui el detalle de la consulta',
    	 height: 200,

    });

    $(".btnProbar").click(function(){
    	var markupStr = '<h3>Paciente: </h3> <br><h5>Descripcion</h5><br>';
		$('#summernote').summernote('code', markupStr);
    })
     $(".btnEnviar").click(function(){
    	 var markupStr = $('#summernote').summernote('code');
    	 console.log(markupStr);
    })
      $(".btnReset").click(function(){
      	 $('#summernote').summernote('reset');
      })


    // $('.textarea').html('setText', ['<h3>Paciente: </h3> <br><h5>Descripcion</h5>']);
  })


//$('.textarea').summernote();
//$('.textarea').html('setText', ['<h3>Paciente: </h3> <br><h5>Descripcion</h5>']);
// $(document).ready(function(){
// 			$('#txt-content').Editor();
// // var texto = '<h1>Esto es un titulo</h1><br> <a href="https://www.w3schools.com">Visit W3Schools</a> <br> <img src="vistas/img/usuarios/ALANIS/342.jpg" alt="Smiley face" height="42" width="42"> ';
// 			$('#txt-content').Editor('setText', ['<h3>Paciente: </h3> <br><h5>Descripcion</h5>']);

// 			$('#btn-enviar').click(function(e){
// 				e.preventDefault();
// 			var texto =	$('#txt-content').text($('#txt-content').Editor('getText'));
// 				console.log($('#txt-content').Editor('getText'));
// 				//$('#frm-test').submit();
// 			});
// });

