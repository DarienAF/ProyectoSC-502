<!DOCTYPE html>
<html>

<head>
    <title>v-Fit Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./View/style/private/NewMeasurePageStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

    <?php require './View/fragments/nav_private.php'; ?>


    <div class="content">

        <section class="list">
            <table class="table table-striped table-dark" id="tablaUsuarioM">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Selección</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </section>

        <section id="RegistoMedidas">
            <div class="container">
                <div class="MeasureForm">

                    <h1 class="Titulo">REGISTRO DE MEDIDAS</h1>

                    <form class="Form">

                        <div class="col-md-6">
                            <input type="hidden" class="form-control" id="IdUsuarioMedida">
                        </div>


                        <div class="col-md-6">
                            <label class="form-label label_bold">Peso</label>
                            <input type="number" step="0.01" class="form-control" id="Peso" placeholder="Peso aprox">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label_bold">Altura</label>
                            <input type="number" step="0.01" class="form-control" id="Altura"
                                placeholder="Altura aprox">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label_bold">Edad</label>
                            <input type="number" class="form-control" id="Edad" placeholder="Edad">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label_bold">Grasa</label>
                            <input type="number" step="0.1" class="form-control" id="Grasa" placeholder="Grasa aprox">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label_bold">Musculo</label>
                            <input type="number" step="0.1" class="form-control" id="Musculo"
                                placeholder="Musculo aprox">
                        </div>


                        <div class="col-md-6 text-center">
                            <button id="RegistrarMedida" class="btn btn-danger Boton">Registrar</button>
                        </div>
                    </form>

                </div>
            </div>


        </section>
    </div>
    <?php require './View/fragments/footer.php'; ?>

</body>

</html>