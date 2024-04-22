// Función para los filtros de la tabla
function filterTable() {
    // Obtener valores de los filtros
    let searchId = $('#searchId').val().trim();
    let searchNombre = $('#searchNombre').val().trim().toLowerCase();
    let searchUsuario = $('#searchUsuario').val().trim().toLowerCase();
    let searchPlanEjercicio = $('#searchPlanEjercicio').val().trim();
    let searchDia = $('#searchDia').val().trim();
    let visibleRows = 0;

    // Iterar sobre cada fila de la tabla para aplicar los filtros
    $('#tablaPlanes tbody tr[id^="planRow-"]').each(function () {
        let isVisible = applyFiltersToRow($(this), {
            searchId, searchNombre, searchUsuario, searchPlanEjercicio, searchDia
        });
        if (isVisible) visibleRows++;
    });

    // Mostrar u ocultar la fila "sin resultados" basada en la cantidad de filas visibles
    toggleNoResultRow(visibleRows);
}

function applyFiltersToRow(row, filters) {
    let idText = row.children().eq(0).text().trim();
    let nombreText = row.children().eq(1).text().trim().toLowerCase();
    let usuarioText = row.children().eq(2).text().trim().toLowerCase();
    let planEjercicioText = row.children().eq(3).text().trim();
    let diaText = row.children().eq(4).text().trim();

    let isRowVisible = (filters.searchId === "" || idText === filters.searchId) &&
        (filters.searchNombre === "" || nombreText.includes(filters.searchNombre)) &&
        (filters.searchUsuario === "" || usuarioText.includes(filters.searchUsuario)) &&
        (filters.searchPlanEjercicio === "" || planEjercicioText.includes(filters.searchPlanEjercicio)) &&
        (filters.searchDia === "" || diaText.includes(filters.searchDia));
    row.css('display', isRowVisible ? '' : 'none');
    return isRowVisible;
}

// Función para mostrar u ocultar la fila que indica que no hay resultados
function toggleNoResultRow(visibleRows) {
    const noResultRow = document.getElementById('no-result');
    noResultRow.style.display = visibleRows === 0 ? '' : 'none';
}

let sortOrder = 1; // 1 para ascendente, -1 para descendente
let currentSortColumn = null;

// Función para ordernar la tabla en función de la columna seleccionada
function sortTable(columnIndex, columnId) {
    // Obtiene la tabla y el cuerpo de la tabla
    const table = $('#tablaPlanes');
    const tbody = table.find('tbody').first();

    // Convierte las filas de la tabla en un array para poder ordenarlas
    let rows = tbody.find('tr:not(#no-result)').toArray();

    // Verifica si es necesario cambiar el icono de ordenamiento en la columna
    if (currentSortColumn && currentSortColumn !== columnId) {
        const previousArrowSpan = $('#' + currentSortColumn).find('.sort-arrow');
        previousArrowSpan.removeClass('bi-caret-up-fill bi-caret-down-fill'); // Limpia los iconos de ordenamiento
    }

    // Ordena las filas basándose en el texto de la celda y el orden actual
    rows.sort((a, b) => {
        let valA = $(a).find('td').eq(columnIndex).text().trim().toLowerCase();
        let valB = $(b).find('td').eq(columnIndex).text().trim().toLowerCase();

        // Convierte a número si es posible
        valA = !isNaN(valA) && !isNaN(parseFloat(valA)) ? parseFloat(valA) : valA;
        valB = !isNaN(valB) && !isNaN(parseFloat(valB)) ? parseFloat(valB) : valB;

        // Determina el orden de clasificación
        if (valA < valB) return -1 * sortOrder;
        if (valA > valB) return 1 * sortOrder;
        return 0;
    });

    // Alterna el orden para el próximo clic
    sortOrder *= -1;

    // Actualiza el icono de ordenación para mostrar la dirección actual
    const arrowSpan = $('#' + columnId).find('.sort-arrow');
    arrowSpan.removeClass('bi-caret-up-fill bi-caret-down-fill'); // Limpia los iconos anteriores
    if (sortOrder === 1) {
        arrowSpan.addClass('bi-caret-down-fill');
    } else {
        arrowSpan.addClass('bi-caret-up-fill');
    }

    // Guarda la columna actual como la última columna clickeada
    currentSortColumn = columnId;

    // Reinserta las filas en el cuerpo de la tabla en el orden nuevo
    rows.forEach(row => tbody.append(row));
}

