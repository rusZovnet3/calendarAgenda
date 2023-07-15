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
							Sin cargos
						</div>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-danger" id="btnBorrar" data-bs-dismiss="modal">Borrar</button>
						<button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>

					</div>

				</div>

			</div>

		</div>



	</div>



	<script>
		document.addEventListener('DOMContentLoaded', function(){
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				initialView: 'dayGridMonth',
				locale: 'es',  // traducir a español
				headerToolbar: { // cabecera
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay'  // mes,dia,semana === por tiempo
				},
				// captura la fecha, al hacer click el dia del mes
				dateClick:function(informacion){
					alert("Presionaste la fecha: " + informacion.dateStr);
				}
			});
			calendar.render();
		});
	</script>

	<!-- Lib JS -->
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>