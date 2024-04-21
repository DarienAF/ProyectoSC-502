// Función para actualizar la interfaz de usuario con los nuevos datos
function updateUI(id_clase, usuario, hora_inicio, hora_fin, dia, nombre, categoria) {
    $(`#idClase-${id_clase}`).text(id_clase);
    $(`#nombreUsuario-${id_clase}`).text(usuario);
    $(`#horaInicio-${id_clase}`).text(hora_inicio);
    $(`#horaFin-${id_clase}`).text(hora_fin);
    $(`#dia-${id_clase}`).text(dia);
    $(`#nombreClase-${id_clase}`).text(nombre);
    $(`#categoria-${id_clase}`).text(categoria);
}

// Función para los filtros de la tabla
function filterTable() {
    // Obtener valores de los filtros
    let searchId = $('#searchId').val().trim();
    let searchUsername = $('#searchUsername').val().trim().toLowerCase();
    let searchStartTime = $('#searchStartTime').val().trim();
    let searchEndTime = $('#searchEndTime').val().trim();
    let searchDay = $('#searchDay').val().trim();
    let searchClassName = $('#searchClassName').val().trim();
    let searchCategoryname = $('#searchCategoryname').val().trim().toLowerCase();
    let visibleRows = 0;

    // Iterar sobre cada fila de la tabla para aplicar los filtros
    $('#tablaClase tbody tr[id^="classRow-"]').each(function () {
        let isVisible = applyFiltersToRow($(this), {
            searchId, searchUsername, searchStartTime, searchEndTime,
            searchDay, searchClassName, searchCategoryname
        }); 
        if (isVisible) visibleRows++;
    });

    // Mostrar u ocultar la fila "sin resultados" basada en la cantidad de filas visibles
    toggleNoResultRow(visibleRows);
}

