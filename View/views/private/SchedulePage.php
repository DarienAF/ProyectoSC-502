<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>




    <div class="mb-4 title-container">
        <h1>Horarios de Clases</h1>
    </div>
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

    <div id="classModal" class="modal class-modal" style="display:none;">
        <div class="modal-content">
            <h4 id="modalClassName"></h4>
            <p id="modalClassCoach"></p>
            <p id="modalClassStartTime"></p>
            <p id="modalClassEndTime"></p>
            <p id="modalClassCategory"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger cancel-button">
                Cancelar Clase
            </button>
        </div>
    </div>




    <?php require './View/fragments/footer.php'; ?>
    <script src="./View/js/crudClases/scheduleClassesPage.js"></script>


</body>

</html>