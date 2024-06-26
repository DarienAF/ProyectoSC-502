<!DOCTYPE html>
<html>
<?php require './View/fragments/head.php'; ?>
<body>
<?php require './View/fragments/nav.php'; ?>

<div class="content">
    <div class="row align-items-start">
        <div class="col-8 ContactForm">
            <p class="Titulo">Contactanos</p>
            <p class="label_light">Ponte en contacto con nosotros y te responderemos lo antes posible.</p>
            <form class="Form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="firstNameMsg" class="form-label label_bold">Nombre</label>
                        <input type="text" class="form-control" id="firstNameMsg" placeholder="Nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="lastNameMsg" class="form-label label_bold">Apellidos</label>
                        <input type="text" class="form-control" id="lastNameMsg" placeholder="Apellidos">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="emailMsg" class="form-label label_bold">Ingresa tu Correo Electrónico</label>
                    <input type="text" class="form-control" id="emailMsg" placeholder="Correo Electrónico">
                </div>

                <div class="col-md-6">
                    <label for="titleMsg" class="form-label label_bold">Título</label>
                    <input type="text" class="form-control" id="titleMsg" placeholder="Título">
                </div>

                <div class="col-md-12">
                    <label for="contextMsg" class="form-label label_bold">Descripción</label>
                    <textarea type="text" class="form-control" id="contextMsg"
                              placeholder="Envíanos tu duda y nos pondremos en contacto contigo lo antes posible."></textarea>
                </div>

                <div class="col-md-12 text-center">
                    <button id="contactBtn" class="btn btn-danger Boton">Enviar</button>
                </div>
            </form>

        </div>
        <div class="col-3 ContactInfoBox">
            <div class="container">
                <i class="bi bi-geo"></i>
                <div>
                    <p class="label_bold">Dirección:</p>
                    <p class="label_light">Dirección</p>
                </div>
            </div>

            <div class="container">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <p class="label_bold">Teléfono:</p>
                    <p class="label_light">+506 1234 5678</p>
                </div>
            </div>

            <div class="container">
                <i class="bi bi-calendar-date"></i>
                <div>
                    <p class="label_bold">Horario:</p>
                    <p class="label_light">
                        Lunes - Viernes: 6:00 AM - 8:00 PM<br>
                        Sábado 8:00 AM - 6:00 PM<br>
                        Domingo: 8:00 AM - 1:00 PM</p>
                </div>
            </div>

            <div class="container">
                <i class="bi bi-envelope-at"></i>
                <div>
                    <p class="label_bold">E-mail:</p>
                    <p class="label_light" style="color: #DC3545">Info@VerveFitStudio.com</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudMensajes/contactpage.js"></script>

</body>

</html>