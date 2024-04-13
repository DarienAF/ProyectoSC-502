// Función para actualizar la interfaz de usuario con los nuevos datos
function updateUI(id_clase, id_Usuario, usuario, hora_inicio, 
    hora_fin, dia, nombre, id_categoria, categoria) {
    $(`#id-${id_clase}`).text(id_clase);
    $(`#userId-${id_clase}`).text(id_Usuario);
    $(`#username-${id_clase}`).text(usuario);
    $(`#horaInicio-${id_clase}`).text(hora_inicio);
    $(`#horaFin-${id_clase}`).text(hora_fin);
    $(`#dia-${id_clase}`).text(dia);
    $(`#nombre-${id_clase}`).text(nombre);
    $(`#idCategoria-${id_clase}`).text(id_categoria);
    $(`#categoria-${id_clase}`).text(categoria);
}

// Función para los filtros de la tabla
function filterTable() {
    // Obtener valores de los filtros
    let searchId = $('#searchId').val().trim();
    let searchUserId = $('#searchUserId').val().trim();
    let searchUsername = $('#searchUsername').val().trim().toLowerCase();
    let searchStartTime = $('#searchStartTime').val().trim();
    let searchEndTime = $('#searchEndTime').val().trim();
    let searchDay = $('#searchDay').val().trim();
    let searchClassName = $('#searchClassName').val().trim();
    let searchCategoryId = $('#searchCategoryId').val().trim();
    let searchCategoryname = $('#searchCategoryname').val().trim().toLowerCase();
    let visibleRows = 0;

    // Iterar sobre cada fila de la tabla para aplicar los filtros
    $('#tablaClase tbody tr[id^="classRow-"]').each(function () {
        let isVisible = applyFiltersToRow($(this), {
            searchId, searchUserId, searchUsername, searchStartTime, searchEndTime,
            searchDay, searchClassName, searchCategoryId, searchCategoryname
        }); 
        if (isVisible) visibleRows++;
    });

    // Mostrar u ocultar la fila "sin resultados" basada en la cantidad de filas visibles
    toggleNoResultRow(visibleRows);
}

function applyFiltersToRow(row, filters) {
    let idText = row.children().eq(0).text().trim();
    let usuarioIDText = row.children().eq(1).text().trim();
    let usernameText = row.children().eq(2).text().trim().toLowerCase();
    let startTimeText = row.children().eq(3).text().trim();
    let endTimeText = row.children().eq(4).text().trim();
    let dayText = row.children().eq(5).text().trim();
    let classNameText = row.children().eq(6).text().trim();
    let categoryIdText = row.children().eq(7).text().trim();
    let categoryNameText = row.children().eq(8).text().trim().toLowerCase();

    let isRowVisible = (filters.searchId === "" || idText === filters.searchId) &&
        (filters.searchUserId === "" || usuarioIDText === filters.searchUserId) &&
        (filters.searchUsername === "" || usernameText.includes(filters.searchUsername)) &&
        (filters.searchStartTime === "" || startTimeText.includes(filters.searchStartTime)) &&
        (filters.searchEndTime === "" || endTimeText.includes(filters.searchEndTime)) &&
        (filters.searchDay === "" || dayText.includes(filters.searchDay)) &&
        (filters.searchClassName === "" || classNameText.includes(filters.searchClassName)) &&
        (filters.searchCategoryId === "" || categoryIdText.includes(filters.searchCategoryId)) &&
        (filters.searchCategoryname === "" || categoryNameText.includes(filters.searchCategoryname));
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
    const table = $('#tablaClase');
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
$('#sortUserID').click(() => sortTable(1, 'sortUserID'));
$('#sortUsername').click(() => sortTable(2, 'sortUsername'));
$('#sortStartTime').click(() => sortTable(3, 'sortStartTime'));
$('#sortEndTime').click(() => sortTable(4, 'sortEndTime'));
$('#sortDay').click(() => sortTable(5, 'sortDay'));
$('#sortClassName').click(() => sortTable(6, 'sortClassName'));
$('#sortCategoryID').click(() => sortTable(7, 'sortCategoryID'));
$('#sortCategoryName').click(() => sortTable(8, 'sortCategoryName'));


// Función que crea una clase nueva
async function createClassData() {

    // Validación de campos
    const createClassFields = ["newUserClass", "newStartTime", "newEndTime", 
    "newDay", "newClassName", "newCategoryClass"];
    if (!validateForm(createClassFields)) {
    showWarning("Todos los campos deben ser completados.")
    return;
    }

    // Recolecta los datos del formulario y valida cada campo
    const formData = {
        classUserID: $("#newUserClass").val().trim(),
        startTime: $("#newStartTime").val().trim(),
        endTime: $("#newEndTime").val().trim(),
        day: $("#newDay").val().trim(),
        className: $("#newClassName").val().trim(),
        categoryClassID: $("#newCategoryClass").val().trim()
    };

    try {
        // Realiza una solicitud POST al servidor.
        const url = './index.php?controller=ClassesPage&action=createClass';
        const result = await performAjaxRequest(url, 'POST', formData);

        if (result.success) {
            showSuccessAndReload(result.message);
        } else {
            showError(result.message);
        }
    } catch (error) {
        console.error('Error al crear la clase:', error);
        showError('Hubo un problema al conectar con el servidor.');
    }
}
