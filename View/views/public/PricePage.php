<!DOCTYPE html>
<html>
<?php require './View/fragments/head.php'; ?>

<body>
    <?php require './View/fragments/nav.php'; ?>

    <div class="content">
        <div class="row">
            <div class="col">
                <div class="card pricing-card">
                    <div class="card-header text-center">
                        <h4>₡3.000/día</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="card_text_container">
                            <h5 class="card-title">Entrenamiento de Un Día</h5>
                            <p class="card-text">Experimenta la transformación personal con un día completo de
                                entrenamiento
                                personalizado. Ideal para probar nuestros servicios y dar el primer paso hacia un cambio
                                significativo.</p>
                        </div>
                        <a class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#ModalDia">
                            Me interesa</a>
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
                            <p class="card-text">Un mes de acceso ilimitado a todas nuestras instalaciones y clases
                                grupales. Perfecto para quienes buscan mejorar su bienestar general y establecer una
                                rutina
                                de entrenamiento sólida.</p>
                        </div>
                        <a class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#ModalMensual">Me interesa</a>
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
                            <p class="card-text">Tres meses de entrenamiento intensivo diseñados para ayudarte a
                                alcanzar
                                tus metas fitness con el apoyo constante de nuestros expertos. Ideal para compromisos a
                                corto plazo con resultados visibles.</p>
                        </div>
                        <a class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#ModalTrim">Me interesa</a>

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
                            <p class="card-text">Nuestro plan más económico y completo. Un año entero para transformar
                                tu
                                vida, con acceso total a todas las clases y asesoramiento personalizado. La inversión
                                más
                                inteligente en tu salud y bienestar a largo plazo.</p>
                        </div>
                        <a class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#ModalAnual">Me interesa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dia -->
    <div class="modal fade" id="ModalDia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Entrenamiento de un Día</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="./View/img/public/pricePage/price-card-day.jpg"
                                class="img-fluid rounded-start  modal-image" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Descripción</h5>
                                <p class="card-text">Disfruta un día completo de entrenamiento personalizado. 
                                Ideal para quienes desean probar nuestros servicios antes de comprometerse a largo plazo.</p>


                                <div class="row">
                                    <div class="col">
                                        <ul>
                                            <h6>Incluye:</h6>
                                            <li>Entrenamiento Personalizado</li>
                                            <li>Ingreso a determinadas instalaciones</li>
                                            <li>Asesoramiento Básico</li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul>
                                        <h6>No Incluye:</h6>
                                            <li>Acceso Continuo a Instalaciones</li>
                                            <li>Beneficios a Largo Plazo</li>

                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-danger">Unirme ya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Mensual -->
    <div class="modal fade" id="ModalMensual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Entrenamiento de un Día</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="./View/img/public/pricePage/price-card-month.jpg"
                                class="img-fluid rounded-start modal-image" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-danger">Unirme ya</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Trimestral -->
    <div class="modal fade" id="ModalTrim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Entrenamiento de un Día</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="./View/img/public/pricePage/price-card-trim.jpg"
                                class="img-fluid rounded-start  modal-image" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-danger">Unirme ya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Anual -->
    <div class="modal fade" id="ModalAnual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Entrenamiento de un Día</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="./View/img/public/pricePage/price-card-year.jpg"
                                class="img-fluid rounded-start  modal-image" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="./index.php?controller=SignUpPage&action=index" class="btn btn-danger">Unirme ya</a>
                </div>
            </div>
        </div>
    </div>

    <?php require './View/fragments/footer.php'; ?>

</body>

</html>