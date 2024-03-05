<!DOCTYPE html>
<html>
<head>
    <title>v-Fit Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./View/style/public/PricePageStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: url('./View/img/public/landingPage/Background.png');
        }
    </style>
</head>
<body>

<?php require './View/fragments/nav.php'; ?>

<section id="Contenido"  class="d-flex justify-content-center align-items-top">>
    <div class="row">
        <div class="col">
            <div class="card pricing-card">
                <div class="card-header text-center">
                    <h4>₡3.000/día</h4>
                </div>
                <div class="card-body text-center">
                    <div class="card_text_container">
                        <h5 class="card-title">Entrenamiento de Un Día</h5>
                        <p class="card-text">Experimenta la transformación personal con un día completo de entrenamiento personalizado. Ideal para probar nuestros servicios y dar el primer paso hacia un cambio significativo.</p>
                    </div>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-buy">Me interesa</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card pricing-card">
                <div class="card-header text-center">
                    <h4>₡20.000/mes</h4>
                </div>
                <div class="card-body text-center">
                    <div class="card_text_container">
                        <h5 class="card-title">Entrenamiento Mensual</h5>
                        <p class="card-text">Un mes de acceso ilimitado a todas nuestras instalaciones y clases grupales. Perfecto para quienes buscan mejorar su bienestar general y establecer una rutina de entrenamiento sólida.</p>
                    </div>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-buy">Me interesa</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card pricing-card">
                <div class="card-header text-center">
                    <h4>₡50.000/3 meses</h4>
                </div>
                <div class="card-body text-center">
                    <div class="card_text_container">
                        <h5 class="card-title">Entrenamiento Trimestral</h5>
                        <p class="card-text">Tres meses de entrenamiento intensivo diseñados para ayudarte a alcanzar tus metas fitness con el apoyo constante de nuestros expertos. Ideal para compromisos a corto plazo con resultados visibles.</p>
                    </div>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-buy">Me interesa</a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card pricing-card">
                <div class="card-header text-center">
                    <h4>₡180.000/año</h4>
                </div>
                <div class="card-body text-center">
                    <div class="card_text_container">
                        <h5 class="card-title">Entrenamiento Anual</h5>
                        <p class="card-text">Nuestro plan más económico y completo. Un año entero para transformar tu vida, con acceso total a todas las clases y asesoramiento personalizado. La inversión más inteligente en tu salud y bienestar a largo plazo.</p>
                    </div>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-buy">Me interesa</a>
                </div>
            </div>
        </div>
    </div>
</section>



<?php require './View/fragments/footer.php'; ?>

</body>
</html>