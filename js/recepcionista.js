function index(){
    this.ini = function(){
        console.log("iniciando");
        this.getIndicadores();
        
        

    }

    this.getIndicadores = function(){
	//Consulta de Vendidos al servisor de parte del Cliente Para ver el Total Pacientes
	$.ajax({
		statusCode:{
			404:function(){
				console.log("Esta Pagina no Existe");
			}
		},
		url:'../Librerias/servidor.php',
		method:'POST',
		data:{
			rq:"1"
		}
	}).done(function(datos){
	//Logica de respuesta  de los datos
	$("#idPacientePaz").text(parseFloat(datos).toLocaleString());
});

	//Consulta de la Sentencia para recuperar los datos Obtenidos
	$.ajax({
		statusCode:{
			404:function(){
				console.log("Esta Pagina no Existe");
			}
		},
		url:'../Librerias/servidor.php',
		method:'POST',
		data:{
			rq:"2"
		}
	}).done(function(datos){
	//Logica de respuesta  de los datos
	$("#idPacienteDiax").text(parseFloat(datos).toLocaleString());
});

// Consulta de la sentencia para recuperar los datos para las Notificaciones
$.ajax({
statusCode:{
    404:function(){
        console.log("Esta Pagina no Existe");
    }
},
url:'../Librerias/servidor.php',
method:'POST',
data:{
    rq:"7"
}
}).done(function(datos){
//Logica de respuesta  de los datos
$("#idNotificacionPen").text(parseFloat(datos).toLocaleString()+" "+"Pedidos Pendientes");

if (datos == 0) {
//alert("validacion nula");

}else{

Swal.fire({
/*toast: true,*/
position: 'bottom-end',
title: 'Mensaje del Sistema !',
text: 'Su pedido de cancelación aun no ha sido realizado',
footer:'Favor comunicarse con el administrador',
imageUrl: '../images/logo.png',
imageWidth: 160,
imageHeight: 80,
imageAlt: 'Custom image',
showConfirmButton: false,
timer: 5000, 

});


}

});




}

}

//llave de la primera Clase principal

var oIndex = new index();
setTimeout(function(){oIndex.ini();}, 100);
