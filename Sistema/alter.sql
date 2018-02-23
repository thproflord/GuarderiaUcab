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
  ADD KEY `semana` (`semana`),
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
  ADD KEY `id_guarderia` (`id_guarderia`),
  ADD KEY `id_actividad` (`id_actividad`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indexes for table `guarderia_horario_actividad_2`
--
ALTER TABLE `guarderia_horario_actividad_2`
  ADD PRIMARY KEY (`id_gha`),
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
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_guarderia` (`id_guarderia`);

--
-- Indexes for table `horario_inscrip_2`
--
ALTER TABLE `horario_inscrip_2`
  ADD KEY `id_inscripcion` (`id_inscripcion`),
  ADD KEY `id_gha` (`id_gha`);

--
-- Indexes for table `inscripcion_2`
--
ALTER TABLE `inscripcion_2`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `id_nino` (`id_nino`),
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
  ADD UNIQUE KEY `num_transferencia` (`num_transferencia`),
  ADD KEY `id_asistencia` (`id_asistencia`);

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
-- Indexes for table `personal_capacidad_2`
--
ALTER TABLE `personal_capacidad_2`
  ADD PRIMARY KEY `id_personal` (`id_perca`);

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
  MODIFY `id_asistencia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
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
  MODIFY `id_explaboral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `factura_2`
--
ALTER TABLE `factura_2`
  MODIFY `id_factura` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `guarderia_2`
--
ALTER TABLE `guarderia_2`
  MODIFY `id_guarderia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `guarderia_actividad_2`
--
ALTER TABLE `guarderia_actividad_2`
  MODIFY `id_ga` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id_sintoma` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `personal_capacidad_2`
  MODIFY `id_perca` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  ADD CONSTRAINT `guarderia_2_ibfk_2` FOREIGN KEY (`id_enc`) REFERENCES `personal_2` (`id_personal`),
  ADD CONSTRAINT `check_tipo` CHECK (tipo in ('Matematica', 'Literatura', 'Arte', 'Deportiva', 'Manualidades'));

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
  ADD CONSTRAINT `horario_inscrip_2_ibfk_2` FOREIGN KEY (`id_gha`) REFERENCES `guarderia_horario_actividad_2` (`id_gha`);

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
-- Constraints for table `pago_multa_2`
--
ALTER TABLE `pago_multa_2`
  ADD CONSTRAINT `pago_multa_2_ibfk_1` FOREIGN KEY (`id_asistencia`) REFERENCES `asistencia_2` (`id_asistencia`);

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
-- Constraints for table `personal_capacidad_2`
--
ALTER TABLE `personal_capacidad_2`
  ADD CONSTRAINT `personal_capacidad_2_ibfk_1` FOREIGN KEY (`id_personal`) REFERENCES `personal_2` (`id_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `check_tipo` CHECK (tipo in ('Matematica', 'Literatura', 'Arte', 'Deportiva', 'Manualidades'));
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