	function index(){
		this.ini = function(){
			console.log("iniciando");
			this.getIndicadores();
			
			

		}

		this.getIndicadores = function(){
	//Consulta de Vendidos al servisor de parte del Cliente Para ver el Total Vendido
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

	//Consulta de la Sentencia para recuperar los datos para Almacen
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

/* Consulta de la sentencia para recuperar los datos para las Notificaciones
			$.ajax({
				statusCode:{
					404:function(){
						console.log("Esta Pagina no Existe");
					}
				},
				url:'../Librerias/servidor.php',
				method:'POST',
				data:{
					rq:"26"
				}
			}).done(function(datos){
	//Logica de respuesta  de los datos
  $("#idNotificacion").text(parseFloat(datos).toLocaleString()+" "+"Pedidos Pendientes");
 
	if (datos == 0) {
		//alert("validacion nula");

	}else{

	Swal.fire({
  toast: true,
  position: 'bottom-end',
  title: 'Mensaje del Sistema !',
  text: 'Tiene un nuevo Pedido para Aprobar',
  imageUrl: '../images/recurso.png',
  imageWidth: 150,
  imageHeight: 70,
  imageAlt: 'Custom image',
  showConfirmButton: false,
  timer: 5000, 

});

	
	}
	
});

}*/
}
/*
this.getDataGrafica = function(){
		// Consulta de la sentencia para recuperar los datos del Grafico
		$.ajax({
			statusCode:{
				404:function(){
					console.log("Esta Pagina no Existe");
				}
			},
			url:'../Librerias/Core/servidor.php',
			method:'POST',
			data:{
				rq:"11"
			}
		}).done(function(datos){
	//Logica de respuesta  de los datos para los valores del Grafico
	if (datos != '') {
		let etiquetas = new Array();
		let tproduccion = new Array();
		let tprobados = new Array();
		let tfaltante = new Array();
		let tbanco = new Array();
		let coloresV = new Array();
		let coloresP = new Array();
		let coloresF = new Array();
		let coloresB = new Array();
		var jDatos = JSON.parse(datos);

		//Creacion y Estrucura de la Tabla
		var tablaDatos = document.createElement('tabla');
		tablaDatos.classList.add('table','table-striped');
		var tr = document.createElement('tr');
		var th = document.createElement('th');
		th.innerText="Fecha";
		tr.appendChild (th);
		th = document.createElement('th');
		th.innerText="Producido";
		tr.appendChild (th);
		th = document.createElement('th');
		th.innerText="Habilitado";
		tr.appendChild (th);
		th = document.createElement('th');
		th.innerText="Faltantes";
		tr.appendChild (th);
		th = document.createElement('th');
		th.innerText="Banco";
		tr.appendChild (th);
		tablaDatos.appendChild(tr);


		//Llenado de datos que se muestran el la Grafica
		for(let i in jDatos){
			etiquetas.push(jDatos[i].fechaVenta);
			tproduccion.push(jDatos[i].totalProducido);
			tprobados.push(jDatos[i].totalProbado);
			tfaltante.push(jDatos[i].totalFaltante);
			tbanco.push(jDatos[i].totalBanco);
			coloresV.push("#006400");
			coloresP.push("#FFFF00");
			coloresF.push("#f00");
			coloresB.push("blue");

			tr = document.createElement('tr');
			var td = document.createElement("td");
			td.innerText = jDatos[i].fechaVenta;
			tr.appendChild(td);

			td = document.createElement("td");
			td.innerText = parseFloat(jDatos[i].totalProducido).toLocaleString();
			tr.appendChild(td);

			td = document.createElement("td");
			td.innerText = parseFloat(jDatos[i].totalProbado).toLocaleString();
			tr.appendChild(td);

			td = document.createElement("td");
			td.innerText = parseFloat(jDatos[i].totalFaltante).toLocaleString();
			tr.appendChild(td);

			td = document.createElement("td");
			td.innerText = parseFloat(jDatos[i].totalBanco).toLocaleString();
			tr.appendChild(td);



			tablaDatos.appendChild(tr);

		}

		var idCont = document.getElementById("idTabla");
		idCont.appendChild(tablaDatos);

		var ctx = document.getElementById('idgrafica').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels:etiquetas,
				datasets: [{
					label: 'Total Producido',
					data: tproduccion,
					backgroundColor:coloresV
				},{
					label: 'Total Probado',
					data: tprobados,
					backgroundColor:coloresP
				},{
					label: 'Total Faltntes',
					data: tfaltante,
					backgroundColor:coloresF
				},
				{
					label: 'Banco de Pruebas',
					data: tbanco,
					backgroundColor:coloresB
				},
				]
			}
		});
	}
});
}*/
}

	//llave de la primera Clase principal

	var oIndex = new index();
	setTimeout(function(){oIndex.ini();}, 100);
