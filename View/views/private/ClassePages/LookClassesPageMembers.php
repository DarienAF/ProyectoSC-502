<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <div class="content">

        <h1 class="welcomeMessage">Clases</h1>

        <!-- Vista de Clases Miembros -->

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Ver Detalles de la Clase-->
        <div class="modal fade" id="viewClassDetails" tabindex="-1" aria-labelledby="viewClassDetailsLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalles de la Clase</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="trainerName" class="form-label">Nombre del Entrenador</label>
                            <input type="text" class="form-control" id="trainerName" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="startTime" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" id="startTime" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="endTime" class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" id="endTime" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="day" class="form-label">Día</label>
                            <input type="text" class="form-control" id="day" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="className" class="form-label">Nombre de la Clase</label>
                            <input type="text" class="form-control" id="className" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="cancelClass()">
                            Cancelar Clase
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require './View/fragments/footer.php'; ?>

    <script src="./View/js/crudClases/lookClassesPageMembers.js"></script>

</body>

</html>