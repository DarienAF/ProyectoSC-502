-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 07:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyectosc-502`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria`
(
    `id_categoria`     int(11)      NOT NULL,
    `nombre_categoria` varchar(100) NOT NULL,
    `imagen_categoria` varchar(1024) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `imagen_categoria`)
VALUES (1, 'Yoga', 'https://d1copppaysyuhz.cloudfront.net/classes/yoga.png'),
       (2, 'Pilates', 'https://d1copppaysyuhz.cloudfront.net/classes/pilates.png'),
       (3, 'Spinning', 'https://d1copppaysyuhz.cloudfront.net/classes/spinning.png'),
       (4, 'Boxing', 'https://d1copppaysyuhz.cloudfront.net/classes/box.png'),
       (5, 'CrossFit', 'https://d1copppaysyuhz.cloudfront.net/classes/crossfit.png'),
       (6, 'HIIT', 'https://d1copppaysyuhz.cloudfront.net/classes/hiit.png'),
       (7, 'Zumba', 'https://d1copppaysyuhz.cloudfront.net/classes/zumba.jpg'),
       (8, 'General', 'https://d1copppaysyuhz.cloudfront.net/classes/general_workout.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `clases`
--

CREATE TABLE `clases`
(
    `id_clase`     int(11) NOT NULL,
    `id_usuario`   int(11)      DEFAULT NULL,
    `hora_inicio`  time         DEFAULT NULL,
    `hora_fin`     time         DEFAULT NULL,
    `dia`          varchar(50)  DEFAULT NULL,
    `nombre_clase` varchar(100) DEFAULT NULL,
    `id_categoria` int(11)      DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `clases`
--

INSERT INTO `clases` (`id_clase`, `id_usuario`, `hora_inicio`, `hora_fin`, `dia`, `nombre_clase`, `id_categoria`)
VALUES (1, 4, '09:00:00', '10:00:00', 'Lunes', 'Clase de Yoga', 1),
       (2, 7, '17:00:00', '18:00:00', 'Viernes', 'Yoga Flow', 1),
       (3, 4, '10:00:00', '11:00:00', 'Martes', 'Clase de Pilates', 2),
       (4, 6, '08:00:00', '09:00:00', 'Miércoles', 'Clase de Spinning', 3),
       (5, 6, '12:00:00', '13:00:00', 'Domingo', 'Spinning Intenso', 3),
       (6, 7, '18:00:00', '19:00:00', 'Jueves', 'Entrenamiento de Boxeo', 4),
       (7, 5, '19:00:00', '20:00:00', 'Sábado', 'Boxeo Fitness', 4),
       (8, 4, '17:00:00', '18:00:00', 'Viernes', 'Sesión de CrossFit', 5),
       (9, 7, '10:00:00', '11:00:00', 'Domingo', 'CrossFit en Grupo', 5),
       (10, 4, '19:00:00', '20:00:00', 'Lunes', 'Clase de Zumba', 7),
       (11, 7, '20:00:00', '21:00:00', 'Miércoles', 'Zumba Fitness', 7),
       (12, 4, '07:00:00', '08:00:00', 'Sábado', 'Clase de HIIT', 6),
       (13, 25, '09:00:00', '10:30:00', 'Domingo', 'Clase Grupal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ejercicio`
--

CREATE TABLE `ejercicio`
(
    `id_ejercicio`     int(11)      NOT NULL,
    `nombre_ejercicio` varchar(100) NOT NULL,
    `grupo_muscular`   varchar(50)   DEFAULT NULL,
    `imagen_ejercicio` varchar(1024) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `ejercicio`
--

INSERT INTO `ejercicio` (`id_ejercicio`, `nombre_ejercicio`, `grupo_muscular`, `imagen_ejercicio`)
VALUES (1, 'Press de banca', 'Pecho', 'https://d1copppaysyuhz.cloudfront.net/exercises/bench-press.webp'),
       (2, 'Sentadilla', 'Piernas', 'https://d1copppaysyuhz.cloudfront.net/exercises/squat.webp'),
       (3, 'Peso muerto', 'Espalda', 'https://d1copppaysyuhz.cloudfront.net/exercises/deadlift.webp'),
       (4, 'Curl de bíceps', 'Bicep', 'https://d1copppaysyuhz.cloudfront.net/exercises/bicep-curl.webp'),
       (5, 'Elevaciones laterales', 'Hombro', 'https://d1copppaysyuhz.cloudfront.net/exercises/lateral-raise.webp'),
       (6, 'Extension de tricep', 'Tricep', 'https://d1copppaysyuhz.cloudfront.net/exercises/tricep-extension.webp'),
       (7, 'Jalón lateral', 'Espalda', 'https://d1copppaysyuhz.cloudfront.net/exercises/lat-pulldown.webp');

-- --------------------------------------------------------

--
-- Table structure for table `medidas`
--

CREATE TABLE `medidas`
(
    `id_medida`      int(11)   NOT NULL,
    `id_usuario`     int(11)            DEFAULT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
    `peso`           float              DEFAULT NULL,
    `altura`         float              DEFAULT NULL,
    `edad`           int(11)            DEFAULT NULL,
    `grasa`          float              DEFAULT NULL,
    `musculo`        float              DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `medidas`
--

INSERT INTO `medidas` (`id_medida`, `id_usuario`, `fecha_registro`, `peso`, `altura`, `edad`, `grasa`, `musculo`)
VALUES (1, 8, '2024-04-22 01:54:27', 75.5, 175, 30, 20.5, 65.2),
       (2, 9, '2024-04-22 01:54:27', 80.2, 180, 32, 22.1, 63.8),
       (3, 10, '2024-04-22 01:54:27', 70.8, 170, 28, 18.7, 67.5),
       (4, 11, '2024-04-22 01:54:27', 85.3, 185, 35, 25.3, 60.5),
       (5, 17, '2024-01-28 01:54:27', 78.9, 180, 29, 21.8, 64.3),
       (6, 18, '2024-01-21 01:54:27', 82.1, 175, 31, 23.5, 61.7),
       (7, 19, '2024-01-21 01:54:27', 65.4, 165, 27, 19.2, 68),
       (8, 20, '2024-01-02 01:54:27', 70, 170, 30, 20, 66.5),
       (9, 21, '2024-01-08 01:54:27', 75.8, 175, 28, 22, 62),
       (10, 22, '2024-01-10 01:54:27', 85.5, 180, 33, 24.5, 60),
       (11, 17, '2024-02-09 01:54:27', 77.5, 179, 28, 21.5, 64),
       (12, 17, '2024-03-16 01:54:27', 76.8, 178, 27, 20.9, 63.5),
       (13, 17, '2024-04-20 01:54:27', 78.3, 180, 30, 22, 64.5),
       (14, 18, '2024-02-25 01:54:27', 81, 174, 30, 23, 61),
       (15, 18, '2024-03-21 01:54:27', 82.8, 176, 32, 23.8, 61.8),
       (16, 18, '2024-04-22 01:54:27', 80.5, 172, 29, 22.5, 60.5),
       (17, 19, '2024-02-11 01:54:27', 64, 164, 26, 18.5, 67),
       (18, 19, '2024-03-09 01:54:27', 63.2, 163, 25, 18, 66.5),
       (19, 19, '2024-04-22 01:54:27', 65.8, 166, 28, 19.8, 68.5),
       (20, 20, '2024-03-14 01:54:27', 71.5, 171, 31, 20.5, 67.2),
       (21, 20, '2024-02-11 01:54:27', 69.8, 169, 29, 19.8, 66),
       (22, 20, '2024-04-22 01:54:27', 70.2, 170, 30, 20, 66.5),
       (23, 21, '2024-02-09 01:54:27', 76.3, 174, 27, 21, 62.5),
       (24, 21, '2024-03-14 01:54:27', 77, 175, 28, 21.5, 63),
       (25, 21, '2024-04-22 01:54:27', 75.5, 173, 26, 20.5, 62),
       (26, 22, '2024-02-16 01:54:27', 86, 181, 34, 25, 59.5),
       (27, 22, '2024-04-22 01:54:27', 84.5, 179, 32, 24, 59),
       (28, 22, '2024-04-22 01:54:27', 85.8, 180, 33, 24.5, 59.8),
       (29, 22, '2024-03-15 01:54:27', 84.5, 179, 32, 24, 59),
       (30, 17, '2024-03-16 01:54:27', 76.8, 178, 27, 20.9, 63.5);

-- --------------------------------------------------------

--
-- Table structure for table `mensajes`
--

CREATE TABLE `mensajes`
(
    `id_mensaje`  int(11)                                 NOT NULL,
    `nombreM`     varchar(50)                                      DEFAULT NULL,
    `correo`      varchar(100)                                     DEFAULT NULL,
    `titulo`      varchar(100)                                     DEFAULT NULL,
    `contexto`    text                                             DEFAULT NULL,
    `fecha_envio` timestamp                               NOT NULL DEFAULT current_timestamp(),
    `leido`       tinyint(1)                                       DEFAULT 0,
    `estado`      enum ('recibido','enviado','archivado') NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `nombreM`, `correo`, `titulo`, `contexto`, `fecha_envio`, `leido`, `estado`)
VALUES (1, 'Juan Perez', 'juan@example.com', 'Consulta sobre Membresia',
        'Hola, estoy interesado en obtener informacion sobre las membresias disponibles en el gimnasio. ¿Podrian enviarme detalles sobre los precios y servicios incluidos? ¡Gracias!',
        '2024-04-22 02:24:29', 0, 'recibido'),
       (2, 'Maria Rodriguez', 'maria@example.com', 'Reserva de Clase de Pilates',
        'Buen dia, me gustaria reservar una clase de Pilates para el proximo martes a las 10:00 am. ¿Esta disponible esa clase? Quedo atenta a su respuesta. Saludos cordiales.',
        '2024-04-22 02:24:29', 0, 'recibido'),
       (3, 'Pedro Gomez', 'pedro@example.com', 'Queja sobre limpieza',
        'Hola, quiero expresar mi preocupacion acerca de la limpieza en el area de pesas. He notado que no se realiza la limpieza con la frecuencia necesaria. ¿Podrian tomar medidas al respecto? Gracias.',
        '2024-04-22 02:24:29', 0, 'recibido'),
       (4, 'Laura Sanchez', 'laura@example.com', 'Confirmacion de Reserva de Clase de Yoga',
        'Estimado equipo del gimnasio, les escribo para confirmar mi reserva de la clase de Yoga programada para el proximo viernes a las 6:00 pm. Quedo atenta a su confirmacion. Saludos.',
        '2024-04-22 02:24:29', 0, 'recibido'),
       (5, 'Ana Lopez', 'ana@example.com', 'Recordatorio de Pago de Membresia',
        'Buenos dias, este es un recordatorio amistoso para informarles que el pago de mi membresia vence el proximo viernes. ¿Podrian proporcionarme detalles sobre como proceder con el pago? ¡Gracias!',
        '2024-04-22 02:24:29', 0, 'recibido');

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes`
(
    `id_plan`           int(11) NOT NULL,
    `nombre_plan`       varchar(100) DEFAULT NULL,
    `id_usuario`        int(11)      DEFAULT NULL,
    `id_plan_ejercicio` int(11)      DEFAULT NULL,
    `dia`               varchar(50)  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id_plan`, `nombre_plan`, `id_usuario`, `id_plan_ejercicio`, `dia`)
VALUES (1, 'Plan de Entrenamiento Semanal', 17, 1, 'Lunes'),
       (2, 'Rutina de Ejercicios', 18, 2, 'Martes'),
       (3, 'Entrenamiento Funcional', 19, 3, 'Miércoles'),
       (4, 'Plan de Fitness', 20, 4, 'Jueves'),
       (5, 'Entrenamiento Cardiovascular', 21, 5, 'Viernes'),
       (6, 'Rutina de Fuerza', 17, 6, 'Sábado');

-- --------------------------------------------------------

--
-- Table structure for table `plan_ejercicios`
--

CREATE TABLE `plan_ejercicios`
(
    `id_plan_ejercicio` int(11) NOT NULL,
    `id_ejercicio`      int(11) DEFAULT NULL,
    `series`            int(11) DEFAULT NULL,
    `repeticiones`      int(11) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `plan_ejercicios`
--

INSERT INTO `plan_ejercicios` (`id_plan_ejercicio`, `id_ejercicio`, `series`, `repeticiones`)
VALUES (1, 1, 3, 10),
       (2, 2, 4, 12),
       (3, 3, 3, 8),
       (4, 4, 4, 12),
       (5, 5, 3, 15),
       (6, 6, 3, 12),
       (7, 7, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `reservaclases`
--

CREATE TABLE `reservaclases`
(
    `id_reserva` int(11) NOT NULL,
    `id_usuario` int(11)    DEFAULT NULL,
    `id_clase`   int(11)    DEFAULT NULL,
    `cancelar`   tinyint(1) DEFAULT 1
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `reservaclases`
--

INSERT INTO `reservaclases` (`id_reserva`, `id_usuario`, `id_clase`, `cancelar`)
VALUES (1, 17, 1, 1),
       (2, 18, 3, 1),
       (3, 19, 4, 1),
       (4, 20, 6, 1),
       (5, 21, 8, 1),
       (6, 22, 10, 1),
       (7, 23, 12, 1),
       (8, 17, 2, 1),
       (9, 18, 5, 1),
       (10, 19, 7, 1),
       (11, 20, 9, 1),
       (12, 21, 11, 1),
       (13, 22, 12, 1),
       (14, 23, 2, 1),
       (15, 9, 3, 1),
       (16, 10, 5, 1),
       (17, 11, 7, 1),
       (18, 17, 11, 1),
       (19, 18, 11, 1),
       (20, 19, 11, 1),
       (21, 20, 11, 1),
       (22, 21, 11, 1),
       (23, 4, 2, 1),
       (24, 7, 2, 1),
       (25, 8, 2, 1),
       (26, 6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol`
(
    `id_rol` int(11)     NOT NULL,
    `nombre` varchar(50) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`)
VALUES (1, 'Administrador'),
       (2, 'Recepcionista'),
       (3, 'Entrenador'),
       (4, 'Miembro');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios`
(
    `id_usuario`    int(11)      NOT NULL,
    `username`      varchar(50)  NOT NULL,
    `password`      varchar(512) NOT NULL,
    `nombre`        varchar(50)  NOT NULL,
    `apellidos`     varchar(50)  NOT NULL,
    `correo`        varchar(100) NOT NULL,
    `telefono`      varchar(20)           DEFAULT NULL,
    `ruta_imagen`   varchar(1024)         DEFAULT NULL,
    `activo`        tinyint(1)   NOT NULL DEFAULT 1,
    `id_rol`        int(11)               DEFAULT NULL,
    `password_flag` tinyint(1)   NOT NULL DEFAULT 0
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `nombre`, `apellidos`, `correo`, `telefono`,
                        `ruta_imagen`, `activo`, `id_rol`, `password_flag`)
VALUES (1, 'drewsmith-admin', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Drew', 'Smith',
        'drew.smith@example.com', '7879791004',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 1, 0),
       (2, 'morgansmith-recep', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Morgan', 'Smith',
        'morgan.smith@example.com', '5504449618',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 2, 0),
       (3, 'morganwilson-recep', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Morgan', 'Wilson',
        'morgan.wilson@example.com', '8518732981',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 2, 0),
       (4, 'patjohnson-train', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Pat', 'Johnson',
        'pat.johnson@example.com', '7318014727',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 3, 0),
       (5, 'taylorbrown-train', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Taylor', 'Brown',
        'taylor.brown@example.com', '6138248274',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 3, 0),
       (6, 'samtaylor-train', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Sam', 'Taylor',
        'sam.taylor@example.com', '1053802784',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 3, 0),
       (7, 'chrismiller-train', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Chris', 'Miller',
        'chris.miller@example.com', '8156538357',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 3, 0),
       (8, 'caseymoore', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Casey', 'Moore',
        'casey.moore@example.com', '9117945986',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (9, 'samdavis', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Sam', 'Davis',
        'sam.davis@example.com', '7896897257',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (10, 'taylorsmith', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Taylor', 'Smith',
        'taylor.smith@example.com', '6469928762',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (11, 'morganbrown', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Morgan', 'Brown',
        'morgan.brown@example.com', '8892216218',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (12, 'morganmiller', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Morgan', 'Miller',
        'morgan.miller@example.com', '4976654716',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 0, 4, 0),
       (13, 'taylorwilson', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Taylor', 'Wilson',
        'taylor.wilson@example.com', '6926720005',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 0, 4, 0),
       (14, 'samjones', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Sam', 'Jones',
        'sam.jones@example.com', '9225565362',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 0, 4, 0),
       (15, 'caseywilson', '2y$10$m/uTB.ZnZo.Wt7q5YjMmCeC.fqmwsYQ7wpxd7wbNC.1Xk6keSKeUu', 'Casey', 'Wilson',
        'casey.wilson@example.com', '7288996943',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 0, 4, 0),
       (16, 'DarienAF', '$2y$10$LU80YaYshMcUn8f6Q54mMeOy2GT7QKeqtdraH26vnuh847659O0SW', 'Darien', 'Aguilar',
        'darien@correo.com', '86196075',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 1, 0),
       (17, 'CarlosC', '$2y$10$Icph0GjEALieRs3tjCEWtOZhWndM5tYl2MLuFKruawuNWJFQTs0.G', 'Carlos', 'Contreras',
        'carlos@correo.com', '89887654',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (18, 'YongLi', '$2y$10$XgBtCx6UMzLfNCrzFJAUbOAyWdAQ2IHGswNEL2vJKeCZ7rphf0xdm', 'Yong', 'Liang',
        'yong@correo.com', '87123212', 'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg',
        1, 4, 0),
       (19, 'LuciaA', '$2y$10$RXtKibmJmsKSWOM2Yuk3veVKd0BWy98BwvAgEWtAFlxAPdu/RPUMq', 'Lucia', 'Alfaro',
        'lucia@correo.com', '67542122',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (20, 'SofiaT', '$2y$10$nBh.CfmHa.rI0xVAUxYJje7BS2bDH9Gia4McNyP9OFADKFkXSCi9y', 'Sofia', 'Torres',
        'sofia@correo.com', '66112233',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (21, 'NataliaO', '$2y$10$S5f6RaXrjFxuKiyO3HsfWOLykDwlub0730hBXpeCvpC2Td0ZTNlha', 'Natalia', 'Olivares',
        'natalia@correo.com', '89002123',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 4, 0),
       (22, 'AlexG', '$2y$10$qkDcQD2eVoVUL/gwYiK45OK8b4Qa7WEPhr9eZLIm8cqFgr3FKBV1S', 'Alex', 'Gutierrez',
        'alex@correo.com', '87120921', 'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg',
        1, 4, 0),
       (23, 'KathM', '$2y$10$2eQGFBYqZaYkmUee/Q6CsuR0OJF/hqdId3uV.msalCciLlobD/hse', 'Katherine', 'Marlena',
        'kath@correo.com', '76443398', 'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg',
        1, 4, 0),
       (24, 'EddyH', '$2y$10$bscXdCtZAyu.xLdDKfDiee4LLypAjBN3rXObXMJi/OiubCBR9hg2O', 'Eddy', 'Hernandez',
        'eddy@correo.com', '78886512', 'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg',
        1, 1, 0),
       (25, 'AngeloS', '$2y$10$KKxrXmTIwnnoO.Ge9OSEPuDxGsvQ6n5XZkhSop4k50SeuxUSJ3BZy', 'Angelo', 'Segura',
        'angelow@correo.com', '82023443',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 3, 0),
       (26, 'JustinB', '$2y$10$ekxvVfSIcf1aV/XruZA7.e1b1j4rSCZdc14tMuE8ObycWLeDnvQoG', 'Justin', 'Berger',
        'justin@correo.com', '89001189',
        'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg', 1, 3, 0),
       (27, 'FerS', '$2y$10$8Y/1JkbQnGF9cwkzAloVlufjlOHoA/OWW61QC/wAfMOScB8fNT1Iq', 'Fernanda', 'Sanchez',
        'fer@correo.com', '84445678', 'https://d1copppaysyuhz.cloudfront.net/profile-photos/default/profile-photo.jpg',
        1, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
    ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `clases`
--
ALTER TABLE `clases`
    ADD PRIMARY KEY (`id_clase`),
    ADD KEY `id_usuario` (`id_usuario`),
    ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `ejercicio`
--
ALTER TABLE `ejercicio`
    ADD PRIMARY KEY (`id_ejercicio`);

--
-- Indexes for table `medidas`
--
ALTER TABLE `medidas`
    ADD PRIMARY KEY (`id_medida`),
    ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `mensajes`
--
ALTER TABLE `mensajes`
    ADD PRIMARY KEY (`id_mensaje`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
    ADD PRIMARY KEY (`id_plan`),
    ADD KEY `id_usuario` (`id_usuario`),
    ADD KEY `id_plan_ejercicio` (`id_plan_ejercicio`);

--
-- Indexes for table `plan_ejercicios`
--
ALTER TABLE `plan_ejercicios`
    ADD PRIMARY KEY (`id_plan_ejercicio`),
    ADD KEY `id_ejercicio` (`id_ejercicio`);

--
-- Indexes for table `reservaclases`
--
ALTER TABLE `reservaclases`
    ADD PRIMARY KEY (`id_reserva`),
    ADD KEY `id_usuario` (`id_usuario`),
    ADD KEY `id_clase` (`id_clase`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
    ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
    ADD PRIMARY KEY (`id_usuario`),
    ADD UNIQUE KEY `username` (`username`),
    ADD UNIQUE KEY `correo` (`correo`),
    ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
    MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT for table `clases`
--
ALTER TABLE `clases`
    MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT for table `ejercicio`
--
ALTER TABLE `ejercicio`
    MODIFY `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `medidas`
--
ALTER TABLE `medidas`
    MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 31;

--
-- AUTO_INCREMENT for table `mensajes`
--
ALTER TABLE `mensajes`
    MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
    MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `plan_ejercicios`
--
ALTER TABLE `plan_ejercicios`
    MODIFY `id_plan_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `reservaclases`
--
ALTER TABLE `reservaclases`
    MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 27;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
    MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
    MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clases`
--
ALTER TABLE `clases`
    ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
    ADD CONSTRAINT `clases_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Constraints for table `medidas`
--
ALTER TABLE `medidas`
    ADD CONSTRAINT `medidas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `planes`
--
ALTER TABLE `planes`
    ADD CONSTRAINT `planes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
    ADD CONSTRAINT `planes_ibfk_2` FOREIGN KEY (`id_plan_ejercicio`) REFERENCES `plan_ejercicios` (`id_plan_ejercicio`);

--
-- Constraints for table `plan_ejercicios`
--
ALTER TABLE `plan_ejercicios`
    ADD CONSTRAINT `plan_ejercicios_ibfk_1` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id_ejercicio`);

--
-- Constraints for table `reservaclases`
--
ALTER TABLE `reservaclases`
    ADD CONSTRAINT `reservaclases_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
    ADD CONSTRAINT `reservaclases_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
    ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
