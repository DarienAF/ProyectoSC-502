<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./View/style/HomePageStyle.css">
    <style>
        body {
            background-color: white;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
    </style>
</head>
<body>

<?php require 'elements\nav.php'; ?>

<div class="main container">
    <p class="welcomeMessage"><?php echo 'Bienvenido ',$current_user ?></p>

    <a href="./index.php?controller=LoginPage&action=LogOut"><button>Cerrar Sesion</button></a>

</div>


<?php require 'elements\footer.php'; ?>

</body>
</html>