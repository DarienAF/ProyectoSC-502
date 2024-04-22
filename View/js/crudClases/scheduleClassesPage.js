$(document).ready(async function () {
	const daysOfWeek = [
		'Domingo',
		'Lunes',
		'Martes',
		'Miércoles',
		'Jueves',
		'Viernes',
		'Sábado',
	];
	const months = [
		'Enero',
		'Febrero',
		'Marzo',
		'Abril',
		'Mayo',
		'Junio',
		'Julio',
		'Agosto',
		'Septiembre',
		'Octubre',
		'Noviembre',
		'Diciembre',
	];
	let now = new Date();
	let firstDayOfWeek = new Date(now.setDate(now.getDate() - now.getDay()));
	let lastDayOfWeek = new Date(firstDayOfWeek.getTime());
	lastDayOfWeek.setDate(firstDayOfWeek.getDate() + 6);

	for (let i = 0; i < 7; i++) {
		let day = new Date(firstDayOfWeek);
		day.setDate(day.getDate() + i);
		let th = $('<th>').text(`${daysOfWeek[day.getDay()]}, ${day.getDate()}`);
		if (new Date().toDateString() === day.toDateString()) {
			th.addClass('today');
		}
		$('#daysOfWeek').append(th);
	}

	$('#weekRange').html(
		`${firstDayOfWeek.getDate()} ${
			months[firstDayOfWeek.getMonth()]
		} - ${lastDayOfWeek.getDate()} ${months[lastDayOfWeek.getMonth()]}`
	);
	$('#year').text(lastDayOfWeek.getFullYear());

	for (let i = 0; i < 10; i++) {
		let tr = $('<tr>');
		for (let j = 0; j < 7; j++) {
			tr.append($('<td>'));
		}
		$('#calendarBody').append(tr);
	}

	await addClasses();

	let currentBookingId = null;

	$(document).on('click', '.class', function (event) {
		const modal = $('#classModal');
		modal.hide();

		$('#modalClassName').text($(this).data('nombre_clase'));
		$('#modalClassCoach').text(
			'Profesor de la clase: ' +
				$(this).data('nombre_usuario_profesor') +
				' ' +
				$(this).data('apellidos_usuario_profesor')
		);
		$('#modalClassStartTime').text(
			'Hora de Inicio: ' + convertTo12HourFormat($(this).data('hora_inicio'))
		);
		$('#modalClassEndTime').text(
			'Hora Final: ' + convertTo12HourFormat($(this).data('hora_fin'))
		);
		$('#modalClassCategory').text(
			'Categoria de la clase: ' + $(this).data('nombre_categoria')
		);

		let posX = event.pageX;
		let posY = event.pageY;

		modal.css({
			top: posY + 'px',
			left: posX + 'px',
			position: 'absolute',
		});

		modal.show();

		currentBookingId = $(this).data('id_reserva');
	});

	$(document).click(function (event) {
		if (!$(event.target).closest('.class, .modal-content').length) {
			$('#classModal').hide();
		}
	});

	$('.modal-footer').click(function (event) {
		event.stopPropagation();
	});

	$('.cancel-button').click(async function (event) {
		event.stopPropagation();

        const confirmed = await showConfirmation(
			'¿Estás seguro que deseas cancelar la clase?'
		);

		if (confirmed) {
			try {
				// Realiza una solicitud POST al servidor.
				const url = `./index.php?controller=schedulePage&action=deactivate`;
				const result = await performAjaxRequest(url, 'POST', {
					bookingId: currentBookingId,
				});

				if (result.success) {
					showSuccessAndReload('¡Se canceló la clase con éxito!');
				} else {
					showError('No se pudo cancelar la clase.');
				}
			} catch (error) {
				console.error('Error al actualizar el estado de la clase', error);
				showError('Hubo un problema al conectar con el servidor.');
			}
		}
	});
});

async function fetchClasses() {
	try {
		const response = await fetch(
			'./index.php?controller=SchedulePage&action=getClassesByUser',
			{
				method: 'GET',
				headers: {
					'Content-Type': 'application/json',
				},
			}
		);

		if (!response.ok) {
			throw new Error(`HTTP error! status: ${response.status}`);
		}

		return await response.json();
	} catch (error) {
		console.error('No se pudieron encontrar las clases:', error);
	}
}

async function addClasses() {
	const classes = await fetchClasses();

	const daysMap = {
		Domingo: 0,
		Lunes: 1,
		Martes: 2,
		Miercoles: 3,
		Jueves: 4,
		Viernes: 5,
		Sabado: 6,
	};

	// Ordenar las clases por día y hora de inicio
	classes.sort((a, b) => {
		if (a.dia !== b.dia) {
			return daysMap[a.dia] - daysMap[b.dia];
		}
		return a.hora_inicio.localeCompare(b.hora_inicio);
	});

	classes.forEach((cls) => {
		const dayColumnIndex = daysMap[cls.dia];

		// Convertir hora de inicio y fin a formato de 12 horas
		const startTime = convertTo12HourFormat(cls.hora_inicio);
		const endTime = convertTo12HourFormat(cls.hora_fin);

		// Crear el elemento de la clase
		const classDiv = $('<div>', {
			class: 'class',
			text: cls.nombre_clase,
			'data-id_reserva': cls.id_reserva,
			'data-nombre_usuario_reservado': cls.nombre_usuario_reservado,
			'data-nombre_usuario_profesor': cls.nombre_usuario_profesor,
			'data-apellidos_usuario_profesor': cls.apellidos_usuario_profesor,
			'data-hora_inicio': cls.hora_inicio,
			'data-hora_fin': cls.hora_fin,
			'data-dia': cls.dia,
			'data-nombre_categoria': cls.nombre_categoria,
			'data-nombre_clase': cls.nombre_clase,
		});

		// Crear un elemento contenedor para la hora
		const timeContainer = $('<div>', {
			class: 'class-time',
			text: `${startTime} - ${endTime}`,
		});

		// Buscar la celda correspondiente en la tabla y agregar la clase
		$('#calendarBody tr').each(function () {
			const cell = $(this).find('td').eq(dayColumnIndex);
			if (cell.length > 0 && !cell.has('.class').length) {
				const eventContainer = $('<div>', { class: 'class-container' });
				eventContainer.append(classDiv).append(timeContainer);
				cell.append(eventContainer);
				return false; // Salir del bucle each
			}
		});
	});
}

// Función para convertir hora a formato de 12 horas
function convertTo12HourFormat(time) {
	const [hours, minutes] = time.split(':');
	let period = 'AM';
	let hour = parseInt(hours, 10);

	if (hour >= 12) {
		period = 'PM';
		if (hour > 12) {
			hour -= 12;
		}
	}

	return `${hour}:${minutes} ${period}`;
}
