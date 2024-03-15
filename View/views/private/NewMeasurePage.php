<!DOCTYPE html>
<html>

<head>
    <title>v-Fit Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./View/style/private/NewMeasurePage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url('https://img.freepik.com/foto-gratis/filas-pesas-metal-rack-gimnasio-club-deportivo-equipo-entrenamiento-peso_1439-11.jpg?t=st=1710123568~exp=1710127168~hmac=43b16f32a698db38a55075c73222e8abcdee7349997c3019b20b0adcece54f22&w=996');
        background-size: cover;
        background-repeat: no-repeat;
    }
    </style>
</head>

<body>

    <?php require './View/fragments/nav_private.php'; ?>

<div class="content">
    <section id="Contenido" class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-8 align-self-center MeasureForm">

                    <h1 class="Titulo">REGISTRO DE MEDIDAS</h1>

                    <form class="Form">

                        <div class="col-md-6">
                            <label class="form-label label_bold">Id Usuario</label>
                            <input type="number" class="form-control" id="IdUsuarioMedida" placeholder="IdUsuario">
                        </div>


                        <div class="col-md-6">
                            <label class="form-label label_bold">Peso</label>
                            <input type="number" step="0.01" class="form-control" id="Peso"
                                placeholder="Peso aprox">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label_bold">Altura</label>
                            <input type="number" step="0.01" class="form-control" id="Altura"
                                placeholder="Altura aprox">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label_bold">Edad</label>
                            <input type="number" class="form-control" id="Edad"
                                placeholder="Edad">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label_bold">Grasa</label>
                            <input type="number" step="0.1" class="form-control" id="Grasa"
                                placeholder="Grasa aprox">
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
        </div>


    </section>
</div>
    <?php require './View/fragments/footer.php'; ?>

</body>

</html>