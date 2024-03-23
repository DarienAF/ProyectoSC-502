<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./View/style/private/HomePageStyle.css">
</head>
<body>

<?php require './View/fragments/nav_private.php'; ?>

<div class="content">
    <h1 class="welcomeMessage"><?php echo 'Bienvenido ',$current_user?></h1>
</div>

<?php require './View/fragments/footer.php'; ?>

</body>
</html>