function liberarDoctor(id){
	//return confirm("��Esta seguro de liberar el paciente?");
	
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"../Helpers/liberar_doctor.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Solicitud realizada con exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../Plantillas/medicos.php";                          
					}
				})
				
			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Liberar',                          
				});
			}
		}
	});
}


function EliminarDoctor(id){
	Swal.fire({
		title: 'Desea solicitar la eliminacion del Doctor ?',
		text: "Con  Nro "+id+" de registro!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Confirmar!'
	}).then((result) => {
		if (result.value) {
			liberarDoctor(id);
		}
	})
}


function BajaDoctor(id){
	//return confirm("��Esta seguro de liberar el paciente?");
	
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"../Helpers/eliminar_doctor.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Doctor eliminado con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../Plantillas/medicos.php";                          
					}
				})
				
			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Liberar',                          
				});
			}
		}
	});
}


function quitarMedico(id){
	Swal.fire({
		title: 'Desea realizar la eliminación el doctor ?',
		text: "Con  Nro "+id+" de registro!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Confirmar!'
	}).then((result) => {
		if (result.value) {
			BajaDoctor(id);
		}
	})
}