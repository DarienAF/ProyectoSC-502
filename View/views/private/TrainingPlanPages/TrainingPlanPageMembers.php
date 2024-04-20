<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
<?php require './View/fragments/nav_private.php'; ?>

<h1 class="welcomeMessage">Planes de Entrenamiento</h1>

<div class="table-container">
    <div class="calendar-container">
        <header>
            <div class="calendar__title">
                <h1><strong id="weekRange"></strong> <span id="year"></span></h1>
            </div>
        </header>

        <table>
            <thead>
            <tr id="daysOfWeek">
            </tr>
            </thead>
            <tbody id="calendarBody">
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div id="exerciseModal" class="modal excercise-modal" style="display:none;">
    <div class="modal-content">
        <h4 id="modalExerciseName"></h4>
        <p id="modalExerciseInfo"></p>
        <img id="modalExerciseImage" src="" alt="Exercise Image" style="width:100%;">
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>
<script src="./View/js/crudPlanes/trainingPlanPageMembers.js"></script>
</body>

</html>