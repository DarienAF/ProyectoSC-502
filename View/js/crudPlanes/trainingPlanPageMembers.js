$(document).ready(async function () {
    const daysOfWeek = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
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

    $('#weekRange').html(`${firstDayOfWeek.getDate()} ${months[firstDayOfWeek.getMonth()]} - ${lastDayOfWeek.getDate()} ${months[lastDayOfWeek.getMonth()]}`);
    $('#year').text(lastDayOfWeek.getFullYear());

    for (let i = 0; i < 10; i++) {
        let tr = $('<tr>');
        for (let j = 0; j < 7; j++) {
            tr.append($('<td>'));
        }
        $('#calendarBody').append(tr);
    }
    await addRoutines();


    $(document).on('click', '.event', function (event) {
        const modal = $('#exerciseModal');
        modal.hide();

        $('#modalExerciseName').text($(this).data('nombre'));
        $('#modalExerciseInfo').text($(this).data('informacion'));
        $('#modalExerciseImage').attr('src', $(this).data('imagen'));


        let posX = event.pageX;
        let posY = event.pageY;


        modal.css({
            top: posY + 'px',
            left: posX + 'px',
            position: 'absolute'
        });

        modal.show();
    });

    $(document).click(function (event) {
        if (!$(event.target).closest('.event, .modal-content').length) {
            $('#exerciseModal').hide();
        }
    });


});

async function fetchPlans() {
    try {
        const response = await fetch('./index.php?controller=TrainingPlanPage&action=getPlanesByUser', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Could not fetch plans:', error);
    }
}

async function addRoutines() {
    const plans = await fetchPlans();
    const daysMap = {'Domingo': 0, 'Lunes': 1, 'Martes': 2, 'Miercoles': 3, 'Jueves': 4, 'Viernes': 5, 'Sabado': 6};
    plans.forEach(plan => {
        const dayColumnIndex = daysMap[plan.dia];
        let added = false;

        $('#calendarBody tr').each(function () {
            const cell = $(this).find('td').eq(dayColumnIndex);
            if (cell.length > 0 && !cell.has('.event').length && !added) {
                const eventDiv = $('<div>', {
                    class: 'event',
                    text: plan.nombre_ejercicio,
                    'data-nombre': plan.nombre_ejercicio,
                    'data-imagen': plan.imagen,
                    'data-informacion': plan.informacion,
                });
                cell.append(eventDiv);
                added = true;
            }
        });
    });
}