// Agregando controladores de eventos para la ordenación al hacer clic en los encabezados de las columnas
$('#sortID').click(() => sortTable(0, 'sortID'));
$('#sortNombre').click(() => sortTable(1, 'sortNombre'));
$('#sortUsuario').click(() => sortTable(2, 'sortUsuario'));
$('#sortPlanEjercicio').click(() => sortTable(3, 'sortPlanEjercicio'));
$('#sortDia').click(() => sortTable(4, 'sortDia'));

$(document).ready(function () {

    async function fetchMembers() {
        try {
            const response = await fetch('./index.php?controller=TrainingPlanPage&action=getMiembros', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            populateUserDropdown(result);
        } catch (error) {
            console.error('There was a problem fetching the member list:', error);
        }
    }

    async function fetchExercises() {
        try {
            const response = await fetch('./index.php?controller=TrainingPlanPage&action=getEjercicios', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const exercises = await response.json();
            populateExerciseDropdown(exercises);
            $('#exerciseSelect').change();
        } catch (error) {
            console.error('There was a problem fetching the exercise list:', error);
        }
    }

    function populateUserDropdown(members) {
        const $userSelect = $('#userSelect');
        $userSelect.empty();

        if (members.length === 0) {
            $userSelect.append($('<option>').text('No hay miembros disponibles').val(''));
        } else {
            members.forEach(member => {
                let memberFullName = `${member.nombre} ${member.apellidos}`;
                // Establece el ID del miembro como el valor de la opción
                $userSelect.append($('<option>').val(member.id).text(memberFullName));
            });
        }
    }

    function populateExerciseDropdown(exercises) {
        const $exerciseSelect = $('#exerciseSelect');
        $exerciseSelect.empty();

        if (exercises.length === 0) {
            $exerciseSelect.append($('<option>').text('No hay ejercicios disponibles').val(''));
            return;
        }

        // Ordena los ejercicios alfabéticamente
        exercises.sort((a, b) => {
            let comparison = a.grupo_muscular.localeCompare(b.grupo_muscular);
            if (comparison === 0) {
                return a.nombre_ejercicio.localeCompare(b.nombre_ejercicio);
            }
            return comparison;
        });

        exercises.forEach(exercise => {
            let optionText = `${exercise.grupo_muscular} - ${exercise.nombre_ejercicio}`;
            $exerciseSelect.append($('<option>').val(exercise.id_ejercicio).text(optionText).data('img', exercise.url_imagen));
        });

        $exerciseSelect.change(function () {
            const selectedOption = $(this).find('option:selected');
            const imageUrl = selectedOption.data('img');
            $('#exerciseImage').attr('src', imageUrl);
        });
    }

    fetchMembers();
    fetchExercises();


    $('#saveExercisePlan').on('click', async function () {
        const selectedUserId = $('#userSelect').val();
        const selectedExerciseId = $('#exerciseSelect').val();
        const series = $('#series').val();
        const repetitions = $('#repetitions').val();
        const day = $('#daySelect').val();

        const formData = {
            selectedUserId: selectedUserId,
            selectedExerciseId: selectedExerciseId,
            series: series,
            repetitions: repetitions,
            day: day
        };

        try {
            // Realiza una solicitud POST al servidor.
            const url = './index.php?controller=TrainingPlanPage&action=createExercisePlan';
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


    $('.delete-plan-btn').on('click', async function () {
        let planId = $(this).data('plan-id');
        try {
            // Realiza una solicitud POST al servidor.
            const url = './index.php?controller=TrainingPlanPage&action=deletePlan';
            const result = await performAjaxRequest(url, 'POST', {planId: planId});

            if (result.success) {
                showSuccessAndReload(result.message);
            } else {
                showError(result.message);
            }
        } catch (error) {
            console.error('Error al eliminar el plan:', error);
            showError('Hubo un problema al conectar con el servidor.');
        }
    });
});
