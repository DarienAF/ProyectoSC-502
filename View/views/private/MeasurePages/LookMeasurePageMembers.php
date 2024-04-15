<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>
<body>
<?php require './View/fragments/nav_private.php'; ?>

<div class="table-container">
    <table class="table table-striped table-dark" id="tablaMedida">
        <thead>
        <tr class="table-titles">
            <th id="sortRegisterDate">Fecha Registro <span class="sort-arrow"></span></th>
            <th id="sortWeight">Peso <span class="sort-arrow"></span></th>
            <th id="sortHeight">Altura <span class="sort-arrow"></span></th>
            <th id="sortAge">Edad <span class="sort-arrow"></span></th>
            <th id="sortFat">Grasa <span class="sort-arrow"></span></th>
            <th id="sortMuscle">Musculo <span class="sort-arrow"></span></th>

        </tr>
        <tr>
            <th><input type="date" id="searchRegisterDate" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchWeight" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchHeight" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchAge" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchFat" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchMuscule" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userMeasures as $measure): ?>
            <tr id="measureRow-<?php echo $measure['id_medida']; ?>">
                <td id="fecha-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['fecha']); ?></td>
                <td id="peso-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['peso']); ?></td>
                <td id="altura-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['altura']); ?></td>
                <td id="edad-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['edad']); ?></td>
                <td id="grasa-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['grasa']); ?></td>
                <td id="musculo-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['musculo']); ?></td>
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