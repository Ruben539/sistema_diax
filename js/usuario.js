function agregarDatoUsu(nombre,correo,usuario,password,rol,puesto,foto){

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



function editarDatosPass(datos){
	d = datos.split('||');

	$('#id_usuario').val(d[0]);
	$('#pass').val(d[1]);
	

}

function actualizarDatoPass(){

	id_usuario=$('#id_usuario').val();
	pass=$('#pass').val();

	cadena = "id_usuario=" + id_usuario +
	"&pass=" + pass;

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


function liberarUsuario(id_usuario){
	cadena = "id_usuario=" + id_usuario;

	$.ajax({
		type:"POST",
		url:"Helpers/liberarDatos_Usu.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Eliminado con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "usuario_Inactivo";                          
					}
				})
				
			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Eliminar',                          
				});
			}
		}
	});
}


function liberarDatos(id_usuario){
	Swal.fire({
		title: 'Desea Eliminar el Usuario ?',
		text: "Eliminar Usuario "+id_usuario+" del Sistema!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Eliminar!'
	}).then((result) => {
		if (result.value) {
			liberarUsuario(id_usuario);
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