function applyFiltersToRow(row, filters) {
    let idText = row.children().eq(0).text().trim();
    let usernameText = row.children().eq(1).text().trim().toLowerCase();
    let startTimeText = row.children().eq(2).text().trim();
    let endTimeText = row.children().eq(3).text().trim();
    let dayText = row.children().eq(4).text().trim();
    let classNameText = row.children().eq(5).text().trim();
    let categoryNameText = row.children().eq(6).text().trim().toLowerCase();

    let isRowVisible = (filters.searchId === "" || idText === filters.searchId) &&
        (filters.searchUsername === "" || usernameText.includes(filters.searchUsername)) &&
        (filters.searchStartTime === "" || startTimeText.includes(filters.searchStartTime)) &&
        (filters.searchEndTime === "" || endTimeText.includes(filters.searchEndTime)) &&
        (filters.searchDay === "" || dayText.includes(filters.searchDay)) &&
        (filters.searchClassName === "" || classNameText.includes(filters.searchClassName)) &&
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
$('#sortUsername').click(() => sortTable(1, 'sortUsername'));
$('#sortStartTime').click(() => sortTable(2, 'sortStartTime'));
$('#sortEndTime').click(() => sortTable(3, 'sortEndTime'));
$('#sortDay').click(() => sortTable(4, 'sortDay'));
$('#sortClassName').click(() => sortTable(5, 'sortClassName'));
$('#sortCategoryName').click(() => sortTable(6, 'sortCategoryName'));

async function createClassData() {
    // Validación de campos
    const createClassFields = ["newClassUserID", "newStartTime", "newEndTime", 
    "newDay", "newClassName", "newCategoryClassID"];
    if (!validateForm(createClassFields)) {
        showWarning("Todos los campos deben ser completados.")
        return;
    }

    // Recolecta los datos del formulario y valida cada campo
    const formData = {
        classUserID: $("#newClassUserID").val().trim(),
        startTime: $("#newStartTime").val().trim(),
        endTime: $("#newEndTime").val().trim(),
        day: $("#newDay").val().trim(),
        className: $("#newClassName").val().trim(),
        categoryClassID: $("#newCategoryClassID").val().trim()
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

$(function () {
    // Función para cargar datos y poblar un select
    async function loadData(selectId, selectedUserId) {
        const selectDOM = $(`#${selectId}`);

        try {
            const response = await fetch('./index.php?controller=ClassesPage&action=MemberUsers');
            const users = await response.json();

            let options = users.map(user => {
                const selectedAttribute = user.id === selectedUserId ? ' selected' : '';
                return `<option value="${user.id}"${selectedAttribute}>${user.nombre} ${user.apellidos}</option>`;
            }).join('');

            selectDOM.html(options);
        } catch (error) {
            console.error('Error loading data:', error);
        }
    }

    loadData('newClassUserID', null);

    async function loadCategories(selectId, selectedCategoryId) {
        const selectDOM = $(`#${selectId}`);
    
        try {
            const response = await fetch('./index.php?controller=ClassesPage&action=CategoryClasses');
            const categories = await response.json();
    
            let options = categories.map(category => {
                const selectedAttribute = category.id === selectedCategoryId ? ' selected' : '';
                return `<option value="${category.id}"${selectedAttribute}>${category.nombre}</option>`;
            }).join('');
    
            selectDOM.html(options);
        } catch (error) {
            console.error('Error loading data:', error);
        }
    }
    
    loadCategories('newCategoryClassID', null);
    
    $("#createClassBTN").click(() => createClassData());

    $('.edit-user-btn').click(async function () {
        const classId = this.getAttribute('class-id');

        try {
            // Realiza una solicitud POST al servidor.
            const url = './index.php?controller=ClassesPage&action=getClassUpdate';
            const result = await performAjaxRequest(url, 'POST', {id_clase: classId});

            if (result) {
                $('#classId').val(result.id_clase);
                loadData('classUserID', result.id_Usuario);
                $("#startTime").val(result.hora_inicio);
                $("#endTime").val(result.hora_fin);
                $("#day").val(result.dia);
                $("#className").val(result.nombre_clase);
                loadCategories("categoryClassID", result.id_categoria); // Le puse # por error. ya lo corregi
            }
        } catch (error) {
            console.error('Error fetching class details:', error);
        }
    });

    $('#updateClassDataBtn').click(async function () {

        // Validación de campos
        const updateClassFields = ["classId", "classUserID", "startTime", "endTime", "day", "className", "categoryClassID"];
        if (!validateForm(updateClassFields)) {
            showWarning("Todos los campos deben ser completados.")
            return;
        }

        // Recolecta los valores de los campos del formulario
        const formData = {
            id_clase: $('#classId').val(),
            classUserID: $('#classUserID').val(),
            starthour: $('#startTime').val(),
            endhour: $('#endTime').val(),
            day: $('#day').val(),
            classname: $('#className').val(),
            categoryClassID: $('#categoryClassID').val()
        };

        try {
            // Realiza una solicitud POST al servidor.
            const url = './index.php?controller=ClassesPage&action=updateClass';
            const result = await performAjaxRequest(url, 'POST', formData);

            if (result.success) {
                if (result.changed) {
                    // Actualiza la interfaz de usuario con los nuevos datos
                    updateUI(formData.id_clase, formData.classCategoryID, result.Usuario, 
                        formData.starthour, formData.endhour, formData.day, formData.classname, formData.categoryClassID);
                }
                let message = result.changed ? 'Los cambios fueron guardados con éxito.' : 'No se ingresaron cambios al usuario.';
                Swal.fire({
                    title: '¡Éxito!',
                    text: message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        $('#editClassModal').modal('hide');
                    }
                });
            } else {
                showError(result.message || 'Hubo un problema al guardar los cambios.')
            }
        } catch (error) {
            console.error('Error updating class:', error);
            showError('Hubo un problema al conectar con el servidor.');
        }
    });
});
