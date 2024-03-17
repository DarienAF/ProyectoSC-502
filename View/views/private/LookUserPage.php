<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./View/style/private/LookUserPageStyle.css">

    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url('https://images.pexels.com/photos/669585/pexels-photo-669585.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
        background-size: cover;
        background-repeat: no-repeat;
    }

    
    </style>
</head>

<body>

    <?php require './View/fragments/nav_private.php'; ?>

    <div class="content">

            <table class="table table-striped table-dark" id="tablaUsuario">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Activo</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>


    </div>

    <?php require './View/fragments/footer.php'; ?>

</body>

</html>