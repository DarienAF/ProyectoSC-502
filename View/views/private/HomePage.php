<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>
<body>
<?php require './View/fragments/nav_private.php'; ?>

<div class="content">
    <h1 class="welcomeMessage"><?php echo 'Bienvenido ',$current_user?></h1>
</div>

<?php require './View/fragments/footer.php'; ?>

</body>
</html>