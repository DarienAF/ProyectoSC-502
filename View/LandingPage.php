<!DOCTYPE html>
<html>
<head>
    <title>v-Fit Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./Vista/style/HomeStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<section id="LandingPage">
    <div class="LandingPage">
        <div class="icon"></div>
        <ul class="nav justify-content-end container-fluid">
            <a class="navbar-brand Logo d-none d-lg-block" href="#">
                <img src="http://localhost/dashboard/ProyectoSC-502/Vista/imagen/Logo.svg" width="170" height="140">
            </a>
            <li class="nav-item">
                <a class="active" aria-current="page" href="#">INICIO</a>
            </li>
            <li class="nav-item">
                <a
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controlador=LoginPage&accion=index">INICIAR
                    SESIÓN</a>
            </li>
            <li class="nav-item">
                <a class="redButton " href="http://localhost/dashboard/ProyectoSC-502/index.php?controlador=SignUpPage&accion=index">¡ÚNETE YA!</a>
            </li>
            <li class="nav-item">
                <a  href="#">PRECIOS</a>
            </li>
            <li class="nav-item">
                <a  href="#">CONTACTOS</a>
            </li>
        </ul>

        <div class="TextLandingPage row">
            <div class="col-md-7 col-xxl-4">
                <div class="Eslogan">
                    <p>LIBERA TU</p>
                    <p>POTENCIAL</p>
                </div>
                <div class="EsloganText">
                    <p>Vence a la rutina. Entrena al calibre </p>
                    <p>de los campeones del mundo y ponte</p>
                    <p>en la mejor forma de tu vida</p>
                </div>
            </div>
            <div class="col-md-5">
            </div>
        </div>

    </div>
</section>

<section id="BentoBoxMobile" class="d-block d-lg-none">

    <div class="container mt-5 text-center">
        <h1>Bienvenido a VerveFit Studio, <br>Donde Comienza Tu Viaje Fitness</h1>
        <p class=" gap-1">
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAboutUs"
                    aria-expanded="false" aria-controls="collapseAboutUs">
                Acerca de nosotros
            </button>
        </p>
        <div class="collapse" id="collapseAboutUs">
            <div class="card card-body">
                En VerveFit Studio, creemos en algo más que entrenamientos; creemos en
                transformaciones.
                Sumérgete en
                una comunidad donde la energía se une a la tranquilidad, y la fuerza a la flexibilidad. Si usted
                está aquí para construir músculo, encontrar su zen, o tomar su resistencia a nuevas alturas, tenemos
                el espacio, la comunidad, y la orientación de expertos que necesita para prosperar.
            </div>
        </div>
        <p class="d-inline-flex gap-1">
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWhy"
                    aria-expanded="false" aria-controls="collapseWhy">
                ¿Por qué VerveFit Studio?
            </button>
        </p>
        <div class="collapse" id="collapseWhy">
            <div class="card card-body">
                <ul>
                    <li>Planes de entrenamiento personalizados: Adaptados a Tus objetivos,
                        porque Tu viaje fitness es
                        único.
                    </li>
                    <li>Enfoque holístico del bienestar: Combinando entrenamientos rigurosos
                        con atención plena y
                        nutrición, para un bienestar total.
                    </li>
                    <li>Instalaciones de última generación: Equipadas para todos tus deseos —
                        desde colchonetas de
                        yoga hasta pesas, lo tenemos todo.
                    </li>
                    <li>Comunidad vibrante: Únete a un grupo de personas con ideas afines que se
                        apoyan e inspiran
                        mutuamente cada día
                    </li>
                </ul>
            </div>
        </div>
    </div>

</section>


