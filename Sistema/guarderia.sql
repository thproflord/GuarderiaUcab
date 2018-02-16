-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2018 at 06:16 PM
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
  `codigo` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `transporte` tinyint(2) UNSIGNED NOT NULL,
  `costo_trans` float UNSIGNED NOT NULL,
  `edad_minima` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alergia_2`
--

CREATE TABLE `alergia_2` (
  `id_alergia` int(11) NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `nombre` int(11) NOT NULL,
  `apellido` int(11) NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comida_2`
--

CREATE TABLE `comida_2` (
  `id_comida` int(11) NOT NULL,
  `tipo` tinyint(2) NOT NULL COMMENT '1: proteina, 2: ensalada , 3: jugo , 4:carbohidrato',
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `codigo` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_lugar` int(11) UNSIGNED NOT NULL,
  `rif` varchar(12) NOT NULL,
  `nombre` varchar(12) NOT NULL,
  `telefonos` int(11) UNSIGNED NOT NULL,
  `costo` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `ano` int(11) UNSIGNED NOT NULL,
  `consecutivo` int(11) UNSIGNED NOT NULL,
  `cont_horas_extra` tinyint(1) DEFAULT NULL COMMENT '1: Si , 0 : No',
  `hora_desde` varchar(5) NOT NULL,
  `hora_hasta` varchar(5) NOT NULL,
  `fecha_insc` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `juego_2`
--

CREATE TABLE `juego_2` (
  `id_juego` int(11) UNSIGNED NOT NULL,
  `codigo` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lugar_2`
--

CREATE TABLE `lugar_2` (
  `id_lugar` int(11) UNSIGNED NOT NULL,
  `id_lugar_padre` int(11) UNSIGNED NOT NULL,
  `nombre` int(11) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '0: Estado, 1: ciudad, 2: pais'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medicina_2`
--

CREATE TABLE `medicina_2` (
  `id_medicina` int(11) UNSIGNED NOT NULL,
  `codigo` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `menu_2`
--

CREATE TABLE `menu_2` (
  `id_menu` int(11) UNSIGNED NOT NULL,
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `numero` int(11) UNSIGNED NOT NULL,
  `dia` varchar(8) NOT NULL,
  `semana` int(11) UNSIGNED NOT NULL,
  `costo` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nino_2`
--

CREATE TABLE `nino_2` (
  `id_nino` int(11) NOT NULL,
  `id_padre` int(11) UNSIGNED NOT NULL,
  `letra` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `fecha_nac` int(11) NOT NULL,
  `sexo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_padre` int(11) UNSIGNED NOT NULL,
  `cedula` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `direccion` varchar(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `tel_casa` int(11) NOT NULL,
  `tel_ofic` int(11) NOT NULL,
  `tel_celular` int(11) NOT NULL,
  `profesion` varchar(11) NOT NULL,
  `edo_civil` varchar(11) NOT NULL,
  `principal` tinyint(1) NOT NULL COMMENT '1 : Si 0 : No',
  `vivenino` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `tipo_pago` int(10) UNSIGNED NOT NULL,
  `monto` int(10) UNSIGNED NOT NULL,
  `numero_cheque` int(10) UNSIGNED DEFAULT NULL,
  `numero_tarjeta` int(10) UNSIGNED DEFAULT NULL,
  `monto_debito` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_2`
--

CREATE TABLE `personal_2` (
  `id_personal` int(11) UNSIGNED NOT NULL,
  `id_guarderia` int(11) UNSIGNED NOT NULL,
  `id_guarderia_encarg` int(11) UNSIGNED DEFAULT NULL,
  `cedula` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellidos` varchar(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `nivel_estudio` text NOT NULL COMMENT 'bachillerato, TSU, universitario, postgrado',
  `sueldo` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `codigo` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `codigo` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD KEY `id_lugar` (`id_lugar`);

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
  ADD UNIQUE KEY `ano` (`ano`),
  ADD UNIQUE KEY `consecutivo` (`consecutivo`),
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
  ADD UNIQUE KEY `id_inscripcion` (`id_inscripcion`),
  ADD UNIQUE KEY `consecutivo` (`consecutivo`);

--
-- Indexes for table `menu_2`
--
ALTER TABLE `menu_2`
  ADD PRIMARY KEY (`id_menu`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD UNIQUE KEY `dia` (`dia`),
  ADD UNIQUE KEY `semana` (`semana`),
  ADD KEY `id_guarderia` (`id_guarderia`);

--
-- Indexes for table `nino_2`
--
ALTER TABLE `nino_2`
  ADD PRIMARY KEY (`id_nino`),
  ADD UNIQUE KEY `letra` (`letra`),
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
  ADD PRIMARY KEY (`id_padre`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indexes for table `pago_insc_mens_2`
--
ALTER TABLE `pago_insc_mens_2`
  ADD PRIMARY KEY (`id_pim`),
  ADD UNIQUE KEY `numero` (`numero`),
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
  ADD KEY `id_guarderia` (`id_guarderia`),
  ADD KEY `id_guarderia_encarg` (`id_guarderia_encarg`);

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
  MODIFY `id_actividad` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alergia_2`
--
ALTER TABLE `alergia_2`
  MODIFY `id_alergia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asistencia_2`
--
ALTER TABLE `asistencia_2`
  MODIFY `id_asistencia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `autorizado_2`
--
ALTER TABLE `autorizado_2`
  MODIFY `id_autorizado` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comida_2`
--
ALTER TABLE `comida_2`
  MODIFY `id_comida` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enfermedad_2`
--
ALTER TABLE `enfermedad_2`
  MODIFY `id_enfermedad` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
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
  MODIFY `id_guarderia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guarderia_actividad_2`
--
ALTER TABLE `guarderia_actividad_2`
  MODIFY `id_ga` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horario_2`
--
ALTER TABLE `horario_2`
  MODIFY `id_horario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inscripcion_2`
--
ALTER TABLE `inscripcion_2`
  MODIFY `id_inscripcion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `juego_2`
--
ALTER TABLE `juego_2`
  MODIFY `id_juego` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lugar_2`
--
ALTER TABLE `lugar_2`
  MODIFY `id_lugar` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medicina_2`
--
ALTER TABLE `medicina_2`
  MODIFY `id_medicina` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mensualidad_2`
--
ALTER TABLE `mensualidad_2`
  MODIFY `id_mensualidad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_2`
--
ALTER TABLE `menu_2`
  MODIFY `id_menu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nino_2`
--
ALTER TABLE `nino_2`
  MODIFY `id_nino` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `padre_2`
--
ALTER TABLE `padre_2`
  MODIFY `id_padre` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pago_insc_mens_2`
--
ALTER TABLE `pago_insc_mens_2`
  MODIFY `id_pim` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pago_multa_2`
--
ALTER TABLE `pago_multa_2`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pediatra_2`
--
ALTER TABLE `pediatra_2`
  MODIFY `id_pediatra` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_2`
--
ALTER TABLE `personal_2`
  MODIFY `id_personal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sintoma_2`
--
ALTER TABLE `sintoma_2`
  MODIFY `id_sintoma` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `asistencia_2`
--
ALTER TABLE `asistencia_2`
  ADD CONSTRAINT `asistencia_2_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `padre_2` (`id_padre`),
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
  ADD CONSTRAINT `guarderia_2_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugar_2` (`id_lugar`);

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
  ADD CONSTRAINT `nino_2_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `padre_2` (`id_padre`);

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
  ADD CONSTRAINT `parentesco_2_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `padre_2` (`id_padre`),
  ADD CONSTRAINT `parentesco_2_ibfk_2` FOREIGN KEY (`id_nino`) REFERENCES `nino_2` (`id_nino`);

--
-- Constraints for table `personal_2`
--
ALTER TABLE `personal_2`
  ADD CONSTRAINT `personal_2_ibfk_1` FOREIGN KEY (`id_guarderia`) REFERENCES `guarderia_2` (`id_guarderia`),
  ADD CONSTRAINT `personal_2_ibfk_2` FOREIGN KEY (`id_guarderia_encarg`) REFERENCES `guarderia_2` (`id_guarderia`);

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
