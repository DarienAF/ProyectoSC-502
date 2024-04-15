// Función para los filtros de la tabla de reservas
function filterTable() {
    // Obtener valores de los filtros
    let searchId = $('#searchId').val().trim();
    let searchUserName = $('#searchUserName').val().trim().toLowerCase();
    let searchDay = $('#searchDay').val().toLowerCase();
    let searchClassName = $('#searchClassName').val().toLowerCase();
    let searchStatus = $('#searchStatus').val().toLowerCase();

    let visibleRows = 0;

    // Iterar sobre cada fila de la tabla para aplicar los filtros
    $('#tablaReserva tbody tr[id^="bookingRow-"]').each(function () {
        let isVisible = applyFiltersToRow($(this), {
            searchId, searchUserName, searchDay, searchClassName, searchStatus
        });
        if (isVisible) visibleRows++;
    });

    // Mostrar u ocultar la fila "sin resultados" basada en la cantidad de filas visibles
    toggleNoResultRow(visibleRows);
}

// Función para aplicar los filtros a una fila específica de reservas
function applyFiltersToRow(row, filters) {
    let idText = row.children().eq(0).text().trim();
    let userNameText = row.children().eq(1).text().trim().toLowerCase();
    let dayText = row.children().eq(2).text().toLowerCase();
    let classNameText = row.children().eq(3).text().toLowerCase();
    let statusText = row.children().eq(6).text().trim().toLowerCase();

    let isRowVisible = (filters.searchId === "" || idText === filters.searchId) &&
        (filters.searchUserName === "" || userNameText.includes(filters.searchUserName)) &&
        (filters.searchDay === "" || dayText.includes(filters.searchDay)) &&
        (filters.searchClassName === "" || classNameText.includes(filters.searchClassName)) &&
        (filters.searchStatus === "" || statusText === filters.searchStatus);

    row.css('display', isRowVisible ? '' : 'none');
    return isRowVisible;
}

// Agregando controladores de eventos para la ordenación al hacer clic en los encabezados de las columnas
$('#sortID').click(() => sortTable(0, 'sortID'));
$('#sortUsername').click(() => sortTable(1, 'sortUsername'));
$('#sortDay').click(() => sortTable(2, 'sortDay'));
$('#sortClassName').click(() => sortTable(3, 'sortClassName'));
$('#sortStatus').click(() => sortTable(6, 'sortStatus'));


// Función para ordenar la tabla de reservas
function sortTable(columnIndex, columnId) {
    // Obtiene la tabla y el cuerpo de la tabla
    const table = $('#tablaReserva');
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

// Función para mostrar u ocultar la fila que indica que no hay resultados
function toggleNoResultRow(visibleRows) {
    const noResultRow = document.getElementById('no-result');
    noResultRow.style.display = visibleRows === 0 ? '' : 'none';
}

let sortOrder = 1; // 1 para ascendente, -1 para descendente
let currentSortColumn = null;


$(document).ready(function () {
    $('.btn-toggle').on('click', async function () {
        // Recuperar datos necesarios del elemento al que se le hizo click
        const bookingId = $(this).attr('data-booking-id');
        const className = $(this).attr('data-class-name');
        const currentState = $(this).attr('data-state');
        const action = currentState === 'activa' ? 'deactivate' : 'activate';

        try {
            // Realiza una solicitud POST al servidor.
            const url = `./index.php?controller=ReservesPage&action=${action}`;
            const result = await performAjaxRequest(url, 'POST', {bookingId: bookingId});

            if (result.success) {
                $(this).attr('data-state', action === 'activate' ? 'activa' : 'cancelada');
                $(this).text(currentState === 'activa' ? 'Cancelada' : 'Activa');

                Swal.fire({
                    icon: result.icon,
                    title: result.title,
                    text: `La  reserva de la clase de ${className} ha sido ${currentState === 'activa' ? 'cancelada' : 'activada'} con éxito.`,
                    confirmButtonColor: 'rgb(29, 29, 29)',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                showError('No se pudo cambiar el estado de la reserva.');
            }
        } catch (error) {
            console.error('Error al actualizar el estado de la reserva', error);
            showError('Hubo un problema al conectar con el servidor.');
        }
    });
});