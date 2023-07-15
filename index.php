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