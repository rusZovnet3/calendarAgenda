<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Agenda Web</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Full Calendar -->
	<script src="js/main.js"></script>
	<link rel="stylesheet" href="css/main.css">
	<script src="js/locales-all.js"></script>

</head>
<body>

	<div class="container">

		<div class="col-md-8 offset-md-2">

			<div id="calendar"></div>

		</div>

		<!-- Button trigger modal -->
	    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalEvento">
	      Launch
	    </button>

		<!-- Modal -->
		<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title">Datos del evento </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

					</div>

					<div class="modal-body">

						<div class="container-fluid">

							<form action="" method="post" autocomplete="off">

								<div class="mb-3 visually-hidden">
									<label for="id" class="form-label">ID:</label>
									<input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
								</div>

								<div class="mb-3">
									<label for="titulo" class="form-label">Titulo:</label>
									<input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
								</div>

								<div class="mb-3 visually-hidden">
									<label for="fecha" class="form-label">Fecha:</label>
									<input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" disabled="">
								</div>

								<div class="mb-3">
									<label for="hora" class="form-label">Hora del Evento:</label>
									<input type="time" class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="Hora">
								</div>

								<div class="mb-3">
									<label for="descripcion" class="form-label">Descripcion:</label>
									<textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
								</div>

								<div class="mb-3">
									<label for="color" class="form-label">Color:</label>
									<input type="color" class="form-control" name="color" id="color" aria-describedby="helpId" placeholder="Titulo">
								</div>

							</form>

						</div>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-danger" id="btnBorrar" onclick="borrarEvento()" data-bs-dismiss="modal">Borrar</button>
						<button type="button" id="btnGuardar" onclick="agregarEvento()" class="btn btn-primary">Guardar</button>

					</div>

				</div>

			</div>

		</div>



	</div>


	<!-- Lib JS -->
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script>
		var modalEvento;
		// referencia al modal
		modalEvento = new bootstrap.Modal(document.getElementById('modalEvento'),{ keyboard:false });
		var calendar;

		document.addEventListener('DOMContentLoaded', function(){
			var calendarEl = document.getElementById('calendar');
			calendar = new FullCalendar.Calendar(calendarEl, {
				initialView: 'dayGridMonth',
				locale: 'es',  // traducir a español
				headerToolbar: { // cabecera
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay'  // mes,dia,semana === por tiempo
				},
				// captura la fecha, al hacer click el dia del mes
				dateClick:function(informacion){

					limpiarFormulario(informacion.dateStr);

					/*alert("Presionaste la fecha: " + informacion.dateStr);*/

					modalEvento.show();
				},
				eventClick:function(informacion){

					//alert("Presionaste un Evento");
					console.log(informacion);
					modalEvento.show();
					recuperarDatosEvento(informacion.event);

				},events:"api.php"  // url del archivo de la consulta de BD
			});
			calendar.render();
		});


		function recuperarDatosEvento(evento){
			limpiarErrores();

			let fecha = evento.startStr.split("T");
			let hora = fecha[1].split("-");

			document.getElementById('id').value = evento.id;
			document.getElementById('titulo').value = evento.title;
			document.getElementById('fecha').value = fecha[0];
			document.getElementById('hora').value = hora[0];
			document.getElementById('descripcion').value = evento.extendedProps.descripcion;
			document.getElementById('color').value = evento.backgroundColor;

			/*desactivar botones*/
			document.getElementById('btnBorrar').removeAttribute('disabled', "");
			document.getElementById('btnGuardar').removeAttribute('disabled', "");
		}

		function borrarEvento(){
			enviarDatosApi("borrar");
		}

		function agregarEvento(){
			// verifica si el campo titulo está vacio
			if (document.getElementById('titulo').value == "") {
				 document.getElementById('titulo').classList.add('is-invalid');
				 return true;
			}

			accion = (document.getElementById('id').value == 0) ? "agregar" : "actualizar";
			enviarDatosApi(accion);
		}


		function enviarDatosApi(accion){
			// recepcion de valores
			fetch("api.php?accion=" + accion, {
				method: "POST",
				body: recolectarDatos()
			}).then(data => {
				console.log(data); // captura los datos del POST
				calendar.refetchEvents();   // refresca
				modalEvento.hide();  // cierra el modal
			}).catch(error => {
				console.log(error);
			});
		}


		function recolectarDatos(){
			let evento = new FormData();  /*POST de carga*/
			evento.append("title", document.getElementById('titulo').value);
			evento.append("fecha", document.getElementById('fecha').value);
			evento.append("hora", document.getElementById('hora').value);
			evento.append("descripcion", document.getElementById('descripcion').value);
			evento.append("color", document.getElementById('color').value);
			evento.append("id", document.getElementById('id').value);

			return evento;
		}


		function limpiarFormulario(fecha){
			limpiarErrores();

			document.getElementById('titulo').value = "";
			document.getElementById('fecha').value = fecha;
			document.getElementById('hora').value = "00:00";
			document.getElementById('descripcion').value = "";
			document.getElementById('color').value = "";
			document.getElementById('id').value = "";

			/*desactivar boton*/
			document.getElementById('btnBorrar').setAttribute('disabled', "disabled");
		}

		// inhabilita el campo error
		function limpiarErrores(){
			document.getElementById('titulo').classList.remove('is-invalid');
		}
	</script>


</body>
</html>