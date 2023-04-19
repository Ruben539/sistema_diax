function aprobar(id){
	//return confirm("��Esta seguro de liberar el paciente?");
	
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"../Helpers/aprobar_cancelacion.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Cancelación realizada con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../Historial/Pedidos_Cancelacion.php";                          
					}
				})
				
			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Cancelar',                          
				});
			}
		}
	});
}


function aprobarCancelacion(id){
	Swal.fire({
		title: 'Desea Aprobar todas las Cancelación ?',
		text: "Seran Canceladas todas las ordenes!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Confirmar!'
	}).then((result) => {
		if (result.value) {
			aprobar(id);
		}
	})
}

function activarUsuario(id_usuario){
	cadena = "id_usuario=" + id_usuario;

	$.ajax({
		type:"POST",
		url:"Helpers/Activar_Usu.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Reestablecido con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "usuario";                          
					}
				})
				
			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Reestablecer',                          
				});	
			}
		}
	});
}

function activarDatos(id_usuario){
	Swal.fire({
		title: 'Desea Reestablecer el Usuario ?',
		text: "Reestablecer Usuario "+id_usuario+" del Sistema!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Reestablecer!'
	}).then((result) => {
		if (result.value) {
			activarUsuario(id_usuario);
		}
	})
}

