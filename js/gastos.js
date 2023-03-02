

function BajaGasto(id){
	//return confirm("��Esta seguro de liberar el paciente?");
	
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"../Helpers/eliminar_gasto.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Gasto eliminado con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../Plantillas/gastos.php";                          
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


function EliminarGasto(id){
	Swal.fire({
		title: 'Desea eliminar el gasto ?',
		text: "Con  Nro "+id+" de registro!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Confirmar!'
	}).then((result) => {
		if (result.value) {
			BajaGasto(id);
		}
	})
}