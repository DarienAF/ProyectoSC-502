<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
<?php require './View/fragments/nav_private.php'; ?>

    <h1 class="welcomeMessage">Planes de Entrenamiento</h1>

    <div class="add-training-container">
    <button type="button" class="btn btn-light add-training-btn"
            data-bs-toggle="modal"
            data-bs-target="#createTrainingModal">
        <span class="add-training-icon"><i class="bi bi-database-add"></i></span>Agregar Plan
    </button>
</div>



<?php require './View/fragments/footer.php'; ?>

</body>
</html>