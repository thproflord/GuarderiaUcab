#Actividades
INSERT INTO `actividad_2`(`id_actividad`, `codigo`, `nombre`, `transporte`, `costo_trans`, `edad_minima`, `descripcion`) VALUES 
(1,'A001','Natacion',0,NULL,3,'Natacion para niños');
INSERT INTO `actividad_2`(`id_actividad`, `codigo`, `nombre`, `transporte`, `costo_trans`, `edad_minima`, `descripcion`) VALUES 
(2,'A002','Musica',0,NULL,3,'Musica primeros pasos');
INSERT INTO `actividad_2`(`id_actividad`, `codigo`, `nombre`, `transporte`, `costo_trans`, `edad_minima`, `descripcion`) VALUES 
(3,'A003','Pintura',0,NULL,2,'Pintura y aprendizaje');
INSERT INTO `actividad_2`(`id_actividad`, `codigo`, `nombre`, `transporte`, `costo_trans`, `edad_minima`, `descripcion`) VALUES 
(4,'A004','Futbol',1,10000,3,'Aprendiendo del futbol');
INSERT INTO `actividad_2`(`id_actividad`, `codigo`, `nombre`, `transporte`, `costo_trans`, `edad_minima`, `descripcion`) VALUES 
(1,'A005','Babygym',1,4500,6,'Ejercitate diviertiendote!');

#Alergias
INSERT INTO `alergia_2`(`id_alergia`, `codigo`, `descripcion`) VALUES (1,'AL001','Alergía a los lacteos');
INSERT INTO `alergia_2`(`id_alergia`, `codigo`, `descripcion`) VALUES (2,'AL002','Alergía al polvo');
INSERT INTO `alergia_2`(`id_alergia`, `codigo`, `descripcion`) VALUES (3,'AL003','Alergía a los gatos');
INSERT INTO `alergia_2`(`id_alergia`, `codigo`, `descripcion`) VALUES (4,'AL004','Alergía al sol');
INSERT INTO `alergia_2`(`id_alergia`, `codigo`, `descripcion`) VALUES (5,'AL005','Alergía a los refrescos');

