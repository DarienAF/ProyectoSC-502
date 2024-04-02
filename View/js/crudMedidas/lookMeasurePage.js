// Función para actualizar la interfaz de usuario con los nuevos datos
function updateUI(measureId, userId, username, peso, altura, edad, grasa, musculo) {
    $(`#id-${measureId}`).text(measureId);
    $(`#userId-${measureId}`).text(userId);
    $(`#username-${measureId}`).text(username);
    $(`#peso-${measureId}`).text(peso);
    $(`#altura-${measureId}`).text(altura);
    $(`#edad-${measureId}`).text(edad);
    $(`#grasa-${measureId}`).text(grasa);
    $(`#musculo-${measureId}`).text(musculo);
}

// Función para los filtros de la tabla
function filterTable() {
    // Obtener valores de los filtros
    let searchId = $('#searchId').val().trim();
    let searchUserId = $('#searchUserId').val().trim();
    let searchUsername = $('#searchUsername').val().trim().toLowerCase();
    let searchRegisterDate = $('#sortRegisterDate').val().trim();
    let searchWeight = $('#searchWeight').val().trim();
    let searchHeight = $('#searchHeight').val().trim();
    let searchAge = $('#searchAge').val().trim();
    let searchFat = $('#searchFat').val().trim();
    let searchMuscule = $('#searchMuscule').val().trim();

    let visibleRows = 0;

    // Iterar sobre cada fila de la tabla para aplicar los filtros
    $('#tablaMedida tbody tr[id^="measureRow-"]').each(function () {
        let isVisible = applyFiltersToRow($(this), {
            searchId, searchUserId, searchUsername, searchRegisterDate,
            searchWeight, searchHeight, searchAge, searchFat, searchMuscule
        });
        if (isVisible) visibleRows++;
    });

    // Mostrar u ocultar la fila "sin resultados" basada en la cantidad de filas visibles
    toggleNoResultRow(visibleRows);
}

// Función para aplicar los filtros a una fila específica
function applyFiltersToRow(row, filters) {
    let idText = row.children().eq(0).text().trim();
    let usuarioIDText = row.children().eq(1).text().trim();
    let usernameText = row.children().eq(2).text().trim().toLowerCase();
    let registerDateText = row.children().eq(3).text().trim();
    let weightText = row.children().eq(4).text().trim();
    let heightText = row.children().eq(5).text().trim();
    let ageText = row.children().eq(6).text().trim();
    let fatText = row.children().eq(7).text().trim();
    let muscleText = row.children().eq(8).text().trim();

    let isRowVisible = (filters.searchId === "" || idText === filters.searchId) &&
        (filters.searchUserId === "" || usuarioIDText === filters.searchUserId) &&
        (filters.searchUsername === "" || usernameText.includes(filters.searchUsername)) &&
        (filters.searchRegisterDate === "" || registerDateText.includes(filters.searchRegisterDate)) &&
        (filters.searchWeight === "" || weightText.includes(filters.searchWeight)) &&
        (filters.searchHeight === "" || heightText.includes(filters.searchHeight)) &&
        (filters.searchAge === "" || ageText.includes(filters.searchAge)) &&
        (filters.searchFat === "" || fatText.includes(filters.searchFat)) &&
        (filters.searchMuscule === "" || muscleText.includes(filters.searchMuscule));

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
    const table = $('#tablaMedida');
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
$('#sortRegisterDate').click(() => sortTable(3, 'sortRegisterDate'));
$('#sortWeight').click(() => sortTable(4, 'sortWeight'));
$('#sortHeight').click(() => sortTable(5, 'sortHeight'));
$('#sortAge').click(() => sortTable(6, 'sortAge'));
$('#sortFat').click(() => sortTable(7, 'sortFat'));
$('#sortMuscle').click(() => sortTable(8, 'sortMuscle'));

// Función que crea una medida nueva
async function createMeasureData() {

    // Validación de campos
    const createMeasureFields = ["newMeasureUserID", "newWeight", "newHeight", "newAge", "newFat", "newMuscle"];
    if (!validateForm(createMeasureFields)) {
        showWarning("Todos los campos deben ser completados.")
        return;
    }

    // Recolecta los datos del formulario y valida cada campo
    const formData = {
        userId: $("#newMeasureUserID").val().trim(),
        altura: $("#newWeight").val().trim(),
        peso: $("#newHeight").val().trim(),
        edad: $("#newAge").val().trim(),
        grasa: $("#newFat").val().trim(),
        musculo: $("#newMuscle").val().trim()
    };


    // Realiza una solicitud POST al servidor con los datos del formulario.
    try {
        const response = await fetch('./index.php?controller=LookMeasurePage&action=createMeasure', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();
        if (result.success) {
            showSuccessAndReload(result.message);
        } else {
            showError(result.message);
        }
    } catch (error) {
        console.error('Error al crear el usuario:', error);
        showError('Hubo un problema al conectar con el servidor.');
    }
}

$(function () {
    // Función para cargar datos y poblar un select
    async function loadData(selectId, selectedUserId) {
        const selectDOM = $(`#${selectId}`);

        try {
            const response = await fetch('./index.php?controller=LookMeasurePage&action=MemberUsers');
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

    loadData('newMeasureUserID', null);

    $("#createMeasureBTN").click(() => createMeasureData());

    $('.edit-user-btn').click(async function () {
        const measureId = this.getAttribute('measure-id');

        try {
            const response = await fetch('./index.php?controller=LookMeasurePage&action=getMeasureUpdate', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id_medida: measureId})
            });

            const result = await response.json();

            if (result) {
                $('#measureId').val(result.id_medida);
                loadData('measureUserID', result.id_Usuario);
                $("#weight").val(result.peso);
                $("#height").val(result.altura);
                $("#age").val(result.edad);
                $("#fat").val(result.grasa);
                $("#muscle").val(result.musculo);
            }
        } catch (error) {
            console.error('Error fetching measure details:', error);
        }
    });

    $('#updateMeasureDataBtn').click(async function () {

        // Validación de campos
        const updateMeasureFields = ["measureId", "measureUserID", "weight", "height", "age", "fat", "muscle"];
        if (!validateForm(updateMeasureFields)) {
            showWarning("Todos los campos deben ser completados.")
            return;
        }

        // Recolecta los valores de los campos del formulario
        const formData = {
            measureId: $('#measureId').val(),
            measureUserID: $('#measureUserID').val(),
            weight: $('#weight').val(),
            height: $('#height').val(),
            age: $('#age').val(),
            fat: $('#fat').val(),
            muscle: $('#muscle').val()
        };

        // Realiza una solicitud POST al servidor con los datos del formulario.
        try {
            const response = await fetch('./index.php?controller=LookMeasurePage&action=updateMeasure', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (result.success) {
                if (result.changed) {
                    // Actualiza la interfaz de usuario con los nuevos datos
                    updateUI(formData.measureId, formData.measureUserID, result.Usuario, formData.weight, formData.height, formData.age, formData.fat, formData.muscle);
                }
                let message = result.changed ? 'Los cambios fueron guardados con éxito.' : 'No se ingresaron cambios al usuario.';
                Swal.fire({
                    title: '¡Éxito!',
                    text: message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        $('#editMeasureModal').modal('hide');
                    }
                });
            } else {
                showError(result.message || 'Hubo un problema al guardar los cambios.')
            }
        } catch (error) {
            console.error('Error updating measure:', error);
            showError('Hubo un problema al conectar con el servidor.')
        }
    });
});