<section id="BentoBoxDesktop" class="d-none d-lg-block">
    <div class="container">
        <div class="bento-grid text-center">
            <div class="header">
                <div class="box">
                    <h3 class="BentoTitle">Bienvenido a VerveFit Studio</h3>
                </div>
                <div class="box d-none d-lg-block">
                    <img src="http://localhost/dashboard/ProyectoSC-502/Vista/imagen/Logo.svg" alt="Logo" width="100%"
                         height="90%">
                </div>
                <div class="box">
                    <h3 class="BentoTitle">Donde Comienza Tu Viaje Fitness</h3>
                </div>
            </div>
            <div class="text-image">
                <p class="BentoText">En VerveFit Studio, creemos en algo más que entrenamientos; creemos en
                    transformaciones.
                    Sumérgete en
                    una comunidad donde la energía se une a la tranquilidad, y la fuerza a la flexibilidad. Si usted
                    está aquí para construir músculo, encontrar su zen, o tomar su resistencia a nuevas alturas, tenemos
                    el espacio, la comunidad, y la orientación de expertos que necesita para prosperar.</p>
                <span class="Img1"></span>
            </div>
            <div class="image-content">
                <img src="http://localhost/dashboard/ProyectoSC-502/Vista/imagen/BentoImg2.png" alt="Imagen" width="50%"
                     height="32%">
                <div class="content">
                    <h2 class="BentoTitle">¿Por qué VerveFit Studio?</h2>
                    <div class="boxes">
                        <div class="box">
                            <p class="BentoText">Planes de entrenamiento personalizados: Adaptados a Tus objetivos,
                                porque Tu viaje fitness es
                                único.</p>
                        </div>
                        <div class="box">
                            <p class="BentoText">Enfoque holístico del bienestar: Combinando entrenamientos rigurosos
                                con atención plena y
                                nutrición, para un bienestar total.</p>
                        </div>
                        <div class="box">
                            <p class="BentoText">Instalaciones de última generación: Equipadas para todos tus deseos —
                                desde colchonetas de
                                yoga hasta pesas, lo tenemos todo.</p>
                        </div>
                    </div>
                    <div class="box mt-1">
                        <p class="BentoText">Comunidad vibrante: Únete a un grupo de personas con ideas afines que se
                            apoyan e inspiran
                            mutuamente cada día.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section id="UneteYa">
    <div class="container  JoinBanner">
        <div class="mt-5 mb-5 row">

            <div class="col-6 imgJoinBanner" r>

            </div>
            <div class="col-6 textJoinBanner">
                <p class="titleJoinBanner">Tu mejor yo te espera en <span style="color: #F5D3D5"><br>Verve<span
                                style="text-transform: uppercase">Fit</span> Studio.</span></p>
                <p class="mb-4">
                    Da el primer paso hoy.
                    Únete a nosotros y descubre cómo VerveFit Studio puede transformar tu cuerpo, mente y espíritu.
                    Embarquémonos juntos en este viaje, donde cada entrenamiento es un paso hacia un mejor tú.
                </p>
                <a class="redButton">¡ÚNETE YA!</a>
            </div>

        </div>
    </div>
</section>

<section id="Contactanos">
    <div class="container ContactUsBanner mb-5">
        <div class="ContactUsText">
            <p style="font-size: 10px">
            </p>
            <p style="font-size: 10px ; padding-top: 50px" >
                ¿Tienes preguntas, necesitas asistencia o simplemente quieres hablar sobre cómo podemos mejorar tu
                experiencia en nuestro estudio? No dudes en ponerte en contacto con nuestro equipo de soporte al cliente.
                Estamos comprometidos en proporcionarte el mejor servicio y apoyo en cada paso de tu viaje de bienestar y
                fitness.
            </p>
            <p style="font-size: 20px">
                ¡Llámanos hoy!
            </p>
            <p style="font-size: 30px">
                +506 1234 5678
            </p>
            <p style="font-size: 20px">
                ¡En V-Fit Studio, tu satisfacción y bienestar son nuestra prioridad!
            </p>
        </div>
    </div>
</section>

<section id="Footer">
    <div class="Footer text-center">
        <div class="row justify-content-center">
            <div class="col-4 Correo">
                <p style="font-size: 40px;">¿Listo para una vida
                    <span style="color: #D43B3B">asombrosa</span>? </p>
                <p>
                    Info@VerveFitStudio.com
                </p>
            </div>
            <div class="col-4 Redes">
                <p>
                    Síguenos

                </p>
                <p>
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-facebook"></i>
                </p>

                <a>
                    Quienes somos
                </a>

                <a>
                    Términos  & Condiciones
                </a>

                <a>Política de Privacidad</a>

                <a>
                    FAQs
                </a>
            </div>
            <div class="col-4 Icono">
                <img src="http://localhost/dashboard/ProyectoSC-502/Vista/imagen/LogoFooter.png" alt="Imagen" width="210" height="190">
            </div>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>