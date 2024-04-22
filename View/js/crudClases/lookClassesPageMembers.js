$(document).ready(function () {
	var idUsuario;
	var idClase;

	$('.btn-primary').click(function () {
		// Obtener los valores del botón
		idClase = $(this).attr('id').split('-')[1];
		var horaInicio = $(this).data('hora-inicio');
		var horaFin = $(this).data('hora-fin');
		var dia = $(this).data('dia');
		var nombreCoach = $(this).data('nombre-coach');
		var apellidosCoach = $(this).data('apellidos-coach');
		var nombreClase = $(this).data('nombre-clase');
		idUsuario = $(this).data('id_usuario');

		// Actualizar los valores en el modal
		$('#trainerName').val(nombreCoach + ' ' + apellidosCoach);
		$('#startTime').val(horaInicio);
		$('#endTime').val(horaFin);
		$('#day').val(dia);
		$('#classId').val(idClase);
		$('#className').val(nombreClase);

		// Mostrar el modal
		$('#viewClassDetails').modal('show');
	});

	$('#createBookingClass').on('click', async function () {
		const selectedUserId = idUsuario;
		const selectedClassId = idClase;

		console.log(selectedUserId);
		console.log(selectedClassId);

		const formData = {
			selectedUserId: selectedUserId,
			selectedClassId: selectedClassId,
		};

		try {
			// Realiza una solicitud POST al servidor.
			const url =
				'./index.php?controller=ClassesPage&action=createBooking';
			const result = await performAjaxRequest(url, 'POST', formData);

			if (result.success) {
				showSuccessAndReload(result.message);
			} else {
				showError(result.message);
			}
		} catch (error) {
			console.error('Error al crear el plan:', error);
			showError('Hubo un problema al conectar con el servidor.');
		}
	});
});
