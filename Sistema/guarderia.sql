-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2018 at 01:04 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guarderia`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividad_2`
--

CREATE TABLE `actividad_2` (
  `id_actividad` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `transporte` tinyint(2) UNSIGNED NOT NULL,
  `costo_trans` float UNSIGNED DEFAULT NULL,
  `edad_minima` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actividad_2`
--

INSERT INTO `actividad_2` (`id_actividad`, `codigo`, `nombre`, `transporte`, `costo_trans`, `edad_minima`, `descripcion`) VALUES
(1, 'A001', 'Natacion', 0, NULL, 3, 'Natacion para niños'),
(2, 'A002', 'Musica', 0, NULL, 3, 'Musica primeros pasos'),
(3, 'A003', 'Pintura', 0, NULL, 2, 'Pintura y aprendizaje'),
(4, 'A004', 'Futbol', 1, 10000, 3, 'Aprendiendo del futbol'),
(5, 'A005', 'Babygym', 1, 4500, 6, 'Ejercitate diviertiendote!');

-- --------------------------------------------------------

--
-- Table structure for table `alergia_2`
--

CREATE TABLE `alergia_2` (
  `id_alergia` int(11) NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alergia_2`
--

INSERT INTO `alergia_2` (`id_alergia`, `codigo`, `descripcion`) VALUES
(1, 'AL001', 'Alergía a los lacteos'),
(2, 'AL002', 'Alergía al polvo'),
(3, 'AL003', 'Alergía a los gatos'),
(4, 'AL004', 'Alergía al sol'),
(5, 'AL005', 'Alergía a los refrescos');

-- --------------------------------------------------------

--
-- Table structure for table `asistencia_2`
--

CREATE TABLE `asistencia_2` (
  `id_asistencia` int(11) UNSIGNED NOT NULL,
  `id_padre` int(11) UNSIGNED NOT NULL,
  `id_autorizado` int(11) UNSIGNED NOT NULL,
  `id_inscripcion` int(11) UNSIGNED NOT NULL,
  `hora_llegada` int(5) UNSIGNED NOT NULL,
  `hora_salida` int(5) UNSIGNED NOT NULL,
  `dia` varchar(8) NOT NULL,
  `comio` tinyint(1) UNSIGNED NOT NULL COMMENT '1: Si, 0 : No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `autorizado_2`
--

CREATE TABLE `autorizado_2` (
  `id_autorizado` int(11) UNSIGNED NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autorizado_2`
--

INSERT INTO `autorizado_2` (`id_autorizado`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES
(1, 6712151, 'Arturo', 'Garanton', '4143017530'),
(2, 13712653, 'Pedro', 'Infante', '4128876512'),
(3, 12261243, 'Miguel', 'Bellardi', '4162255421'),
(4, 8823712, 'Jose', 'Fernandez', '4249921324'),
(5, 9986213, 'Jesus', 'Mejias', '4149351245');

-- --------------------------------------------------------

--
-- Table structure for table `comida_2`
--

CREATE TABLE `comida_2` (
  `id_comida` int(11) NOT NULL,
  `tipo` tinyint(2) NOT NULL COMMENT '1: proteina, 2: ensalada , 3: jugo , 4:carbohidrato',
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comida_2`
--

INSERT INTO `comida_2` (`id_comida`, `tipo`, `descripcion`) VALUES
(1, 1, 'Carne'),
(2, 1, 'Pollo'),
(3, 1, 'Atún'),
(4, 1, 'Espinaca'),
(5, 1, 'Mero'),
(6, 2, 'Ensalada mediterranea'),
(7, 2, 'Ensalada de tomate y lechuga'),
(8, 2, 'Ensalada rayada'),
(9, 2, 'Ensalada de garbanzos'),
(10, 2, 'Ensalada de zanahorias babys y papa'),
(11, 3, 'Jugo de melón'),
(12, 3, 'Jugo de lechoza'),
(13, 3, 'Jugo de naranja'),
(14, 3, 'Jugo de parchita'),
(15, 3, 'Jugo de patilla'),
(16, 4, 'Rodajas de pan'),
(17, 4, 'Papas fritas'),
(18, 4, 'Arroz'),
(19, 4, 'Pasta'),
(20, 4, 'Pure de papa');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_factura_2`
--

CREATE TABLE `detalle_factura_2` (
  `id_factura` int(11) UNSIGNED NOT NULL,
  `id_menu` int(11) UNSIGNED NOT NULL,
  `fechapago` varchar(15) NOT NULL,
  `monto` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enfermedad_2`
--

CREATE TABLE `enfermedad_2` (
  `id_enfermedad` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enfermedad_2`
--

INSERT INTO `enfermedad_2` (`id_enfermedad`, `codigo`, `descripcion`) VALUES
(1, 'EN001', 'Sarampión'),
(2, 'EN002', 'Jaquecas'),
(3, 'EN003', 'Bronquitis'),
(4, 'EN004', 'Otitis'),
(5, 'EN005', 'Varicela');

-- --------------------------------------------------------

--
-- Table structure for table `exp_laboral_2`
--

CREATE TABLE `exp_laboral_2` (
  `id_explaboral` int(11) NOT NULL,
  `id_personal` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `factura_2`
--

CREATE TABLE `factura_2` (
  `id_factura` int(11) UNSIGNED NOT NULL,
  `id_inscripcion` int(11) UNSIGNED NOT NULL,
  `semana` int(11) UNSIGNED NOT NULL,
  `num_transferencia` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guarderia_2`
--

CREATE TABLE `guarderia_2` (
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `id_lugar` int(11) UNSIGNED DEFAULT NULL,
  `id_enc` int(11) UNSIGNED DEFAULT NULL,
  `rif` varchar(12) NOT NULL,
  `nombre` varchar(18) NOT NULL,
  `telefonos` varchar(15) NOT NULL,
  `costo` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guarderia_2`
--

INSERT INTO `guarderia_2` (`id_guarderia`, `id_lugar`, `id_enc`, `rif`, `nombre`, `telefonos`, `costo`) VALUES
(1, 2, NULL, 'V87659123', 'Sede Barquisimeto', '2129767840', 100000),
(2, 3, NULL, 'V77812432', 'Sede Barcelona', '28129854222', 120000),
(3, 5, NULL, 'V912452131', 'Sede Zulia', '2627881422', 350000),
(4, 4, NULL, 'V124551678', 'Sede Valencia', '2419972152', 200000),
(5, 3, NULL, 'V77812434', 'Sede Barcelona V2', '2819219215', 120000);

-- --------------------------------------------------------

--
-- Table structure for table `guarderia_actividad_2`
--

CREATE TABLE `guarderia_actividad_2` (
  `id_ga` int(11) UNSIGNED NOT NULL,
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `id_actividad` int(11) UNSIGNED NOT NULL,
  `id_personal` int(11) UNSIGNED NOT NULL,
  `costo` float UNSIGNED NOT NULL,
  `cupomin` int(10) UNSIGNED NOT NULL,
  `cupomax` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guarderia_horario_actividad_2`
--

CREATE TABLE `guarderia_horario_actividad_2` (
  `id_ga` int(11) UNSIGNED NOT NULL,
  `id_horario` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `horario_2`
--

CREATE TABLE `horario_2` (
  `id_horario` int(11) UNSIGNED NOT NULL,
  `dia` varchar(10) NOT NULL,
  `cant_inscritos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario_2`
--

INSERT INTO `horario_2` (`id_horario`, `dia`, `cant_inscritos`) VALUES
(1, 'Lunes', 0),
(2, 'Martes', 0),
(3, 'Miercoles', 0),
(4, 'Jueves', 0),
(5, 'Viernes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `horario_guarderia_2`
--

CREATE TABLE `horario_guarderia_2` (
  `id_horario` int(11) UNSIGNED NOT NULL,
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `horainicio` int(11) NOT NULL,
  `horafin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `horario_inscrip_2`
--

CREATE TABLE `horario_inscrip_2` (
  `id_inscripcion` int(11) UNSIGNED NOT NULL,
  `id_ga` int(11) UNSIGNED NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion_2`
--

CREATE TABLE `inscripcion_2` (
  `id_inscripcion` int(11) UNSIGNED NOT NULL,
  `id_nino` int(11) NOT NULL,
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `ano` int(11) NOT NULL,
  `consecutivo` int(11) UNSIGNED NOT NULL,
  `cont_horas_extra` tinyint(1) DEFAULT NULL COMMENT '1: Si , 0 : No',
  `hora_desde` varchar(5) NOT NULL,
  `hora_hasta` varchar(5) NOT NULL,
  `fecha_insc` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inscripcion_2`
--

INSERT INTO `inscripcion_2` (`id_inscripcion`, `id_nino`, `id_guarderia`, `ano`, `consecutivo`, `cont_horas_extra`, `hora_desde`, `hora_hasta`, `fecha_insc`) VALUES
(1, 1, 1, 2018, 1, 1, '7', '9', '18/02/2018'),
(2, 2, 1, 2018, 1, 0, '9', '11', '17/02/2018'),
(3, 3, 1, 2018, 1, 0, '11', '13', '16/02/2018'),
(4, 4, 1, 2018, 1, 0, '13', '15', '19/01/2018'),
(5, 5, 1, 2018, 1, 0, '15', '17', '13/02/2018'),
(6, 6, 2, 2018, 1, 1, '7', '9', '27/02/2018'),
(7, 7, 2, 2018, 1, 1, '9', '11', '26/02/2018'),
(8, 8, 2, 2018, 1, 1, '11', '13', '25/02/2018'),
(9, 9, 2, 2018, 1, 1, '13', '15', '24/01/2018'),
(10, 10, 2, 2018, 1, 1, '15', '17', '23/02/2018'),
(11, 11, 3, 2017, 1, 0, '7', '9', '08/12/2017'),
(12, 12, 3, 2017, 1, 0, '9', '11', '07/12/2017'),
(13, 13, 3, 2017, 1, 0, '11', '13', '06/12/2017'),
(14, 14, 3, 2017, 1, 0, '13', '15', '05/01/2017'),
(15, 15, 3, 2017, 1, 0, '15', '17', '04/12/2017'),
(16, 16, 4, 2018, 1, 0, '11', '13', '13/01/2018'),
(17, 17, 4, 2018, 1, 1, '9', '11', '12/01/2018'),
(18, 18, 4, 2018, 1, 1, '11', '13', '15/01/2018'),
(19, 19, 4, 2018, 1, 1, '13', '15', '11/01/2018'),
(20, 20, 4, 2018, 1, 1, '15', '17', '10/02/2018'),
(21, 21, 5, 2017, 1, 1, '7', '9', '09/12/2017'),
(22, 22, 5, 2017, 1, 1, '10', '12', '03/12/2017'),
(23, 23, 5, 2017, 1, 0, '11', '13', '05/12/2017'),
(24, 24, 5, 2017, 1, 0, '13', '15', '01/01/2017'),
(25, 25, 5, 2017, 1, 0, '16', '18', '02/12/2017');

-- --------------------------------------------------------

--
-- Table structure for table `juego_2`
--

CREATE TABLE `juego_2` (
  `id_juego` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juego_2`
--

INSERT INTO `juego_2` (`id_juego`, `codigo`, `descripcion`) VALUES
(1, 'J001', 'Jugando con matematicas'),
(2, 'J002', 'Juegos motrices'),
(3, 'J003', 'Juegos para aprender la hora'),
(4, 'J004', 'Aprende los colores'),
(5, 'J005', 'Diversion con geometria');

-- --------------------------------------------------------

--
-- Table structure for table `lugar_2`
--

CREATE TABLE `lugar_2` (
  `id_lugar` int(11) UNSIGNED NOT NULL,
  `id_lugar_padre` int(11) UNSIGNED DEFAULT NULL,
  `nombre` varchar(15) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '0: Estado, 1: ciudad, 2: pais'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lugar_2`
--

INSERT INTO `lugar_2` (`id_lugar`, `id_lugar_padre`, `nombre`, `tipo`) VALUES
(1, NULL, 'Lara', 1),
(2, 1, 'Barquisimeto', 2),
(3, NULL, 'Barcelona', 2),
(4, NULL, 'Valencia', 2),
(5, NULL, 'Zulia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicina_2`
--

CREATE TABLE `medicina_2` (
  `id_medicina` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicina_2`
--

INSERT INTO `medicina_2` (`id_medicina`, `codigo`, `descripcion`) VALUES
(1, 'MED001', 'Ibuprofeno'),
(2, 'MED002', 'Brugesic'),
(3, 'MED003', 'Bisolvon'),
(4, 'MED004', 'Tachipirin'),
(5, 'MED005', 'Scott');

-- --------------------------------------------------------

--
-- Table structure for table `mensualidad_2`
--

CREATE TABLE `mensualidad_2` (
  `id_mensualidad` int(11) NOT NULL,
  `id_inscripcion` int(11) UNSIGNED NOT NULL,
  `consecutivo` int(2) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mensualidad_2`
--

INSERT INTO `mensualidad_2` (`id_mensualidad`, `id_inscripcion`, `consecutivo`, `monto`) VALUES
(1, 1, 1, 100000),
(2, 2, 1, 120000),
(3, 3, 1, 140000),
(4, 4, 1, 100000),
(5, 5, 1, 120000),
(6, 6, 1, 110000),
(7, 7, 1, 135000),
(8, 8, 1, 140000),
(9, 9, 1, 100000),
(10, 10, 1, 120000),
(11, 11, 1, 100000),
(12, 12, 1, 125000),
(13, 13, 1, 130000),
(14, 14, 1, 110000),
(15, 15, 1, 140000);

-- --------------------------------------------------------

--
-- Table structure for table `menu_2`
--

CREATE TABLE `menu_2` (
  `id_menu` int(11) UNSIGNED NOT NULL,
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `numero` int(11) UNSIGNED NOT NULL,
  `dia` varchar(15) NOT NULL,
  `semana` int(11) UNSIGNED NOT NULL,
  `costo` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_2`
--

INSERT INTO `menu_2` (`id_menu`, `id_guarderia`, `numero`, `dia`, `semana`, `costo`) VALUES
(1, 1, 1, 'Lunes', 1, 100000),
(2, 1, 2, 'Martes', 1, 120000),
(3, 1, 3, 'Miercoles', 1, 140000),
(4, 1, 4, 'Jueves', 1, 130000),
(5, 1, 5, 'Viernes', 1, 110000),
(6, 1, 1, 'Lunes', 1, 100000),
(7, 1, 2, 'Martes', 1, 115000),
(8, 1, 3, 'Miercoles', 1, 135000),
(9, 1, 4, 'Jueves', 1, 142000),
(10, 1, 5, 'Viernes', 1, 90000),
(11, 2, 1, 'Lunes', 1, 100000),
(12, 2, 2, 'Martes', 1, 130000),
(13, 2, 3, 'Miercoles', 1, 140000),
(14, 2, 4, 'Jueves', 1, 130000),
(15, 2, 5, 'Viernes', 1, 600000),
(16, 2, 1, 'Lunes', 1, 100000),
(17, 2, 2, 'Martes', 1, 75000),
(18, 2, 3, 'Miercoles', 1, 135000),
(19, 2, 4, 'Jueves', 1, 122000),
(20, 2, 5, 'Viernes', 1, 98700),
(21, 3, 1, 'Lunes', 1, 105000),
(22, 3, 2, 'Martes', 1, 130000),
(23, 3, 3, 'Miercoles', 1, 120000),
(24, 3, 4, 'Jueves', 1, 130000),
(25, 3, 5, 'Viernes', 1, 130000),
(26, 3, 1, 'Lunes', 1, 100000),
(27, 3, 2, 'Martes', 1, 85000),
(28, 3, 3, 'Miercoles', 1, 135000),
(29, 3, 4, 'Jueves', 1, 10500),
(30, 3, 5, 'Viernes', 1, 80000),
(31, 4, 1, 'Lunes', 1, 105000),
(32, 4, 2, 'Martes', 1, 130000),
(33, 4, 3, 'Miercoles', 1, 120000),
(34, 4, 4, 'Jueves', 1, 150000),
(35, 4, 5, 'Viernes', 1, 100000),
(36, 4, 1, 'Lunes', 1, 100000),
(37, 4, 2, 'Martes', 1, 95000),
(38, 4, 3, 'Miercoles', 1, 135000),
(39, 4, 4, 'Jueves', 1, 10500),
(40, 4, 5, 'Viernes', 1, 90000),
(41, 5, 1, 'Lunes', 1, 115000),
(42, 5, 2, 'Martes', 1, 130000),
(43, 5, 3, 'Miercoles', 1, 110000),
(44, 5, 4, 'Jueves', 1, 130000),
(45, 5, 5, 'Viernes', 1, 105000),
(46, 5, 1, 'Lunes', 1, 100000),
(47, 5, 2, 'Martes', 1, 75000),
(48, 5, 3, 'Miercoles', 1, 135000),
(49, 5, 4, 'Jueves', 1, 10500),
(50, 5, 5, 'Viernes', 1, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `nino_2`
--

CREATE TABLE `nino_2` (
  `id_nino` int(11) NOT NULL,
  `id_padre` int(11) UNSIGNED NOT NULL,
  `letra` varchar(1) NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `fecha_nac` varchar(20) NOT NULL,
  `sexo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nino_2`
--

INSERT INTO `nino_2` (`id_nino`, `id_padre`, `letra`, `nombre`, `apellido`, `fecha_nac`, `sexo`) VALUES
(1, 1234567891, 'A', 'Alexander', 'Martinez', '02/02/2002', 'M'),
(2, 1234567891, 'B', 'Brayan', 'Martinez', '02/02/2004', 'M'),
(3, 1234567892, 'A', 'Carlos', 'Martinez', '02/03/2004', 'M'),
(4, 1234567895, 'A', 'Fatima', 'Medina', '27/11/2003', 'F'),
(5, 1234567895, 'B', 'Fabiana', 'Medina', '13/12/2003', 'F'),
(6, 1234567885, 'A', 'Luis', 'Neira', '02/02/2002', 'M'),
(7, 1234567887, 'A', 'Pedro', 'Alvarez', '02/02/2004', 'M'),
(8, 1234567893, 'A', 'Karliedis', 'Morales', '02/03/2004', 'F'),
(9, 1234567883, 'A', 'Fanny', 'Gomez', '27/09/2003', 'F'),
(10, 1234567882, 'A', 'Alexandra', 'Medina', '13/12/2003', 'F'),
(11, 1234567896, 'A', 'Saccha', 'Ilarraza', '01/02/2002', 'F'),
(12, 1234567891, 'C', 'Brayan', 'Martinez', '02/02/2004', 'M'),
(13, 1234567891, 'D', 'Carlos', 'Martinez', '05/03/2004', 'M'),
(14, 1234567895, 'C', 'Fatima', 'Medina', '23/06/2004', 'F'),
(15, 1234567895, 'D', 'Fabiana', 'Medina', '19/10/2005', 'F'),
(16, 1234567883, 'B', 'Luis', 'Gomez', '02/02/2002', 'M'),
(17, 1234567881, 'A', 'Pedro', 'De Azevedo', '02/02/2004', 'M'),
(18, 1234567897, 'A', 'Karliedis', 'Goncalves', '09/03/2004', 'F'),
(19, 1234567898, 'A', 'Monica', 'Medina', '27/09/2004', 'F'),
(20, 1234567898, 'B', 'Alexandra', 'Medina', '13/12/2003', 'F'),
(21, 1234567892, 'B', 'Saccha', 'Martinez', '01/02/2002', 'F'),
(22, 1234567893, 'A', 'Eduardo', 'Morales', '08/02/2004', 'M'),
(23, 1234567896, 'B', 'Carlos', 'Ilarraza', '05/03/2003', 'M'),
(24, 1234567894, 'A', 'Fatima', 'Perez', '21/06/2004', 'F'),
(25, 1234567894, 'B', 'Fabiana', 'Perez', '19/10/2005', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `nino_alergia_2`
--

CREATE TABLE `nino_alergia_2` (
  `id_nino` int(11) NOT NULL,
  `id_alergia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nino_autorizado_2`
--

CREATE TABLE `nino_autorizado_2` (
  `id_nino` int(11) NOT NULL,
  `id_autorizado` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nino_enfermedad_2`
--

CREATE TABLE `nino_enfermedad_2` (
  `id_nino` int(11) NOT NULL,
  `id_enfermedad` int(11) UNSIGNED NOT NULL,
  `fechacontagio` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nino_juego_2`
--

CREATE TABLE `nino_juego_2` (
  `id_nino` int(11) NOT NULL,
  `id_juego` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nino_medicina_sintoma_2`
--

CREATE TABLE `nino_medicina_sintoma_2` (
  `id_sintoma` int(11) UNSIGNED NOT NULL,
  `id_medicina` int(11) UNSIGNED NOT NULL,
  `id_nino` int(11) NOT NULL,
  `cantidad` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nino_pediatra_2`
--

CREATE TABLE `nino_pediatra_2` (
  `id_nino` int(11) NOT NULL,
  `id_pediatra` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `padre_2`
--

CREATE TABLE `padre_2` (
  `cedula` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `email` varchar(35) NOT NULL,
  `tel_casa` varchar(15) DEFAULT NULL,
  `tel_ofic` varchar(15) DEFAULT NULL,
  `tel_celular` varchar(15) NOT NULL,
  `profesion` varchar(34) NOT NULL,
  `edo_civil` varchar(11) DEFAULT NULL,
  `principal` tinyint(1) NOT NULL COMMENT '1 : Si 0 : No',
  `vivenino` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `padre_2`
--

INSERT INTO `padre_2` (`cedula`, `nombre`, `apellido`, `direccion`, `email`, `tel_casa`, `tel_ofic`, `tel_celular`, `profesion`, `edo_civil`, `principal`, `vivenino`) VALUES
(1234567881, 'Alexander', 'De Azevedo', 'el paraiso', 'jmedina@hotmail.com', '2121234567881', '2121234567882', '4241234567881', 'fotografo', 'soltero', 1, 'S'),
(1234567882, 'Sergio', 'Medina', 'Catia', 'sagg305@hotmail.com', '2121234567882', '2121234567882', '4241234567882', 'futbolista', 'casado', 1, 'N'),
(1234567883, 'Greg', 'Gomez', 'La Urbina', 'greggomez@hotmail.com', '2121234567883', '2121234567884', '4241234567883', 'musico', 'soltero', 1, 'N'),
(1234567884, 'Karliam', 'Medina', 'San Antonio de los Altos', 'karliam@hotmail.com', '2121234567885', '2121234567886', '4241234567884', 'cantante', 'soltero', 1, 'N'),
(1234567885, 'Christian', 'Neira', 'San Juan', 'christian_neira@hotmail.com', '2121234567885', '2121234567887', '4241234567885', 'pintor', 'soltero', 1, 'S'),
(1234567886, 'Pedro', 'De Leon', 'Los Simbolos', 'pedrodeleon@hotmail.com', '2121234567886', '2121234567888', '4241234567886', 'diseñador grafico', 'casado', 1, 'N'),
(1234567887, 'Pedro', 'Alvarez', 'Santa Monica', 'pedroalvarez@hotmail.com', '2121234567887', '2121234567889', '4241234567888', 'diseñador grafico', 'soltero', 1, 'S'),
(1234567891, 'Luis', 'Martinez', 'El paraiso', 'luismartinez@gmail.com', '2121234567891', '2121234567892', '4241234567891', 'abogado', 'soltero', 1, 'S'),
(1234567892, 'Luifer', 'Martinez', 'El paraiso', 'luifermartinez@gmail.com', '2121234567892', '2121234567893', '4241234567892', 'ingeniero', 'casado', 1, 'S'),
(1234567893, 'Luisa', 'Morales', 'Montalban', 'luisita@gmail.com', '2121234567893', '2121234567894', '4241234567893', 'fotografo', 'soltero', 1, 'S'),
(1234567894, 'Maria', 'Perez', 'El valle', 'maria@gmail.com', '2121234567894', '2121234567895', '4241234567894', 'bombero', 'soltero', 1, 'N'),
(1234567895, 'Jessica', 'Medina', 'La lagunita', 'jessicam@hotmail.com', '2121234567895', '2121234567896', '4241234567895', 'modelo', 'soltero', 1, 'S'),
(1234567896, 'Iris', 'Ilarraza', 'La lagunita', 'irisfashion@hotmail.com', '2121234567896', '2121234567897', '4241234567896', 'medico', 'soltero', 1, 'N'),
(1234567897, 'Fatima', 'Goncalves', 'La lagunita', 'fatimag@hotmail.com', '2121234567897', '2121234567898', '4241234567897', 'profesor', 'casado', 1, 'N'),
(1234567898, 'Ramon', 'Medina', 'La lagunita', 'ramonmedina@hotmail.com', '2121234567898', '2121234567899', '4241234567898', 'abogado', 'soltero', 1, 'S'),
(1234567899, 'Fernando', 'Gomes', 'La Bandera', 'fernandog@yahoo.com', '2121234567899', '2121234567896', '4241234567899', 'odontologo', 'soltero', 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pago_insc_mens_2`
--

CREATE TABLE `pago_insc_mens_2` (
  `id_pim` int(11) UNSIGNED NOT NULL,
  `id_inscripcion` int(11) UNSIGNED DEFAULT NULL,
  `id_mensualidad` int(11) DEFAULT NULL,
  `numero` int(11) UNSIGNED NOT NULL,
  `fechapago` varchar(15) NOT NULL,
  `concepto` int(10) UNSIGNED NOT NULL COMMENT '1:Inscripcion, 2: Mensualidad',
  `tipo_pago` varchar(25) NOT NULL,
  `monto` int(10) UNSIGNED NOT NULL,
  `numero_cheque` int(10) UNSIGNED DEFAULT NULL,
  `numero_tarjeta` int(10) UNSIGNED DEFAULT NULL,
  `monto_debito` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pago_insc_mens_2`
--

INSERT INTO `pago_insc_mens_2` (`id_pim`, `id_inscripcion`, `id_mensualidad`, `numero`, `fechapago`, `concepto`, `tipo_pago`, `monto`, `numero_cheque`, `numero_tarjeta`, `monto_debito`) VALUES
(1, 1, NULL, 1, '18/02/2018', 1, 'transferencia', 100000, 0, 123, 90000),
(2, 2, NULL, 1, '17/02/2018', 1, 'transferencia', 100000, 0, 123, 90000),
(3, 3, NULL, 1, '16/02/2018', 1, 'transferencia', 100000, 0, 123, 90000),
(4, 4, NULL, 1, '15/02/2018', 1, 'transferencia', 100000, 0, 123, 90000),
(5, 5, NULL, 1, '14/02/2018', 1, 'transferencia', 100000, 0, 123, 90000),
(6, 6, NULL, 1, '13/02/2018', 1, 'tarjeta de credito', 100000, 0, 123, 90000),
(7, 7, NULL, 1, '12/02/2018', 1, 'transferencia', 100000, 123, 0, 90000),
(8, 8, NULL, 1, '11/02/2018 ', 1, 'transferencia', 100000, 123, 0, 90000),
(9, 9, NULL, 1, '10/02/2018', 1, 'cheque', 100000, 123, 123, 90000),
(10, 10, NULL, 1, '09/02/2018', 1, 'transferencia', 100000, 0, 123, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `pago_multa_2`
--

CREATE TABLE `pago_multa_2` (
  `id_pago` int(11) NOT NULL,
  `num_transferencia` int(10) UNSIGNED NOT NULL,
  `fecha` varchar(15) NOT NULL,
  `monto` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parentesco_2`
--

CREATE TABLE `parentesco_2` (
  `id_padre` int(11) UNSIGNED NOT NULL,
  `id_nino` int(11) NOT NULL,
  `parentesco` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pediatra_2`
--

CREATE TABLE `pediatra_2` (
  `id_pediatra` int(11) UNSIGNED NOT NULL,
  `cedula` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pediatra_2`
--

INSERT INTO `pediatra_2` (`id_pediatra`, `cedula`, `nombre`, `telefono`) VALUES
(1, 1234567871, 'Alexander', '4241234567'),
(2, 1234567872, 'Brayan', '4241234561'),
(3, 1234567873, 'Carlos', '4241234565'),
(4, 1234567874, 'Fatima', '4241234569'),
(5, 1234567875, 'Fabiana', '4241234563');

-- --------------------------------------------------------

--
-- Table structure for table `personal_2`
--

CREATE TABLE `personal_2` (
  `id_personal` int(11) UNSIGNED NOT NULL,
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `cedula` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellidos` varchar(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `nivel_estudio` text NOT NULL COMMENT 'bachillerato, TSU, universitario, postgrado',
  `sueldo` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_2`
--

INSERT INTO `personal_2` (`id_personal`, `id_guarderia`, `cedula`, `nombre`, `apellidos`, `direccion`, `telefono`, `nivel_estudio`, `sueldo`) VALUES
(1, 1, 1234567861, 'Alexander', 'De Azevedo', 'el paraiso', '4241234567', 'universitario', 1500000),
(2, 1, 1234567862, 'Brayan', 'Gomes', 'la vega', '4241234568', 'tsu', 1000000),
(3, 1, 1234567863, 'Carlos', 'Perez', 'la tahona', '4241234569', 'bachillerato', 900000),
(4, 1, 1234567864, 'Fatima', 'Maduro', 'petare', '4241234560', 'tsu', 1100000),
(5, 1, 1234567865, 'Fabiana', 'Puglisi', 'catia', '4241234561', 'bachillerato', 900000),
(6, 2, 1234567866, 'Alexander', 'De Azevedo', 'el paraiso', '4241234567', 'universitario', 1500000),
(7, 2, 1234567867, 'Brayan', 'Gomes', 'la vega', '4241234577', 'tsu', 1000000),
(8, 2, 1234567868, 'Carlos', 'Perez', 'la tahona', '4241234572', 'bachillerato', 900000),
(9, 2, 1234567869, 'Fatima', 'Maduro', 'petare', '4241234578', 'tsu', 1200000),
(10, 2, 1234567860, 'Fabiana', 'Puglisi', 'catia', '4241234579', 'tsu', 900000),
(11, 3, 1234567851, 'Luis', 'De Azevedo', 'el paraiso', '4241234531', 'bachillerato', 1500000),
(12, 3, 1234567852, 'Brayan', 'Gomes', 'la vega', '4241234512', 'tsu', 1100000),
(13, 3, 1234567853, 'Carlos', 'Perez', 'la tahona', '4241234535', 'tsu', 900000),
(14, 3, 1234567854, 'Monica', 'Maduro', 'petare', '4241234537', 'tsu', 1100000),
(15, 3, 1234567855, 'Fabiana', 'Puglisi', 'catia', '4241234539', 'universitario', 1800000),
(16, 4, 1234567891, 'Luis', 'Gomez', 'el paraiso', '4241234521', 'bachillerato', 1500000),
(17, 4, 1234567892, 'Monica', 'Gomes', 'la urbina', '4241234532', 'tsu', 1000000),
(18, 4, 1234567893, 'Carlos', 'Perez', 'la tahona', '4241234535', 'tsu', 900000),
(19, 4, 1234567894, 'Rafael', 'Jimenez', 'petare', '4241234537', 'tsu', 1100000),
(20, 4, 1234567895, 'Fabiana', 'Fernadez', 'la trinidad', '4241234539', 'universitario', 2000000),
(21, 5, 1234567881, 'Luis', 'Gomez', 'el paraiso', '4241234551', 'bachillerato', 1500000),
(22, 5, 1234567882, 'Monica', 'Gomes', 'la urbina', '4241234552', 'bachillerato', 1200000),
(23, 5, 1234567883, 'Carlos', 'Perez', 'la tahona', '4241234555', 'tsu', 900000),
(24, 5, 1234567884, 'Rafael', 'Jimenez', 'petare', '4241234557', 'tsu', 1100000),
(25, 5, 1234567885, 'Fabiana', 'Fernadez', 'la trinidad', '4241234559', 'universitario', 2100000);

-- --------------------------------------------------------

--
-- Table structure for table `pers_capacitado_2`
--

CREATE TABLE `pers_capacitado_2` (
  `id_actividad` int(10) UNSIGNED NOT NULL,
  `id_personal` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plato_2`
--

CREATE TABLE `plato_2` (
  `id_plato` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plato_2`
--

INSERT INTO `plato_2` (`id_plato`, `codigo`, `descripcion`) VALUES
(1, 'PL001', 'Arroz con pollo, jugo de parchita, ensalada'),
(2, 'PL002', 'Carne molida con tostones, jugo de lechoza, ensalada'),
(3, 'PL003', 'Bisteck con papas fritas,jugo de piña, ensalada'),
(4, 'PL004', 'Sopa de pollo, jugo mora, ensalada'),
(5, 'PL005', 'Nuggets de pollo y papas al horno, jugo de pera, ensalada'),
(6, 'PL006', 'Sushi, jugo de mango, ensalada'),
(7, 'PL007', 'Hamburguesa de pescado y papas fritas, jugo de naranja, ensalada'),
(8, 'PL008', 'Milanesa de carne y arroz, jugo de manzana, ensalada'),
(9, 'PL009', 'Mondongo, jugo de pera, ensalada'),
(10, 'PL0010', 'Pernil y vegetales, jugo de lechoza, ensalada');

-- --------------------------------------------------------

--
-- Table structure for table `plato_comida_2`
--

CREATE TABLE `plato_comida_2` (
  `id_comida` int(11) NOT NULL,
  `id_plato` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plato_menu_2`
--

CREATE TABLE `plato_menu_2` (
  `id_plato` int(11) UNSIGNED NOT NULL,
  `id_menu` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sintoma_2`
--

CREATE TABLE `sintoma_2` (
  `id_sintoma` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sintoma_2`
--

INSERT INTO `sintoma_2` (`id_sintoma`, `codigo`, `descripcion`) VALUES
(1, 'SI001', 'Dolor de cabeza'),
(2, 'SI002', 'Diarrea'),
(3, 'SI003', 'irritabilidad'),
(4, 'SI004', 'Fatiga'),
(5, 'SI005', 'Apatía');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividad_2`
--
ALTER TABLE `actividad_2`
  ADD PRIMARY KEY (`id_actividad`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `alergia_2`
--
ALTER TABLE `alergia_2`
  ADD PRIMARY KEY (`id_alergia`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `asistencia_2`
--
ALTER TABLE `asistencia_2`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `id_padre` (`id_padre`),
  ADD KEY `id_autorizado` (`id_autorizado`),
  ADD KEY `id_inscripcion` (`id_inscripcion`);

--
-- Indexes for table `autorizado_2`
--
ALTER TABLE `autorizado_2`
  ADD PRIMARY KEY (`id_autorizado`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indexes for table `comida_2`
--
ALTER TABLE `comida_2`
  ADD PRIMARY KEY (`id_comida`);

--
-- Indexes for table `detalle_factura_2`
--
ALTER TABLE `detalle_factura_2`
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `enfermedad_2`
--
ALTER TABLE `enfermedad_2`
  ADD PRIMARY KEY (`id_enfermedad`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `exp_laboral_2`
--
ALTER TABLE `exp_laboral_2`
  ADD PRIMARY KEY (`id_explaboral`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indexes for table `factura_2`
--
ALTER TABLE `factura_2`
  ADD PRIMARY KEY (`id_factura`),
  ADD UNIQUE KEY `semana` (`semana`),
  ADD KEY `id_inscripcion` (`id_inscripcion`);

--
-- Indexes for table `guarderia_2`
--
ALTER TABLE `guarderia_2`
  ADD PRIMARY KEY (`id_guarderia`),
  ADD UNIQUE KEY `rif` (`rif`),
  ADD KEY `guarderia_2_ibfk_1` (`id_lugar`),
  ADD KEY `guarderia_2_ibfk_2` (`id_enc`);

--
-- Indexes for table `guarderia_actividad_2`
--
ALTER TABLE `guarderia_actividad_2`
  ADD PRIMARY KEY (`id_ga`),
  ADD UNIQUE KEY `id_guarderia` (`id_guarderia`),
  ADD UNIQUE KEY `id_actividad` (`id_actividad`),
  ADD UNIQUE KEY `id_personal` (`id_personal`);

--
-- Indexes for table `guarderia_horario_actividad_2`
--
ALTER TABLE `guarderia_horario_actividad_2`
  ADD KEY `id_horario` (`id_horario`);

--
-- Indexes for table `horario_2`
--
ALTER TABLE `horario_2`
  ADD PRIMARY KEY (`id_horario`),
  ADD UNIQUE KEY `dia` (`dia`);

--
-- Indexes for table `horario_guarderia_2`
--
ALTER TABLE `horario_guarderia_2`
  ADD UNIQUE KEY `horainicio` (`horainicio`),
  ADD UNIQUE KEY `horafin` (`horafin`),
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_guarderia` (`id_guarderia`);

--
-- Indexes for table `horario_inscrip_2`
--
ALTER TABLE `horario_inscrip_2`
  ADD KEY `id_inscripcion` (`id_inscripcion`),
  ADD KEY `id_ga` (`id_ga`);

--
-- Indexes for table `inscripcion_2`
--
ALTER TABLE `inscripcion_2`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `id_niño` (`id_nino`),
  ADD KEY `id_guarderia` (`id_guarderia`);

--
-- Indexes for table `juego_2`
--
ALTER TABLE `juego_2`
  ADD PRIMARY KEY (`id_juego`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `lugar_2`
--
ALTER TABLE `lugar_2`
  ADD PRIMARY KEY (`id_lugar`),
  ADD KEY `id_lugar_padre` (`id_lugar_padre`);

--
-- Indexes for table `medicina_2`
--
ALTER TABLE `medicina_2`
  ADD PRIMARY KEY (`id_medicina`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `mensualidad_2`
--
ALTER TABLE `mensualidad_2`
  ADD PRIMARY KEY (`id_mensualidad`),
  ADD UNIQUE KEY `id_inscripcion` (`id_inscripcion`);

--
-- Indexes for table `menu_2`
--
ALTER TABLE `menu_2`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_guarderia` (`id_guarderia`);

--
-- Indexes for table `nino_2`
--
ALTER TABLE `nino_2`
  ADD PRIMARY KEY (`id_nino`),
  ADD KEY `id_padre` (`id_padre`);

--
-- Indexes for table `nino_alergia_2`
--
ALTER TABLE `nino_alergia_2`
  ADD KEY `id_nino` (`id_nino`),
  ADD KEY `id_alergia` (`id_alergia`);

--
-- Indexes for table `nino_autorizado_2`
--
ALTER TABLE `nino_autorizado_2`
  ADD KEY `id_nino` (`id_nino`),
  ADD KEY `id_autorizado` (`id_autorizado`);

--
-- Indexes for table `nino_enfermedad_2`
--
ALTER TABLE `nino_enfermedad_2`
  ADD KEY `id_nino` (`id_nino`),
  ADD KEY `id_enfermedad` (`id_enfermedad`);

--
-- Indexes for table `nino_juego_2`
--
ALTER TABLE `nino_juego_2`
  ADD KEY `id_nino` (`id_nino`),
  ADD KEY `id_juego` (`id_juego`);

--
-- Indexes for table `nino_medicina_sintoma_2`
--
ALTER TABLE `nino_medicina_sintoma_2`
  ADD KEY `id_sintoma` (`id_sintoma`),
  ADD KEY `id_medicina` (`id_medicina`),
  ADD KEY `id_nino` (`id_nino`);

--
-- Indexes for table `nino_pediatra_2`
--
ALTER TABLE `nino_pediatra_2`
  ADD KEY `id_nino` (`id_nino`),
  ADD KEY `id_pediatra` (`id_pediatra`);

--
-- Indexes for table `padre_2`
--
ALTER TABLE `padre_2`
  ADD PRIMARY KEY (`cedula`);

--
-- Indexes for table `pago_insc_mens_2`
--
ALTER TABLE `pago_insc_mens_2`
  ADD PRIMARY KEY (`id_pim`),
  ADD KEY `id_mensualidad` (`id_mensualidad`),
  ADD KEY `id_inscripcion` (`id_inscripcion`);

--
-- Indexes for table `pago_multa_2`
--
ALTER TABLE `pago_multa_2`
  ADD PRIMARY KEY (`id_pago`),
  ADD UNIQUE KEY `num_transferencia` (`num_transferencia`);

--
-- Indexes for table `parentesco_2`
--
ALTER TABLE `parentesco_2`
  ADD KEY `id_nino` (`id_nino`),
  ADD KEY `id_padre` (`id_padre`);

--
-- Indexes for table `pediatra_2`
--
ALTER TABLE `pediatra_2`
  ADD PRIMARY KEY (`id_pediatra`),
  ADD UNIQUE KEY `codigo` (`cedula`);

--
-- Indexes for table `personal_2`
--
ALTER TABLE `personal_2`
  ADD PRIMARY KEY (`id_personal`),
  ADD KEY `id_guarderia` (`id_guarderia`);

--
-- Indexes for table `pers_capacitado_2`
--
ALTER TABLE `pers_capacitado_2`
  ADD KEY `id_actividad` (`id_actividad`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indexes for table `plato_2`
--
ALTER TABLE `plato_2`
  ADD PRIMARY KEY (`id_plato`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `plato_comida_2`
--
ALTER TABLE `plato_comida_2`
  ADD KEY `id_plato` (`id_plato`),
  ADD KEY `id_comida` (`id_comida`);

--
-- Indexes for table `plato_menu_2`
--
ALTER TABLE `plato_menu_2`
  ADD KEY `id_plato` (`id_plato`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `sintoma_2`
--
ALTER TABLE `sintoma_2`
  ADD PRIMARY KEY (`id_sintoma`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividad_2`
--
ALTER TABLE `actividad_2`
  MODIFY `id_actividad` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `alergia_2`
--
ALTER TABLE `alergia_2`
  MODIFY `id_alergia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `asistencia_2`
--
ALTER TABLE `asistencia_2`
  MODIFY `id_asistencia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `autorizado_2`
--
ALTER TABLE `autorizado_2`
  MODIFY `id_autorizado` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comida_2`
--
ALTER TABLE `comida_2`
  MODIFY `id_comida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `enfermedad_2`
--
ALTER TABLE `enfermedad_2`
  MODIFY `id_enfermedad` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `exp_laboral_2`
--
ALTER TABLE `exp_laboral_2`
  MODIFY `id_explaboral` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factura_2`
--
ALTER TABLE `factura_2`
  MODIFY `id_factura` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guarderia_2`
--
ALTER TABLE `guarderia_2`
  MODIFY `id_guarderia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `guarderia_actividad_2`
--
ALTER TABLE `guarderia_actividad_2`
  MODIFY `id_ga` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horario_2`
--
ALTER TABLE `horario_2`
  MODIFY `id_horario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `inscripcion_2`
--
ALTER TABLE `inscripcion_2`
  MODIFY `id_inscripcion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `juego_2`
--
ALTER TABLE `juego_2`
  MODIFY `id_juego` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lugar_2`
--
ALTER TABLE `lugar_2`
  MODIFY `id_lugar` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `medicina_2`
--
ALTER TABLE `medicina_2`
  MODIFY `id_medicina` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mensualidad_2`
--
ALTER TABLE `mensualidad_2`
  MODIFY `id_mensualidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `menu_2`
--
ALTER TABLE `menu_2`
  MODIFY `id_menu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `nino_2`
--
ALTER TABLE `nino_2`
  MODIFY `id_nino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pago_insc_mens_2`
--
ALTER TABLE `pago_insc_mens_2`
  MODIFY `id_pim` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pago_multa_2`
--
ALTER TABLE `pago_multa_2`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pediatra_2`
--
ALTER TABLE `pediatra_2`
  MODIFY `id_pediatra` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `personal_2`
--
ALTER TABLE `personal_2`
  MODIFY `id_personal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sintoma_2`
--
ALTER TABLE `sintoma_2`
  MODIFY `id_sintoma` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `asistencia_2`
--
ALTER TABLE `asistencia_2`
  ADD CONSTRAINT `asistencia_2_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `padre_2` (`cedula`),
  ADD CONSTRAINT `asistencia_2_ibfk_2` FOREIGN KEY (`id_autorizado`) REFERENCES `autorizado_2` (`id_autorizado`),
  ADD CONSTRAINT `asistencia_2_ibfk_3` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion_2` (`id_inscripcion`);

--
-- Constraints for table `detalle_factura_2`
--
ALTER TABLE `detalle_factura_2`
  ADD CONSTRAINT `detalle_factura_2_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu_2` (`id_menu`);

--
-- Constraints for table `exp_laboral_2`
--
ALTER TABLE `exp_laboral_2`
  ADD CONSTRAINT `exp_laboral_2_ibfk_1` FOREIGN KEY (`id_personal`) REFERENCES `personal_2` (`id_personal`);

--
-- Constraints for table `factura_2`
--
ALTER TABLE `factura_2`
  ADD CONSTRAINT `factura_2_ibfk_1` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion_2` (`id_inscripcion`);

--
-- Constraints for table `guarderia_2`
--
ALTER TABLE `guarderia_2`
  ADD CONSTRAINT `guarderia_2_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugar_2` (`id_lugar`),
  ADD CONSTRAINT `guarderia_2_ibfk_2` FOREIGN KEY (`id_enc`) REFERENCES `personal_2` (`id_personal`);

--
-- Constraints for table `guarderia_actividad_2`
--
ALTER TABLE `guarderia_actividad_2`
  ADD CONSTRAINT `guarderia_actividad_2_ibfk_1` FOREIGN KEY (`id_guarderia`) REFERENCES `guarderia_2` (`id_guarderia`),
  ADD CONSTRAINT `guarderia_actividad_2_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividad_2` (`id_actividad`),
  ADD CONSTRAINT `guarderia_actividad_2_ibfk_3` FOREIGN KEY (`id_personal`) REFERENCES `personal_2` (`id_personal`);

--
-- Constraints for table `guarderia_horario_actividad_2`
--
ALTER TABLE `guarderia_horario_actividad_2`
  ADD CONSTRAINT `guarderia_horario_actividad_2_ibfk_1` FOREIGN KEY (`id_horario`) REFERENCES `horario_2` (`id_horario`);

--
-- Constraints for table `horario_guarderia_2`
--
ALTER TABLE `horario_guarderia_2`
  ADD CONSTRAINT `horario_guarderia_2_ibfk_1` FOREIGN KEY (`id_horario`) REFERENCES `horario_2` (`id_horario`),
  ADD CONSTRAINT `horario_guarderia_2_ibfk_2` FOREIGN KEY (`id_guarderia`) REFERENCES `guarderia_2` (`id_guarderia`);

--
-- Constraints for table `horario_inscrip_2`
--
ALTER TABLE `horario_inscrip_2`
  ADD CONSTRAINT `horario_inscrip_2_ibfk_1` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion_2` (`id_inscripcion`),
  ADD CONSTRAINT `horario_inscrip_2_ibfk_2` FOREIGN KEY (`id_ga`) REFERENCES `guarderia_actividad_2` (`id_ga`);

--
-- Constraints for table `inscripcion_2`
--
ALTER TABLE `inscripcion_2`
  ADD CONSTRAINT `inscripcion_2_ibfk_1` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`),
  ADD CONSTRAINT `inscripcion_2_ibfk_2` FOREIGN KEY (`id_guarderia`) REFERENCES `guarderia_2` (`id_guarderia`);

--
-- Constraints for table `lugar_2`
--
ALTER TABLE `lugar_2`
  ADD CONSTRAINT `lugar_2_ibfk_1` FOREIGN KEY (`id_lugar_padre`) REFERENCES `lugar_2` (`id_lugar`);

--
-- Constraints for table `mensualidad_2`
--
ALTER TABLE `mensualidad_2`
  ADD CONSTRAINT `mensualidad_2_ibfk_1` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion_2` (`id_inscripcion`);

--
-- Constraints for table `menu_2`
--
ALTER TABLE `menu_2`
  ADD CONSTRAINT `menu_2_ibfk_1` FOREIGN KEY (`id_guarderia`) REFERENCES `guarderia_2` (`id_guarderia`);

--
-- Constraints for table `nino_2`
--
ALTER TABLE `nino_2`
  ADD CONSTRAINT `nino_2_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `padre_2` (`cedula`);

--
-- Constraints for table `nino_alergia_2`
--
ALTER TABLE `nino_alergia_2`
  ADD CONSTRAINT `nino_alergia_2_ibfk_1` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`),
  ADD CONSTRAINT `nino_alergia_2_ibfk_2` FOREIGN KEY (`id_alergia`) REFERENCES `alergia_2` (`id_alergia`);

--
-- Constraints for table `nino_autorizado_2`
--
ALTER TABLE `nino_autorizado_2`
  ADD CONSTRAINT `nino_autorizado_2_ibfk_1` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`),
  ADD CONSTRAINT `nino_autorizado_2_ibfk_2` FOREIGN KEY (`id_autorizado`) REFERENCES `autorizado_2` (`id_autorizado`);

--
-- Constraints for table `nino_enfermedad_2`
--
ALTER TABLE `nino_enfermedad_2`
  ADD CONSTRAINT `nino_enfermedad_2_ibfk_1` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`),
  ADD CONSTRAINT `nino_enfermedad_2_ibfk_2` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedad_2` (`id_enfermedad`);

--
-- Constraints for table `nino_juego_2`
--
ALTER TABLE `nino_juego_2`
  ADD CONSTRAINT `nino_juego_2_ibfk_1` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`),
  ADD CONSTRAINT `nino_juego_2_ibfk_2` FOREIGN KEY (`id_juego`) REFERENCES `juego_2` (`id_juego`);

--
-- Constraints for table `nino_medicina_sintoma_2`
--
ALTER TABLE `nino_medicina_sintoma_2`
  ADD CONSTRAINT `nino_medicina_sintoma_2_ibfk_1` FOREIGN KEY (`id_sintoma`) REFERENCES `sintoma_2` (`id_sintoma`),
  ADD CONSTRAINT `nino_medicina_sintoma_2_ibfk_2` FOREIGN KEY (`id_medicina`) REFERENCES `medicina_2` (`id_medicina`),
  ADD CONSTRAINT `nino_medicina_sintoma_2_ibfk_3` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`);

--
-- Constraints for table `nino_pediatra_2`
--
ALTER TABLE `nino_pediatra_2`
  ADD CONSTRAINT `nino_pediatra_2_ibfk_1` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`);

--
-- Constraints for table `pago_insc_mens_2`
--
ALTER TABLE `pago_insc_mens_2`
  ADD CONSTRAINT `pago_insc_mens_2_ibfk_1` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion_2` (`id_inscripcion`),
  ADD CONSTRAINT `pago_insc_mens_2_ibfk_2` FOREIGN KEY (`id_mensualidad`) REFERENCES `mensualidad_2` (`id_mensualidad`);

--
-- Constraints for table `parentesco_2`
--
ALTER TABLE `parentesco_2`
  ADD CONSTRAINT `parentesco_2_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `padre_2` (`cedula`),
  ADD CONSTRAINT `parentesco_2_ibfk_2` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`);

--
-- Constraints for table `personal_2`
--
ALTER TABLE `personal_2`
  ADD CONSTRAINT `personal_2_ibfk_1` FOREIGN KEY (`id_guarderia`) REFERENCES `guarderia_2` (`id_guarderia`);

--
-- Constraints for table `pers_capacitado_2`
--
ALTER TABLE `pers_capacitado_2`
  ADD CONSTRAINT `pers_capacitado_2_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividad_2` (`id_actividad`),
  ADD CONSTRAINT `pers_capacitado_2_ibfk_2` FOREIGN KEY (`id_personal`) REFERENCES `personal_2` (`id_personal`);

--
-- Constraints for table `plato_comida_2`
--
ALTER TABLE `plato_comida_2`
  ADD CONSTRAINT `plato_comida_2_ibfk_1` FOREIGN KEY (`id_comida`) REFERENCES `comida_2` (`id_comida`),
  ADD CONSTRAINT `plato_comida_2_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `plato_2` (`id_plato`);

--
-- Constraints for table `plato_menu_2`
--
ALTER TABLE `plato_menu_2`
  ADD CONSTRAINT `plato_menu_2_ibfk_1` FOREIGN KEY (`id_plato`) REFERENCES `plato_2` (`id_plato`),
  ADD CONSTRAINT `plato_menu_2_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu_2` (`id_menu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
