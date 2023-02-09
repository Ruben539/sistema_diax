function agregarDatoUsu(nombre,correo,usuario,password,rol,puesto){

	cadena = "nombre=" + nombre +
	"&correo=" + correo +
	"&usuario=" + usuario +
	"&password=" + password +
	"&rol=" + rol +
	"&puesto=" + puesto;
	
	

	$.ajax({
		type:"POST",
		url:"Helpers/grabarUsuario.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Grabado con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "Plantillas/salir.php";                          
					}
				})

			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Grabar',                          
				});
			}
		}
	});
}



function editarEstado(datos){
	d = datos.split('||');

	$('#id').val(d[0]);
	$('#estado').val(d[10]);
	

}

function actualizarEstado(){

	id=$('#id').val();
	estado=$('#estado').val();

	cadena = "id=" + id +
	"&estado=" + estado;

;


	$.ajax({
		type:"POST",
		url:"../Helpers/actualizarDatos_Pass.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Contraseña Actualizada'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../Modals/validacion_usuario.php";                          
					}
				})

			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Actualizar',                          
				});
			}
		}
	});
}

function editarDatosUsu(datos){
	d = datos.split('||');

	$('#id_usuario').val(d[0]);
	$('#nombreu').val(d[1]);
	$('#correou').val(d[2]);
	$('#usuariou').val(d[3]);
	$('#passwordu').val(d[4]);
	$('#rolu').val(d[5]);
	$('#puestou').val(d[6]);
	

}

function actualizarDatoUsu(){

	id_usuario=$('#id_usuario').val();
	nombre=$('#nombreu').val();
	correo=$('#correou').val();
	usuario=$('#usuariou').val();
	password=$('#passwordu').val();
	rol=$('#rolu').val();
	puesto=$('#puestou').val();
	


	cadena = "id_usuario=" + id_usuario +
	"&nombre=" + nombre +
	"&correo=" + correo +
	"&usuario=" + usuario +
	"&password=" + password +
	"&rol=" + rol +
	"&puesto=" + puesto;
	
;


	$.ajax({
		type:"POST",
		url:"Helpers/actualizarDatos_Usu.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Modificado con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "usuario";                          
					}
				})

			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Modificar',                          
				});
			}
		}
	});
}


function liberarPaciente(id){
	//return confirm("��Esta seguro de liberar el paciente?");
	
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"../Helpers/liberar_paciente.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Atendido con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../doctores/dashboardDoctores.php";                          
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


function liberarDatos(id){
	Swal.fire({
		title: 'El Paciente ha sido Atendido ?',
		text: "El Paciente Nro "+id+" a sido Atendido!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Confirmar!'
	}).then((result) => {
		if (result.value) {
			liberarPaciente(id);
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

