const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
	solicitante: /^[a-zA-Z0-9\_\-" "]{4,100}$/, // Letras, numeros, guion y guion_bajo
	modelo: /^[a-zA-Z0-9\_\-" "]{4,100}$/, // Letras y espacios, pueden llevar acentos.
	nro_partida: /^[a-zA-Z0-9\_\-" "]{1,10}$/, // Letras, numeros, guion y guion_bajo
	//pieza: /^[a-zA-Z0-9\_\-" "]{4,100}$/, // Letras, numeros, guion y guion_bajo
	cantidad: /^[a-zA-Z0-9\_\-" "]{1,100}$/, // Letras, numeros, guion y guion_bajo
	destino: /^[a-zA-Z0-9\_\-" "]{4,100}$/, // Letras, numeros, guion y guion_bajo
	observacion: /^[a-zA-ñ-Z0-9\_\-" "]{4,1000}$/, // Letras, numeros, guion y guion_bajo
	autorizado: /^[a-zA-Z0-9\_\-" "]{4,100}$/, // Letras, numeros, guion y guion_bajo
}

const campos = {
	solicitante : false,
	modelo : false,
	nro_partida : false,
	//pieza : false,
	cantidad : false,
	destino : false,
	observacion : false,
	autorizado : false

}

const validarFormulario = (e) => {
	switch (e.target.name) {
//En caso de que el campo sea solicitante se ejecuta este codigo
		case "solicitante":
		validarCampo(expresiones.solicitante, e.target, 'solicitante');
		break;
//En caso de que el campo sea modelo se ejecuta este codigo
		case "modelo":
		validarCampo(expresiones.modelo, e.target, 'modelo');
		break;
//En caso de que el campo sea nro_partida se ejecuta este codigo
		case "nro_partida":
		validarCampo(expresiones.nro_partida, e.target, 'nro_partida');
		break;
//En caso de que el campo sea pieza se ejecuta este codigo
		//case "pieza":
		//validarCampo(expresiones.pieza, e.target, 'pieza');
		//break;
//En caso de que el campo sea cantidad se ejecuta este codigo
		case "cantidad":
		validarCampo(expresiones.cantidad, e.target, 'cantidad');
		break;
//En caso de que el campo sea destino se ejecuta este codigo
		case "destino":
		validarCampo(expresiones.destino, e.target, 'destino');
		break;
//En caso de que el campo sea observacion se ejecuta este codigo
		case "observacion":
		validarCampo(expresiones.observacion, e.target, 'observacion');
		break;
//En caso de que el campo sea autorizado se ejecuta este codigo
		case "autorizado":
		validarCampo(expresiones.autorizado, e.target, 'autorizado');
		break;
	}
	
}

const validarCampo = (expresion,input,campo) => {
	if (expresion.test(input.value)) {
		document.getElementById(`grupo-${campo}`).classList.remove('form-group-incorrecto');
		document.getElementById(`grupo-${campo}`).classList.add('form-group-correcto');
		document.querySelector(`#grupo-${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo-${campo} i`).classList.remove('fa-times-circle');
		//codigo para acceder al mensaje de error
		document.querySelector(`#grupo-${campo} .mensaje-error`).classList.remove('mensaje-error-activo');
		campos[campo] = true;
	}else{
		document.getElementById(`grupo-${campo}`).classList.add('form-group-incorrecto');
		document.getElementById(`grupo-${campo}`).classList.remove('form-group-correcto');
		document.querySelector(`#grupo-${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo-${campo} i`).classList.add('fa-times-circle');
		//codigo para acceder al mensaje de error
		document.querySelector(`#grupo-${campo} .mensaje-error`).classList.add('mensaje-error-activo');
		campos[campo] = false;

	}
}

/*const validarPass2 = () => {
	const inputpassword1 = document.getElementById('password');
	const inputpassword2 = document.getElementById('password2');

	if (inputpassword1.value !== inputpassword2.value) {

		document.getElementById(`grupo-password2`).classList.add('form-group-incorrecto');
		document.getElementById(`grupo-password2`).classList.remove('form-group-correcto');
		document.querySelector(`#grupo-password2 i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo-password2 i`).classList.add('fa-times-circle');
		//codigo para acceder al mensaje de error
		document.querySelector(`#grupo-password2 .mensaje-error`).classList.add('mensaje-error-activo');
		campos['password'] = false;
	}else{

	document.getElementById(`grupo-password2`).classList.remove('form-group-incorrecto');
		document.getElementById(`grupo-password2`).classList.add('form-group-correcto');
		document.querySelector(`#grupo-password2 i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo-password2 i`).classList.add('fa-check-circle');
		//codigo para acceder al mensaje de error
		document.querySelector(`#grupo-password2 .mensaje-error`).classList.remove('mensaje-error-activo');	
		campos['password'] = true;
	}
}*/

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur' , validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	//e.preventDefault();


	if (campos.solicitante && campos.modelo && campos.nro_partida  && campos.cantidad &&campos.destino &&campos.observacion &&campos.autorizado) {
		
		//formulario.reset();

		document.getElementById('form-exito').classList.add('form-exito-activo');
		setTimeout(() => {
		document.getElementById('form-exito').classList.remove('form-exito-activo');	
		}, 10000);

		document.querySelectorAll('.form-group-correcto').forEach((icono) => {
			icono.classList.remove('form-group-correcto');
		});

	}else{
		document.getElementById('form-mensaje').classList.add('form-mensaje-activo');
		setTimeout(() => {
		document.getElementById('form-mensaje').classList.remove('form-mensaje-activo');	
		}, 5000);
	}
});


