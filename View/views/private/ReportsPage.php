<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <div class="content">
        <h1 class="welcomeMessage">Reportes</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Grafico Miembros Activos e Inactivos</h5>
                        <canvas id="actividadChart"></canvas>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    </div>
                </div>

                <div class="card card-primary card-outline text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Clases mas asistidas</h5>

                        <canvas id="myChart"></canvas>

                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        <h5 class="m-0">Categorias de Clases mas Populares </h5>
                    </div>
                    <div class="card-body">
                    <canvas id="myChart2"></canvas>
                    </div>
                </div>

                <div class="card card-primary card-outline text-white bg-dark mb-3">
                    <div class="card-header">
                        <h5 class="m-0">Promedio Pesos de Miembros</h5>
                    </div>
                    <div class="card-body">
                    <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <?php require './View/fragments/footer.php'; ?>
    <script src="./View/js/charts.js"></script>
</body>

</html>