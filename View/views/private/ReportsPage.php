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

                        <script>
                        CargarDatosActividad();

                        function CargarDatosActividad() {
                            // Solicitud AJAX al controlador para obtener datos
                            $.ajax({
                                url: './Controller/ReportsPageController.php',
                                method: 'POST',
                                data: {
                                    action: 'traerDatosGrafico'
                                },
                                success: function(data) {
                                    data = JSON.parse(data);

                                    var ctx = document.getElementById('actividadChart').getContext('2d');
                                    var actividadChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Activos', 'Inactivos'],
                                            datasets: [{
                                                label: 'Usuarios',
                                                data: [data.miembros_activos, data
                                                    .miembros_inactivos
                                                ],
                                                backgroundColor: ['rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 99, 132, 0.2)'
                                                ],
                                                borderColor: ['rgba(54, 162, 235, 1)',
                                                    'rgba(255, 99, 132, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                        }
                        </script>
                    </div>
                </div>

                <div class="card card-primary card-outline text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>

                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of the card's
                            content.
                        </p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        <h5 class="m-0">Featured</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>

                <div class="card card-primary card-outline text-white bg-dark mb-3">
                    <div class="card-header">
                        <h5 class="m-0">Featured</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <?php require './View/fragments/footer.php'; ?>

</body>

</html>