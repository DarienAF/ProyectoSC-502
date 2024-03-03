<!DOCTYPE html>
<html>

<head>
    <title>v-Fit Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./View/style/private/ProfilePageStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: url('https://img.freepik.com/free-photo/dumbbells-floor-gym-ai-generative_123827-23744.jpg?size=626&ext=jpg&ga=GA1.1.1395880969.1709337600&semt=ais');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <?php require './View/fragments/nav_private.php'; ?>

    <section id="Profile">
        <div class="container profile-info">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4">Perfil de Miembro</h1>
                    <div class="profile-info">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" value="Nombre del Cliente" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" value="Apellido del Cliente"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="correo" value="cliente@example.com"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" value="Número de Teléfono"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contraseña" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="password" value="********" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="imagen" class="form-label">Imagen de Perfil:</label>
                                <input type="file" class="form-control" id="imagen" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="peso" class="form-label">Peso (kg):</label>
                                <input type="number" class="form-control" id="peso" value="70" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="altura" class="form-label">Altura (cm):</label>
                                <input type="number" class="form-control" id="altura" value="170" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="objetivo" class="form-label">Objetivo:</label>
                                <select class="form-select" id="objetivo" disabled>
                                    <option selected>Perder peso</option>
                                    <option>Ganar masa muscular</option>
                                    <option>Mantenerse en forma</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="actividad" class="form-label">Nivel de Actividad:</label>
                                <select class="form-select" id="actividad" disabled>
                                    <option selected>Sedentario</option>
                                    <option>Levemente Activo</option>
                                    <option>Moderadamente Activo</option>
                                    <option>Muy Activo</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" id="editBtn">Editar Perfil</button>
                            <!-- SOLO SE MUESTRAN DESPUÉS DE DARLE CLICK A EDITAR PERFIL -->
                            <button class="btn btn-primary" id="saveBtn" style="display: none;">Guardar</button>
                            <button class="btn btn-primary" id="cancelBtn" style="display: none;">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <?php require './View/fragments/footer.php'; ?>

    <script>

        var editarBtn = document.getElementById("editBtn");
        var guardarBtn = document.getElementById("saveBtn");
        var cancelarBtn = document.getElementById("cancelBtn");

        var nombreInput = document.getElementById("nombre");
        var apellidoInput = document.getElementById("apellido");
        var telefonoInput = document.getElementById("telefono");
        var passwordInput = document.getElementById("password");
        var correoInput = document.getElementById("correo");
        var pesoInput = document.getElementById("peso");
        var imagenInput = document.getElementById("imagen");
        var alturaInput = document.getElementById("altura");
        var objetivoSelect = document.getElementById("objetivo");
        var actividadSelect = document.getElementById("actividad");



        editarBtn.addEventListener("click", function () {
            guardarBtn.style.display = "inline-block";
            cancelarBtn.style.display = "inline-block";
            editarBtn.style.display = "none";


            nombreInput.readOnly = false;
            apellidoInput.readOnly = false;
            correoInput.readOnly = false;
            telefonoInput.readOnly = false;
            passwordInput.readOnly = false;
            pesoInput.readOnly = false;
            alturaInput.readOnly = false;
            imagenInput.disabled = false;
            objetivoSelect.disabled = false;
            actividadSelect.disabled = false;
        });

        cancelarBtn.addEventListener("click", function () {
            guardarBtn.style.display = "none";
            cancelarBtn.style.display = "none";
            editarBtn.style.display = "inline-block";


            nombreInput.readOnly = true;
            apellidoInput.readOnly = true;
            correoInput.readOnly = true;
            telefonoInput.readOnly = true;
            passwordInput.readOnly = true;
            pesoInput.readOnly = true;
            alturaInput.readOnly = true;
            imagenInput.disabled = true;
            objetivoSelect.disabled = true;
            actividadSelect.disabled = true;
        });



    </script>

</body>

</html>