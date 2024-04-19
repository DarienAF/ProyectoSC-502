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
                    // Aquí puedes añadir headers adicionales si son necesarios
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const exercises = await response.json();
            populateExerciseDropdown(exercises);
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

        // Ordena los ejercicios alfabéticamente por grupo muscular y luego por nombre de ejercicio
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
});