#Autorizados
INSERT INTO `autorizado_2`(`id_autorizado`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES (1,6712151,'Arturo','Garanton',04143017530);
INSERT INTO `autorizado_2`(`id_autorizado`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES (2,13712653,'Pedro','Infante',04128876512);
INSERT INTO `autorizado_2`(`id_autorizado`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES (3,12261243,'Miguel','Bellardi',04162255421);
INSERT INTO `autorizado_2`(`id_autorizado`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES (4,8823712,'Jose','Fernandez',04249921324);
INSERT INTO `autorizado_2`(`id_autorizado`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES (5,9986213,'Jesus','Mejias',04149351245);

#Comida
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (1,1,'Carne');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (2,1,'Pollo');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (3,1,'Atún');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (4,1,'Espinaca');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (5,1,'Mero');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (6,2,'Ensalada mediterranea');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (7,2,'Ensalada de tomate y lechuga con aderezo de parchita ');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (8,2,'Ensalada rayada');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (9,2,'Ensalada de garbanzos');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (10,2,'Ensalada de zanahorias babys y papa');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (11,3,'Jugo de melón');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (12,3,'Jugo de lechoza');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (13,3,'Jugo de naranja');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (14,3,'Jugo de parchita');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (15,3,'Jugo de patilla');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (16,4,'Rodajas de pan');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (17,4,'Papas fritas');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (18,4,'Arroz');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (19,4,'Pasta');
INSERT INTO `comida_2`(`id_comida`, `tipo`, `descripcion`) VALUES (20,4,'Pure de papa'); 

#Enfermedad
INSERT INTO `enfermedad_2`(`id_enfermedad`, `codigo`, `descripcion`) VALUES (1,'EN001','Sarampión');
INSERT INTO `enfermedad_2`(`id_enfermedad`, `codigo`, `descripcion`) VALUES (2,'EN002,'Jaquecas');
INSERT INTO `enfermedad_2`(`id_enfermedad`, `codigo`, `descripcion`) VALUES (3,'EN003,'Bronquitis');
INSERT INTO `enfermedad_2`(`id_enfermedad`, `codigo`, `descripcion`) VALUES (4,'EN004','Otitis');
INSERT INTO `enfermedad_2`(`id_enfermedad`, `codigo`, `descripcion`) VALUES (5,'EN005,'Varicela');

#Lugar
INSERT INTO `lugar_2`(`id_lugar`, `id_lugar_padre`, `nombre`, `tipo`) VALUES (1,NULL,'Lara',1);
INSERT INTO `lugar_2`(`id_lugar`, `id_lugar_padre`, `nombre`, `tipo`) VALUES (2,1,'Barquisimeto',2);
INSERT INTO `lugar_2`(`id_lugar`, `id_lugar_padre`, `nombre`, `tipo`) VALUES (3,NULL,'Barcelona',2);
INSERT INTO `lugar_2`(`id_lugar`, `id_lugar_padre`, `nombre`, `tipo`) VALUES (4,NULL,'Valencia',2);
INSERT INTO `lugar_2`(`id_lugar`, `id_lugar_padre`, `nombre`, `tipo`) VALUES (5,NULL,'Zulia',1);

#Guarderia
INSERT INTO `guarderia_2`(`id_guarderia`, `id_personal`, `id_lugar`, `rif`, `nombre`, `telefonos`, `costo`) VALUES (1,NULL,2,'V87659123','Sede Barquisimeto',02129767840,100000);
INSERT INTO `guarderia_2`(`id_guarderia`, `id_personal`, `id_lugar`, `rif`, `nombre`, `telefonos`, `costo`) VALUES (2,NULL,3,'V77812432','Sede Barcelona',028129854222,120000);
INSERT INTO `guarderia_2`(`id_guarderia`, `id_personal`, `id_lugar`, `rif`, `nombre`, `telefonos`, `costo`) VALUES (3,NULL,5,'V912452131','Sede Zulia',02627881422,350000);
INSERT INTO `guarderia_2`(`id_guarderia`, `id_personal`, `id_lugar`, `rif`, `nombre`, `telefonos`, `costo`) VALUES (4,NULL,4,'V124551678','Sede Valencia',02419972152,200000);
INSERT INTO `guarderia_2`(`id_guarderia`, `id_personal`, `id_lugar`, `rif`, `nombre`, `telefonos`, `costo`) VALUES (5,NULL,3,'V77812434','Sede Barcelona V2',02819219215,120000);

#Horario
INSERT INTO `horario_2`(`id_horario`, `dia`, `cant_inscritos`) VALUES (1,'Lunes',0);
INSERT INTO `horario_2`(`id_horario`, `dia`, `cant_inscritos`) VALUES (2,'Martes',0);
INSERT INTO `horario_2`(`id_horario`, `dia`, `cant_inscritos`) VALUES (3,'Miercoles',0);
INSERT INTO `horario_2`(`id_horario`, `dia`, `cant_inscritos`) VALUES (4,'Jueves',0);
INSERT INTO `horario_2`(`id_horario`, `dia`, `cant_inscritos`) VALUES (5,'Viernes',0);

#Juego
INSERT INTO `juego_2`(`id_juego`, `codigo`, `descripcion`) VALUES (1,'J001','Jugando con matematicas');
INSERT INTO `juego_2`(`id_juego`, `codigo`, `descripcion`) VALUES (2,'J002','Juegos motrices');
INSERT INTO `juego_2`(`id_juego`, `codigo`, `descripcion`) VALUES (3,'J003','Juegos para aprender la hora');
INSERT INTO `juego_2`(`id_juego`, `codigo`, `descripcion`) VALUES (4,'J004','Aprende los colores');
INSERT INTO `juego_2`(`id_juego`, `codigo`, `descripcion`) VALUES (5,'J005','Diversion con las formas geometricas');

#Medicina
INSERT INTO `medicina_2`(`id_medicina`, `codigo`, `descripcion`) VALUES (1,'MED001','Ibuprofeno');
INSERT INTO `medicina_2`(`id_medicina`, `codigo`, `descripcion`) VALUES (2,'MED002','Brugesic');
INSERT INTO `medicina_2`(`id_medicina`, `codigo`, `descripcion`) VALUES (3,'MED003','Bisolvon');
INSERT INTO `medicina_2`(`id_medicina`, `codigo`, `descripcion`) VALUES (4,'MED004','Tachipirin');
INSERT INTO `medicina_2`(`id_medicina`, `codigo`, `descripcion`) VALUES (5,'MED005','Scott');

INSERT INTO menu_2 (id_menu, id_guarderia, numero, dia, semana, costo) VALUES
(1,1,1,'Lunes',1, 100000),
(2,1,2,'Martes',1, 120000),
(3,1,3,'Miercoles',1, 140000),
(4,1,4,'Jueves',1, 130000),
(5,1,5,'Viernes',1, 110000),
(6,1,1,'Lunes',1, 100000),
(7,1,2,'Martes',1, 115000),
(8,1,3,'Miercoles',1, 135000),
(9,1,4,'Jueves',1, 142000),
(10,1,5,'Viernes',1, 90000),
(1,2,1,'Lunes',1, 100000),
(2,2,2,'Martes',1, 130000),
(3,2,3,'Miercoles',1, 140000),
(4,2,4,'Jueves',1, 130000),
(5,2,5,'Viernes',1, 600000),
(6,2,1,'Lunes',1, 100000),
(7,2,2,'Martes',1, 75000),
(8,2,3,'Miercoles',1, 135000),
(9,2,4,'Jueves',1, 122000),
(10,2,5,'Viernes',1, 98700),
(1,3,1,'Lunes',1, 105000),
(2,3,2,'Martes',1, 130000),
(3,3,3,'Miercoles',1, 120000),
(4,3,4,'Jueves',1, 130000),
(5,3,5,'Viernes',1, 130000),
(6,3,1,'Lunes',1, 100000),
(7,3,2,'Martes',1, 85000),
(8,3,3,'Miercoles',1, 135000),
(9,3,4,'Jueves',1, 10500),
(10,3,5,'Viernes',1, 80000),
(1,4,1,'Lunes',1, 105000),
(2,4,2,'Martes',1, 130000),
(3,4,3,'Miercoles',1, 120000),
(4,4,4,'Jueves',1, 150000),
(5,4,5,'Viernes',1, 100000),
(6,4,1,'Lunes',1, 100000),
(7,4,2,'Martes',1, 95000),
(8,4,3,'Miercoles',1, 135000),
(9,4,4,'Jueves',1, 10500),
(10,4,5,'Viernes',1, 90000),
(1,5,1,'Lunes',1, 115000),
(2,5,2,'Martes',1, 130000),
(3,5,3,'Miercoles',1, 110000),
(4,5,4,'Jueves',1, 130000),
(5,5,5,'Viernes',1, 105000),
(6,5,1,'Lunes',1, 100000),
(7,5,2,'Martes',1, 75000),
(8,5,3,'Miercoles',1, 135000),
(9,5,4,'Jueves',1, 10500),
(10,5,5,'Viernes',1, 60000);

INSERT INTO plato_2 (id_plato, codigo, descripcion) VALUES
(1,PL001, 'Arroz con pollo, jugo de parchita, ensalada'),
(2,PL002, 'Carne molida con tostones, jugo de lechoza, ensalada'),
(3,PL003, 'Bisteck con papas fritas,jugo de piña, ensalada'),
(4,PL004, 'Sopa de pollo, jugo mora, ensalada'),
(5,PL005, 'Nuggets de pollo y papas al horno, jugo de pera, ensalada'),
(6,PL006, 'Sushi, jugo de mango, ensalada'),
(7,PL007, 'Hamburguesa de pescado y papas fritas, jugo de naranja, ensalada'),
(8,PL008, 'Milanesa de carne y arroz, jugo de manzana, ensalada'),
(9,PL009, 'Mondongo, jugo de pera, ensalada'),
(10,PL0010, 'Pernil y vegetales, jugo de lechoza, ensalada');

INSERT INTO padre_2 (id_padre, cedula, nombre, apellido, direccion, email, tel_casa, tel_ofic, tel_celular, profesion, edo_civil, principal, vivenino) VALUES
(1, 1234567891, 'Luis', 'Martinez', 'El paraiso', 'luismartinez@gmail.com',02121234567891,02121234567892,04241234567891, 'abogado', 'soltero', 'S', 'S'),
(2, 1234567892, 'Luifer', 'Martinez', 'El paraiso', 'luifermartinez@gmail.com',02121234567892,02121234567893,04241234567892, 'ingeniero', 'casado', 'S', 'S'),
(3, 1234567893, 'Luisa', 'Morales', 'Montalban', 'luisita@gmail.com',02121234567893,02121234567894,04241234567893, 'fotografo', 'soltero', 'S', 'S'),
(4, 1234567894, 'Maria', 'Perez', 'El valle', 'maria@gmail.com',02121234567894,02121234567895,04241234567894, 'bombero', 'soltero', 'S', 'N'),
(5, 1234567895, 'Jessica', 'Medina', 'La lagunita', 'jessicam@hotmail.com',02121234567895,02121234567896,04241234567895, 'modelo', 'soltero', 'S', 'S'),
(6, 1234567896, 'Iris', 'Ilarraza', 'La lagunita', 'irisfashion@hotmail.com',02121234567896,02121234567897,04241234567896, 'medico', 'soltero', 'S', 'N'),
(7, 1234567897, 'Fatima', 'Goncalves', 'La lagunita', 'fatimag@hotmail.com',02121234567897,02121234567898,04241234567897, 'profesor', 'casado', 'S', 'N'),
(8, 1234567898, 'Ramon', 'Medina', 'La lagunita', 'ramonmedina@hotmail.com',02121234567898,02121234567899,04241234567898, 'abogado', 'soltero', 'S', 'S'),
(9, 1234567899, 'Fernando', 'Gomes', 'La Bandera', 'fernandog@yahoo.com',02121234567899,02121234567896,04241234567899, 'odontologo', 'soltero', 'S', 'N'),
(10, 1234567881, 'Alexander', 'De Azevedo', 'el paraiso', 'jmedina@hotmail.com',02121234567881,02121234567882,04241234567881, 'fotografo', 'soltero', 'S', 'S'),
(11, 1234567882, 'Sergio', 'Medina', 'Catia', 'sagg305@hotmail.com',02121234567882,02121234567882,04241234567882, 'futbolista', 'casado', 'S', 'N'),
(12, 1234567883, 'Greg', 'Gomez', 'La Urbina', 'greggomez@hotmail.com',02121234567883,02121234567884,04241234567883, 'musico', 'soltero', 'S', 'N'),
(13, 1234567884, 'Karliam', 'Medina', 'San Antonio de los Altos', 'karliam@hotmail.com',02121234567885,02121234567886,04241234567884, 'cantante', 'soltero', 'S', 'N'),
(14, 1234567885, 'Christian', 'Neira', 'San Juan', 'christian_neira@hotmail.com',02121234567885,02121234567887,04241234567885, 'pintor', 'soltero', 'S', 'S'),
(15, 1234567886, 'Pedro', 'De Leon', 'Los Simbolos', 'pedrodeleon@hotmail.com',02121234567886,02121234567888,04241234567886, 'diseñador grafico', 'casado', 'S', 'N'),
(16, 1234567887, 'Pedro', 'Alvarez', 'Santa Monica', 'pedroalvarez@hotmail.com',02121234567887,02121234567889,04241234567888, 'diseñador grafico', 'soltero', 'S', 'S');

INSERT INTO padre_2 (id_nino, id_padre, letra, nombre, apellido, fecha_nac, sexo) VALUES
(1, 1, 'A', 'Alexander', 'Martinez', '02/02/2002','M'),
(2, 1, 'B', 'Brayan', 'Martinez', '02/02/2004','M'),
(3, 2, 'C', 'Carlos', 'Martinez', '02/03/2004','M'),
(4, 5, 'F', 'Fatima', 'Medina', '27/11/2003','F'),
(5, 5, 'F', 'Fabiana', 'Medina', '13/12/2003','F'),
(6, 14, 'L', 'Luis', 'Neira', '02/02/2002','M'),
(7, 16, 'P', 'Pedro', 'Alvarez', '02/02/2004','M'),
(8, 3, 'K', 'Karliedis', 'Morales', '02/03/2004','F'),
(9, 12, 'F', 'Fanny', 'Gomez', '27/09/2003','F'),
(10, 11, 'F', 'Alexandra', 'Medina', '13/12/2003','F'),
(11, 6, 'S', 'Saccha', 'Ilarraza', '01/02/2002','F'),
(12, 1, 'B', 'Brayan', 'Martinez', '02/02/2004','M'),
(13, 1, 'C', 'Carlos', 'Martinez', '05/03/2004','M'),
(14, 5, 'F', 'Fatima', 'Medina', '23/06/2004','F'),
(15, 5, 'F', 'Fabiana', 'Medina', '19/10/2005','F'),
(16, 12, 'L', 'Luis', 'Gomez', '02/02/2002','M'),
(17, 10, 'P', 'Pedro', 'De Azevedo', '02/02/2004','M'),
(18, 7, 'K', 'Karliedis', 'Goncalves', '09/03/2004','F'),
(19, 8, 'F', 'Monica', 'Medina', '27/09/2004','F'),
(20, 8, 'F', 'Alexandra', 'Medina', '13/12/2003','F'),
(21, 2, 'S', 'Saccha', 'Martinez', '01/02/2002','F'),
(22, 3, 'B', 'Eduardo', 'Morales', '08/02/2004','M'),
(23, 6, 'C', 'Carlos', 'Ilarraza', '05/03/2003','M'),
(24, 4, 'F', 'Fatima', 'Perez', '21/06/2004','F'),
(25, 4, 'F', 'Fabiana', 'Perez', '19/10/2005','F');

INSERT INTO pediatra_2 (id_pediatra, cedula, nombre, telefono) VALUES
(1, 1234567871, 'Alexander', 04241234567),
(2, 1234567872, 'Brayan', 04241234561),
(3, 1234567873, 'Carlos', 04241234565),
(4, 1234567874, 'Fatima', 04241234569),
(5, 1234567875, 'Fabiana', 04241234563);

INSERT INTO personal_2 (id_personal, id_guarderia, id_guarderia_encarg, cedula, nombre, apellidos, direccion, telefono, nivel_estudio, sueldo) VALUES
(1, 1, 1, 1234567861, 'Alexander', 'De Azevedo', 'el paraiso', 04241234567, 'universitario', 1500000),
(2, 1, 0, 1234567862, 'Brayan', 'Gomes','la vega', 04241234568, 'tsu', 1000000),
(3, 1, 0, 1234567863, 'Carlos', 'Perez', 'la tahona', 04241234569, 'bachillerato', 900000),
(4, 1, 0, 1234567864, 'Fatima', 'Maduro', 'petare', 04241234560, 'tsu', 1100000),
(5, 1, 0, 1234567865, 'Fabiana', 'Puglisi', 'catia', 04241234561, 'bachillerato', 900000),
(6, 2, 1, 1234567866, 'Alexander', 'De Azevedo', 'el paraiso', 04241234567, 'universitario', 1500000),
(7, 2, 0, 1234567867, 'Brayan', 'Gomes','la vega', 04241234577, 'tsu', 1000000),
(8, 2, 0, 1234567868, 'Carlos', 'Perez', 'la tahona', 04241234572, 'bachillerato', 900000),
(9, 2, 0, 1234567869, 'Fatima', 'Maduro', 'petare', 04241234578, 'tsu', 1200000),
(10, 2, 0, 1234567860, 'Fabiana', 'Puglisi', 'catia', 04241234579, 'tsu', 900000),
(11, 3, 0, 1234567851, 'Luis', 'De Azevedo', 'el paraiso', 04241234531, 'bachillerato', 1500000),
(12, 3, 1, 1234567852, 'Brayan', 'Gomes','la vega', 04241234512, 'tsu', 1100000),
(13, 3, 0, 1234567853, 'Carlos', 'Perez', 'la tahona', 04241234535, 'tsu', 900000),
(14, 3, 0, 1234567854, 'Monica', 'Maduro', 'petare', 04241234537, 'tsu', 1100000),
(15, 3, 0, 1234567855, 'Fabiana', 'Puglisi', 'catia', 04241234539, 'universitario', 1800000),
(16, 4, 0, 1234567891, 'Luis', 'Gomez', 'el paraiso', 04241234521, 'bachillerato', 1500000),
(17, 4, 1, 1234567892, 'Monica', 'Gomes','la urbina', 04241234532, 'tsu', 1000000),
(18, 4, 0, 1234567893, 'Carlos', 'Perez', 'la tahona', 04241234535, 'tsu', 900000),
(19, 4, 0, 1234567894, 'Rafael', 'Jimenez', 'petare', 04241234537, 'tsu', 1100000),
(20, 4, 0, 1234567895, 'Fabiana', 'Fernadez', 'la trinidad', 04241234539, 'universitario', 2000000),
(21, 5, 0, 1234567881, 'Luis', 'Gomez', 'el paraiso', 04241234551, 'bachillerato', 1500000),
(22, 5, 1, 1234567882, 'Monica', 'Gomes','la urbina', 04241234552, 'bachillerato', 1200000),
(23, 5, 0, 1234567883, 'Carlos', 'Perez', 'la tahona', 04241234555, 'tsu', 900000),
(24, 5, 0, 1234567884, 'Rafael', 'Jimenez', 'petare', 04241234557, 'tsu', 1100000),
(25, 5, 0, 1234567885, 'Fabiana', 'Fernadez', 'la trinidad', 04241234559, 'universitario', 2100000);

INSERT INTO sintoma_2 (id_sintoma, codigo, descripcion) VALUES
(1, SI001, 'Dolor de cabeza'),
(2, SI002, 'Diarrea'),
(3, SI003, 'irritabilidad'),
(4, SI004, 'Fatiga'),
(5, SI001, 'Apatía');

INSERT INTO inscripcion_2 (id_inscripcion, id_nino, id_guarderia, ano, consecutivo, cont_horas_extras, hora_desde, hora_hasta, fecha_insc) VALUES
(1, 1, 1, 2018, 1, 1, 7, 9, 18/02/2018),
(2, 2, 1, 2018, 1, 0, 9, 11, 17/02/2018),
(3, 3, 1, 2018, 1, 0, 11, 13, 16/02/2018),
(4, 4, 1, 2018, 1, 0, 13, 15, 19/01/2018),
(5, 5, 1, 2018, 1, 0, 15, 17, 13/02/2018),
(6, 6, 2, 2018, 1, 1, 7, 9, 27/02/2018),
(7, 7, 2, 2018, 1, 1, 9, 11, 26/02/2018),
(8, 8, 2, 2018, 1, 1, 11, 13, 25/02/2018),
(9, 9, 2, 2018, 1, 1, 13, 15, 24/01/2018),
(10, 10, 2, 2018, 1, 1, 15, 17, 23/02/2018),
(11, 11, 3, 2017, 1, 0, 7, 9, 08/12/2017),
(12, 12, 3, 2017, 1, 0, 9, 11, 07/12/2017),
(13, 13, 3, 2017, 1, 0, 11, 13, 06/12/2017),
(14, 14, 3, 2017, 1, 0, 13, 15, 05/01/2017),
(15, 15, 3, 2017, 1, 0, 15, 17, 04/12/2017),
(16, 16, 4, 2018, 1, 0, 11, 13, 13/01/2018),
(17, 17, 4, 2018, 1, 1, 9, 11, 12/01/2018),
(18, 18, 4, 2018, 1, 1, 11, 13, 15/01/2018),
(19, 19, 4, 2018, 1, 1, 13, 15, 11/01/2018),
(20, 20, 4, 2018, 1, 1, 15, 17, 10/02/2018),
(21, 21, 5, 2017, 1, 1, 7, 9, 09/12/2017),
(22, 22, 5, 2017, 1, 1, 10, 12, 03/12/2017),
(23, 23, 5, 2017, 1, 0, 11, 13, 05/12/2017),
(24, 24, 5, 2017, 1, 0, 13, 15, 01/01/2017),
(25, 25, 5, 2017, 1, 0, 16, 18, 02/12/2017);

INSERT INTO mensualidad_2 (id_mensualidad, id_inscripcion, consecutivo, monto) VALUES
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

INSERT INTO pago_insc_mens_2 (id_pim, id_inscripcion, id_mensualidad, numero, fechapago, concepto, tipo_pago, monto, numero_cheque, numero_tarjeta, monto_debito) VALUES
(1, 1, 1, 1, 18/02/2018, 1, 'transferencia', 100000,0, 123, 90000),
(2, 2, 2, 1, 17/02/2018, 1, 'transferencia', 100000,0, 123, 90000),
(3, 3, 3, 1, 16/02/2018, 1, 'transferencia', 100000,0, 123, 90000),
(4, 4, 4, 1, 15/02/2018, 1, 'transferencia', 100000,0, 123, 90000),
(5, 5, 5, 1, 14/02/2018, 1, 'transferencia', 100000,0, 123, 90000),
(6, 6, 6, 1, 13/02/2018, 1, 'tarjeta de credito', 100000,0, 123, 90000),
(7, 7, 7, 1, 12/02/2018, 1, 'transferencia', 100000,123, 0, 90000),
(8, 8, 8, 1, 11/02/2018, 1, 'transferencia', 100000,123, 0, 90000),
(9, 9, 9, 1, 10/02/2018, 1, 'cheque', 100000,123, 123, 90000),
(10, 10, 10, 1, 09/02/2018, 1, 'transferencia', 100000,0, 123, 90000);