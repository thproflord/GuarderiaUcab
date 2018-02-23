INSERT INTO `actividad_2` (`id_actividad`, `codigo`, `nombre`, `transporte`, `costo_trans`, `edad_minima`, `descripcion`) VALUES
(1, 'A001', 'Natacion', 0, NULL, 3, 'Natacion para ninos'),
(2, 'A002', 'Musica', 0, NULL, 3, 'Musica primeros pasos'),
(3, 'A003', 'Pintura', 0, NULL, 2, 'Pintura y aprendizaje'),
(4, 'A004', 'Futbol', 1, 10000, 3, 'Aprendiendo del futbol'),
(5, 'A005', 'Babygym', 1, 4500, 6, 'Ejercitate diviertiendote!');

#Alergias
INSERT INTO `alergia_2` (`id_alergia`, `codigo`, `descripcion`) VALUES
(1, 'AL001', 'Alergia a los lacteos'),
(2, 'AL002', 'Alergia al polvo'),
(3, 'AL003', 'Alergia a los gatos'),
(4, 'AL004', 'Alergia al sol'),
(5, 'AL005', 'Alergia a los refrescos');

#Autorizados
INSERT INTO `autorizado_2` (`id_autorizado`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES
(1, 6712151, 'Arturo', 'Garanton', '4143017530'),
(2, 13712653, 'Pedro', 'Infante', '4128876512'),
(3, 12261243, 'Miguel', 'Bellardi', '4162255421'),
(4, 8823712, 'Jose', 'Fernandez', '4249921324'),
(5, 9986213, 'Jesus', 'Mejias', '4149351245');

#Comida
INSERT INTO `comida_2` (`id_comida`, `tipo`, `descripcion`) VALUES
(1, 1, 'Carne'),
(2, 1, 'Pollo'),
(3, 1, 'Atun'),
(4, 1, 'Espinaca'),
(5, 1, 'Mero'),
(6, 2, 'Ensalada mediterranea'),
(7, 2, 'Ensalada de tomate y lechuga'),
(8, 2, 'Ensalada rayada'),
(9, 2, 'Ensalada de garbanzos'),
(10, 2, 'Ensalada de zanahorias babys y papa'),
(11, 3, 'Jugo de melon'),
(12, 3, 'Jugo de lechoza'),
(13, 3, 'Jugo de naranja'),
(14, 3, 'Jugo de parchita'),
(15, 3, 'Jugo de patilla'),
(16, 4, 'Rodajas de pan'),
(17, 4, 'Papas fritas'),
(18, 4, 'Arroz'),
(19, 4, 'Pasta'),
(20, 4, 'Pure de papa');

#Enfermedad
INSERT INTO `enfermedad_2` (`id_enfermedad`, `codigo`, `descripcion`) VALUES
(1, 'EN001', 'Sarampion'),
(2, 'EN002', 'Jaquecas'),
(3, 'EN003', 'Bronquitis'),
(4, 'EN004', 'Otitis'),
(5, 'EN005', 'Varicela');

#Lugar
INSERT INTO `lugar_2` (`id_lugar`, `id_lugar_padre`, `nombre`, `tipo`) VALUES
(1, NULL, 'Lara', 1),
(2, 1, 'Barquisimeto', 2),
(3, NULL, 'Barcelona', 2),
(4, NULL, 'Valencia', 2),
(5, NULL, 'Zulia', 1),
(6,NULL,'Caracas',2);

#Guarderia
INSERT INTO `guarderia_2` (`id_guarderia`, `id_lugar`, `id_enc`, `rif`, `nombre`, `telefonos`, `costo`) VALUES
(1, 2, NULL, 'V87659123', 'Sede Barquisimeto', '2129767840', 100000),
(2, 3, NULL, 'V77812432', 'Sede Barcelona', '28129854222', 120000),
(3, 5, NULL, 'V912452131', 'Sede Zulia', '2627881422', 350000),
(4, 4, NULL, 'V124551678', 'Sede Valencia', '2419972152', 200000),
(5, 3, NULL, 'V77812434', 'Sede Barcelona V2', '2819219215', 120000);

INSERT INTO `horario_2` (`id_horario`, `dia`) VALUES
(4, 'Jueves'),
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(5, 'Viernes');


#Juego
INSERT INTO `juego_2` (`id_juego`, `codigo`, `descripcion`) VALUES
(1, 'J001', 'Jugando con matematicas'),
(2, 'J002', 'Juegos motrices'),
(3, 'J003', 'Juegos para aprender la hora'),
(4, 'J004', 'Aprende los colores'),
(5, 'J005', 'Diversion con las formas geometricas');

#Medicina
INSERT INTO `medicina_2` (`id_medicina`, `codigo`, `descripcion`) VALUES
(1, 'MED001', 'Ibuprofeno'),
(2, 'MED002', 'Brugesic'),
(3, 'MED003', 'Bisolvon'),
(4, 'MED004', 'Tachipirin'),
(5, 'MED005', 'Scott');


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

INSERT INTO `plato_2` (`id_plato`, `codigo`, `descripcion`) VALUES
(1, 'PL001', 'Arroz con pollo, jugo de parchita, ensalada'),
(2, 'PL002', 'Carne molida con tostones, jugo de lechoza, ensalada'),
(3, 'PL003', 'Bisteck con papas fritas,jugo de pina, ensalada'),
(4, 'PL004', 'Sopa de pollo, jugo mora, ensalada'),
(5, 'PL005', 'Nuggets de pollo y papas al horno, jugo de pera, ensalada'),
(6, 'PL006', 'Sushi, jugo de mango, ensalada'),
(7, 'PL007', 'Hamburguesa de pescado y papas fritas, jugo de naranja, ensalada'),
(8, 'PL008', 'Milanesa de carne y arroz, jugo de manzana, ensalada'),
(9, 'PL009', 'Mondongo, jugo de pera, ensalada'),
(10, 'PL0010', 'Pernil y vegetales, jugo de lechoza, ensalada');

INSERT INTO `padre_2` (`cedula`, `nombre`, `apellido`, `direccion`, `email`, `tel_casa`, `tel_ofic`, `tel_celular`, `profesion`, `edo_civil`, `principal`, `vivenino`) VALUES
(1234567881, 'Alexander', 'De Azevedo', 'el paraiso', 'jmedina@hotmail.com', '2121234567881', '2121234567882', '4241234567881', 'fotografo', 'soltero', 1, 'S'),
(1234567882, 'Sergio', 'Medina', 'Catia', 'sagg305@hotmail.com', '2121234567882', '2121234567882', '4241234567882', 'futbolista', 'casado', 1, 'N'),
(1234567883, 'Greg', 'Gomez', 'La Urbina', 'greggomez@hotmail.com', '2121234567883', '2121234567884', '4241234567883', 'musico', 'soltero', 1, 'N'),
(1234567884, 'Karliam', 'Medina', 'San Antonio de los Altos', 'karliam@hotmail.com', '2121234567885', '2121234567886', '4241234567884', 'cantante', 'soltero', 1, 'N'),
(1234567885, 'Christian', 'Neira', 'San Juan', 'christian_neira@hotmail.com', '2121234567885', '2121234567887', '4241234567885', 'pintor', 'soltero', 1, 'S'),
(1234567886, 'Pedro', 'De Leon', 'Los Simbolos', 'pedrodeleon@hotmail.com', '2121234567886', '2121234567888', '4241234567886', 'disenador grafico', 'casado', 1, 'N'),
(1234567887, 'Pedro', 'Alvarez', 'Santa Monica', 'pedroalvarez@hotmail.com', '2121234567887', '2121234567889', '4241234567888', 'disenador grafico', 'soltero', 1, 'S'),
(1234567891, 'Luis', 'Martinez', 'El paraiso', 'luismartinez@gmail.com', '2121234567891', '2121234567892', '4241234567891', 'abogado', 'soltero', 1, 'S'),
(1234567892, 'Luifer', 'Martinez', 'El paraiso', 'luifermartinez@gmail.com', '2121234567892', '2121234567893', '4241234567892', 'ingeniero', 'casado', 1, 'S'),
(1234567893, 'Luisa', 'Morales', 'Montalban', 'luisita@gmail.com', '2121234567893', '2121234567894', '4241234567893', 'fotografo', 'soltero', 1, 'S'),
(1234567894, 'Maria', 'Perez', 'El valle', 'maria@gmail.com', '2121234567894', '2121234567895', '4241234567894', 'bombero', 'soltero', 1, 'N'),
(1234567895, 'Jessica', 'Medina', 'La lagunita', 'jessicam@hotmail.com', '2121234567895', '2121234567896', '4241234567895', 'modelo', 'soltero', 1, 'S'),
(1234567896, 'Iris', 'Ilarraza', 'La lagunita', 'irisfashion@hotmail.com', '2121234567896', '2121234567897', '4241234567896', 'medico', 'soltero', 1, 'N'),
(1234567897, 'Fatima', 'Goncalves', 'La lagunita', 'fatimag@hotmail.com', '2121234567897', '2121234567898', '4241234567897', 'profesor', 'casado', 1, 'N'),
(1234567898, 'Ramon', 'Medina', 'La lagunita', 'ramonmedina@hotmail.com', '2121234567898', '2121234567899', '4241234567898', 'abogado', 'soltero', 1, 'S'),
(1234567899, 'Fernando', 'Gomes', 'La Bandera', 'fernandog@yahoo.com', '2121234567899', '2121234567896', '4241234567899', 'odontologo', 'soltero', 1, 'N');

INSERT INTO `nino_2` (`id_nino`, `id_padre`, `letra`, `nombre`, `apellido`, `fecha_nac`, `sexo`) VALUES
(1, 1234567891, 'A1234567891', 'Alexander', 'Martinez', '02/02/2002', 'Masculino'),
(2, 1234567891, 'B1234567891', 'Brayan', 'Martinez', '02/02/2004', 'Masculino'),
(3, 1234567892, 'A1234567892', 'Carlos', 'Martinez', '02/03/2004', 'Masculino'),
(4, 1234567895, 'A1234567895', 'Fatima', 'Medina', '27/11/2003', 'Femenino'),
(5, 1234567895, 'B1234567895', 'Fabiana', 'Medina', '13/12/2003', 'Femenino'),
(6, 1234567885, 'A1234567885', 'Luis', 'Neira', '02/02/2002', 'Masculino'),
(7, 1234567887, 'A1234567887', 'Pedro', 'Alvarez', '02/02/2004', 'Masculino'),
(8, 1234567893, 'A1234567893', 'Karliedis', 'Morales', '02/03/2004', 'Femenino'),
(9, 1234567883, 'A1234567883', 'Fanny', 'Gomez', '27/09/2003', 'Femenino'),
(10, 1234567882, 'A1234567882', 'Alexandra', 'Medina', '13/12/2003', 'Femenino'),
(11, 1234567896, 'A1234567896', 'Saccha', 'Ilarraza', '01/02/2002', 'Femenino'),
(12, 1234567891, 'C1234567891', 'Brayan', 'Martinez', '02/02/2004', 'Masculino'),
(13, 1234567891, 'D1234567891', 'Carlos', 'Martinez', '05/03/2004', 'Masculino'),
(14, 1234567895, 'C1234567895', 'Fatima', 'Medina', '23/06/2004', 'Femenino'),
(15, 1234567895, 'D1234567895', 'Fabiana', 'Medina', '19/10/2005', 'Femenino'),
(16, 1234567883, 'B1234567883', 'Luis', 'Gomez', '02/02/2002', 'Masculino'),
(17, 1234567881, 'A1234567881', 'Pedro', 'De Azevedo', '02/02/2004', 'Masculino'),
(18, 1234567897, 'A1234567897', 'Karliedis', 'Goncalves', '09/03/2004', 'Femenino'),
(19, 1234567898, 'A1234567898', 'Monica', 'Medina', '27/09/2004', 'Femenino'),
(20, 1234567898, 'B1234567898', 'Alexandra', 'Medina', '13/12/2003', 'Femenino'),
(21, 1234567892, 'B1234567892', 'Saccha', 'Martinez', '01/02/2002', 'Femenino'),
(22, 1234567893, 'A1234567893', 'Eduardo', 'Morales', '08/02/2004', 'Masculino'),
(23, 1234567896, 'B1234567896', 'Carlos', 'Ilarraza', '05/03/2003', 'Masculino'),
(24, 1234567894, 'A1234567894', 'Fatima', 'Perez', '21/06/2004', 'Femenino'),
(25, 1234567894, 'B1234567894', 'Fabiana', 'Perez', '19/10/2005', 'Femenino');

INSERT INTO `pediatra_2` (`id_pediatra`, `cedula`, `nombre`, `telefono`) VALUES
(1, 1234567871, 'Alexander', '4241234567'),
(2, 1234567872, 'Brayan', '4241234561'),
(3, 1234567873, 'Carlos', '4241234565'),
(4, 1234567874, 'Fatima', '4241234569'),
(5, 1234567875, 'Fabiana', '4241234563');

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
(17, 4, 1214567892, 'Monica', 'Gomes', 'la urbina', '4241234532', 'tsu', 1000000),
(18, 4, 1234327893, 'Carlos', 'Perez', 'la tahona', '4241234535', 'tsu', 900000),
(19, 4, 1234167894, 'Rafael', 'Jimenez', 'petare', '4241234537', 'tsu', 1100000),
(20, 4, 1234267895, 'Fabiana', 'Fernadez', 'la trinidad', '4241234539', 'universitario', 2000000),
(21, 5, 1234367881, 'Luis', 'Gomez', 'el paraiso', '4241234551', 'bachillerato', 1500000),
(22, 5, 1231567882, 'Monica', 'Gomes', 'la urbina', '4241234552', 'bachillerato', 1200000),
(23, 5, 1234267883, 'Carlos', 'Perez', 'la tahona', '4241234555', 'tsu', 900000),
(24, 5, 1234567884, 'Rafael', 'Jimenez', 'petare', '4241234557', 'tsu', 1100000),
(25, 5, 1134567885, 'Fabiana', 'Fernadez', 'la trinidad', '4241234559', 'universitario', 2100000);

INSERT INTO `sintoma_2` (`id_sintoma`, `codigo`, `descripcion`) VALUES
(1, 'SI001', 'Dolor de cabeza'),
(2, 'SI002', 'Diarrea'),
(3, 'SI003', 'irritabilidad'),
(4, 'SI004', 'Fatiga'),
(5, 'SI005', 'Apatia'),
(6, 'SI006', 'Nausea');


INSERT INTO `inscripcion_2` (`id_inscripcion`, `id_nino`, `id_guarderia`, `ano`, `consecutivo`, `cont_horas_extra`, `hora_desde`, `hora_hasta`, `fecha_insc`) VALUES
(1, 1, 1, 2018, 1, 1, '7', '9', '18/02/2018'),
(2, 2, 1, 2018, 1, 0, '7', '9', '17/02/2018'),
(3, 3, 1, 2018, 1, 0, '8', '12', '16/02/2018'),
(4, 4, 1, 2018, 1, 0, '12', '6', '19/01/2018'),
(5, 5, 1, 2018, 1, 0, '12', '6', '13/02/2018'),
(6, 6, 2, 2018, 1, 1, '7', '13', '27/02/2018'),
(7, 7, 2, 2018, 1, 1, '9', '4', '26/02/2018'),
(8, 8, 2, 2018, 1, 1, '11', '4', '25/02/2018'),
(9, 9, 2, 2018, 1, 1, '1', '6', '24/01/2018'),
(10, 10, 2, 2018, 1, 1, '3', '5', '23/02/2018'),
(11, 11, 3, 2017, 1, 0, '7', '9', '08/12/2017'),
(12, 12, 3, 2017, 1, 0, '7', '9', '07/12/2017'),
(13, 13, 3, 2017, 1, 0, '7', '9', '06/12/2017'),
(14, 14, 3, 2017, 1, 0, '12', '6', '05/01/2017'),
(15, 15, 3, 2017, 1, 0, '12', '6', '04/12/2017'),
(16, 16, 4, 2018, 1, 0, '1', '6', '13/01/2018'),
(17, 17, 4, 2018, 1, 1, '9', '11', '12/01/2018'),
(18, 18, 4, 2018, 1, 1, '11', '5', '15/01/2018'),
(19, 19, 4, 2018, 1, 1, '1', '5', '11/01/2018'),
(20, 20, 4, 2018, 1, 1, '1', '5', '10/02/2018'),
(21, 21, 5, 2017, 1, 1, '7', '9', '09/12/2017'),
(22, 22, 5, 2017, 1, 1, '10', '12', '03/12/2017'),
(23, 23, 5, 2017, 1, 0, '11', '4', '05/12/2017'),
(24, 24, 5, 2017, 1, 0, '1', '3', '01/01/2017'),
(25, 25, 5, 2017, 1, 0, '4', '6', '02/12/2017');

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

INSERT INTO `asistencia_2` (`id_asistencia`, `id_padre`, `id_autorizado`, `id_inscripcion`, `hora_llegada`, `hora_salida`, `dia`, `comio`) VALUES
(1, 1234567891, NULL, 1, 7, 9, 'Lunes', 1),
(2, 1234567891, NULL, 2, 7, 9, 'Lunes', 0),
(3, 1234567892, NULL, 3, 8, 12, 'Martes', 1),
(4, 1234567895, NULL, 4, 12, 6, 'Miercoles', 1),
(5, 1234567895, NULL, 5, 12, 6, 'Miercoles', 0),
(6, 1234567885, NULL, 6, 7, 1, 'Lunes', 1),
(7, 1234567887, NULL, 7, 9, 3, 'Miercoles', 0),
(8, 1234567893, NULL, 8, 11, 4, 'Miercoles', 1),
(9, 1234567883, NULL, 9, 1, 6, 'Jueves', 1),
(10, 1234567882, NULL, 10, 3, 5, 'Jueves', 1),
(11, 1234567896, NULL, 11, 3, 5, 'Viernes', 0),
(12, 1234567891, NULL, 12, 7, 9, 'Lunes', 1),
(13, 1234567891, NULL, 13, 7, 9, 'Lunes', 1),
(14, 1234567895, NULL, 14, 12, 6, 'Miercoles', 1),
(15, 1234567895, NULL, 15, 12, 6, 'Miercoles', 1),
(16, 1234567883, NULL, 16, 1, 6, 'Jueves', 1),
(17, 1234567881, NULL, 17, 9, 11, 'Martes', 0),
(18, 1234567897, NULL, 18, 11, 5, 'Miercoles', 1),
(19, 1234567898, NULL, 19, 1, 5, 'Viernes', 1),
(20, 1234567898, NULL, 20, 1, 5, 'Viernes', 1),
(21, 1234567892, NULL, 21, 7, 8, 'Miercoles', 1),
(22, 1234567895, NULL, 22, 12, 6, 'Miercoles', 1),
(23, 1234567893, NULL, 23, 11, 4, 'Jueves', 1),
(24, 1234567884, NULL, 24, 1, 3, 'Martes', 1),
(25, 1234567885, NULL, 25, 4, 5, 'Lunes', 1);

INSERT INTO `factura_2` (`id_factura`, `id_inscripcion`, `semana`, `num_transferencia`) VALUES
(1, 1, 1, 8975421312),
(2, 3, 4, 78522162712),
(3, 5, 15, 343831111),
(4, 4, 12, 2285443721),
(5, 12, 13, 1937471118),
(6, 18, 18, 19822774231),
(7, 11, 30, 62728182551),
(8, 20, 31, 38872611554),
(9, 25, 32, 17472819312),
(10, 16, 47, 12228173911);

INSERT INTO `detalle_factura_2` (`id_factura`, `id_menu`, `fechapago`, `monto`) VALUES
(1, 1, '06/01/2018', 50000),
(2, 1, '18/01/2018', 55000),
(3, 2, '17/04/2018', 60000),
(4, 4, '01/03/2018', 55000),
(5, 5, '08/03/2018', 58000),
(6, 3, '09/06/2018', 70000),
(7, 2, '10/09/2018', 150000),
(8, 5, '18/09/2018', 160000),
(9, 3, '24/09/2018', 160000),
(10, 1, '24/12/2018', 180000);

INSERT INTO `exp_laboral_2` (`id_explaboral`, `id_personal`, `descripcion`) VALUES
(1, 1, 'Educacion pre-escolar en colegio Madre Matilde'),
(2, 3, 'Guia en campamento Mi guarimba'),
(3, 5, 'Educacion pre-escolar en colegio Simon Bolivar'),
(4, 8, 'Guia en campamento Guarandor'),
(5, 12, 'Educacion basica en colegio La Salle'),
(6, 16, 'Educacion basica en colegio Madre Matilde'),
(7, 9, 'Educacion pre-escolar en colegio La concepcion'),
(8, 18, 'Guia en campamento La Escondida'),
(9, 21, 'Educacion pre-escolar en colegio San Antonio'),
(10, 25, 'Educacion basica en colegio Cervantes');

INSERT INTO `guarderia_actividad_2` (`id_ga`, `id_guarderia`, `id_actividad`, `id_personal`, `cupomin`, `cupomax`) VALUES
(1, 1, 1, 1, 2, 10),
(2, 1, 3, 5, 3, 7),
(3, 2, 4, 10, 7, 15),
(4, 2, 5, 8, 2, 15),
(5, 3, 2, 15, 1, 5),
(6, 3, 3, 25, 3, 6),
(7, 4, 2, 14, 2, 8),
(8, 4, 4, 3, 6, 14),
(9, 5, 1, 2, 2, 10),
(10, 5, 3, 4, 3, 5);

INSERT INTO `guarderia_horario_actividad_2` (`id_gha`, `id_ga`, `id_horario`, `hora_inicio`, `hora_fin`) VALUES
(1, 1, 1, 10, 11),
(2, 2, 1, 9, 10),
(3, 3, 2, 3, 4),
(4, 4, 5, 3, 4),
(5, 5, 4, 9, 10),
(6, 6, 3, 1, 2),
(7, 7, 3, 3, 4),
(8, 8, 1, 9, 10),
(9, 9, 3, 2, 3),
(10, 10, 1, 9, 10);

INSERT INTO `horario_guarderia_2` (`id_horario`, `id_guarderia`, `hora_inicio`, `hora_fin`, `cant_inscritos`) VALUES
(1, 1, 7, 5, 5),
(1, 2, 6, 6, 5),
(2, 3, 7, 5, 5),
(3, 4, 7, 6, 5),
(5, 5, 8, 4, 5);


INSERT INTO `horario_inscrip_2` (`id_inscripcion`, `id_gha`, `costo`) VALUES
(1, 1, 130000),
(3, 5, 80000),
(4, 3, 70000),
(2, 4, 65000),
(7, 10, 88000),
(6, 9, 44000),
(12, 7, 60000),
(20, 2, 55000),
(25, 6, 70000),
(21, 8, 80000);


INSERT INTO `nino_alergia_2` (`id_nino`, `id_alergia`) VALUES
(1, 5),
(2, 3),
(1, 3),
(3, 4),
(5, 2),
(7, 1),
(8, 2),
(12, 5),
(25, 1),
(22, 1);

INSERT INTO `nino_autorizado_2` (`id_nino`, `id_autorizado`) VALUES
(1, 1),
(2, 2),
(1, 3),
(3, 4),
(5, 5);


INSERT INTO `nino_enfermedad_2` (`id_nino`, `id_enfermedad`, `fechacontagio`) VALUES
(24, 5, '18/01/2013'),
(12, 1, '19/04/2015'),
(13, 4, '20/02/2016'),
(3, 3, '12/06/2015'),
(16, 2, '13/07/2017'),
(18, 1, '14/12/2016'),
(15, 3, '3/11/2014');

INSERT INTO `nino_juego_2` (`id_nino`, `id_juego`) VALUES
(1, 5),
(2, 3),
(1, 3),
(3, 4),
(5, 2),
(7, 1),
(8, 2),
(12, 5),
(25, 1),
(22, 1);

INSERT INTO `nino_pediatra_2` (`id_nino`, `id_pediatra`) VALUES
(1, 5),
(2, 3),
(1, 3),
(3, 4),
(5, 2),
(7, 1),
(8, 2),
(12, 5),
(25, 1),
(22, 1);

INSERT INTO `nino_medicina_sintoma_2` (`id_sintoma`, `id_medicina`, `id_nino`, `cantidad`) VALUES
(1, 5, 4, '2 Cucharadas'),
(2, 3, 2, '1 Pastilla'),
(1, 3, 3, '1 Cucharada'),
(3, 4, 5, 'Media pastilla'),
(5, 2, 8, '1 Cucharada'),
(3, 1, 12, '1 Pastilla'),
(4, 2, 16, '1 Pastilla'),
(1, 5, 17, '1 Cucharada'),
(2, 1, 24, '1 Pastilla'),
(2, 3, 13, 'Media Cucharada');

INSERT INTO `personal_capacitado_2` (`id_personal`, `tipo`) VALUES
(1, 'Matematica'),
(5, 'Arte'),
(2, 'Manualidades'),
(4, 'Deportivas'),
(3, 'Literatura');

INSERT INTO `pers_capacitado_2` (`id_actividad`, `id_personal`) VALUES
(1, 5),
(5, 3),
(2, 8),
(4, 9),
(3, 15);

INSERT INTO `plato_comida_2` (`id_comida`, `id_plato`) VALUES
(1, 1),
(6, 1),
(11, 1),
(16, 1),
(2, 2),
(7, 2),
(12, 2),
(17, 2),
(3, 3),
(8, 3),
(13, 3),
(18, 3);

INSERT INTO `plato_menu_2` (`id_plato`, `id_menu`) VALUES
(1, 1),
(2, 3),
(3, 6),
(3, 8),
(4, 4),
(5, 11),
(6, 13),
(7, 17),
(8, 18),
(9, 12),
(10, 9);




