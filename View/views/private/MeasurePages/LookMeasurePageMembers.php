<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>
<body>
<?php require './View/fragments/nav_private.php'; ?>

<h1 class="welcomeMessage">Mis Medidas</h1>

<div class="table-container">
    <table class="table table-striped table-dark" id="tablaMedida">
        <thead>
        <tr class="table-titles">
            <th>Fecha Registro</span></th>
            <th>Peso</th>
            <th>Altura</th>
            <th>Edad</th>
            <th>Grasa</th>
            <th>Musculo</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($userMeasures as $measure): ?>
            <tr id="measureRow-<?php echo $measure['id_medida']; ?>">
                <td id="fecha-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['fecha']); ?></td>
                <td id="peso-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['peso']); ?>
                    kg
                </td>
                <td id="altura-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['altura']); ?>
                    cm
                </td>
                <td id="edad-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['edad']); ?>
                    años
                </td>
                <td id="grasa-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['grasa']); ?>
                    %
                </td>
                <td id="musculo-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['musculo']); ?>
                    %
                </td>
            </tr>
        <?php endforeach; ?>

        <tr id="no-result" style="display: none;">
            <td colspan="10">
                <div class="no-result-container">
                    <img src="./View/img/private/look-userPage/no_results.png" alt="No hay resultados"/>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudMedidas/lookMeasurePage.js"></script>

</body>
</html>