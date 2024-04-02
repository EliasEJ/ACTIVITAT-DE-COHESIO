USE projecte2;


/*INSERIR GRUPS*/
INSERT INTO grup (grup_id, nom, foto, puntuacio, id_professor_encarregat)
VALUES 
(1, "Grup-1", "default.jpg", 0, 7),
(2, "Grup-2", "default.jpg", 0, 2),
(3, "Grup-3", "default.jpg", 0, 1),
(4, "Grup-4", "default.jpg", 0, 3),
(5, "Grup-5", "default.jpg", 0, 4),
(6, "Grup-6", "default.jpg", 0, 5),
(7, "Grup-7", "default.jpg", 0, 6),
(8, "Grup-8", "default.jpg", 0, 9),
(9, "Grup-9", "default.jpg", 0, 10),
(10, "Grup-10", "default.jpg", 0, 10);



/*INSERIR POSICIONS*/
INSERT INTO posicion (posicion_id, nom, descripcio)
VALUES 
(1, "posicio 1", "Zona principal de l'entrada de l'institut. Enfront dels cicles."),
(2, "posicio 2", "Aula 2 dels cicles."),
(3, "posicio 3", "Zona de la pista on darrere dels cicles. On les porteries de futbol."),
(4, "posicio 4", "Zona de la pista enfront de les taules de ping-pong. On les canastes de bàsquet."),
(5, "posicio 5", "Cistella de bàsquet situat a la cantonada inferior esquerra."),
(6, "posicio 6", "Pista de bàsquet situat al costat de la pista de futbol."),
(7, "posicio 7", "Aula 3 dels cicles."),
(8,"posicio 8", "Enfront de la cafeteria. On les taules de ping-pong.");


/*INSERIR MATERIAL*/
INSERT INTO material (material_id, nom, comprar)
VALUES (1, "pilota de goma", 1),
(2, "Pales de Ping Pong", 0),
(3, "Pilota de futbol", 0),
(4, "Pilota de bàsquet", 0);


/*INSERIR ALUMNES*/
INSERT INTO alumne(alumne_id, nom, cognom, correu, curs, any, classe, asistencia, asistencia_confirmada, grup_id, tutor)
VALUES
(1, "Adrian", "Juarez", "a.juarez@sapalomera.cat", 'DAW', '2n', 'A', 1, 0,1, 7),
(2, "Alejandro", "Vazquez", "a.vazquez2@sapalomera.cat", 'DAW', '2n', 'A', 1,0, 1, 7),
(3, "El Yass", "El Jerari", "e.jerari@sapalomera.cat",  'ASIX', '2n', 'A', 1,0, 2, 2),
(4, "Marc", "Gomez", "m.gomez@sapalomera.cat",  'ASIX', '2n', 'A', 0,0, 2, 2),
(5, "Maria", "Sola", "m.sola@sapalomera.cat",  'SMX', '1r', 'A', 1,0, 3, 1),
(6, "Laura", "Perez", "l.perez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0,3, 1),
(7, "Santiago", "Peral", "s.peral@sapalomera.cat",  'SMX', '1r', 'B', 0, 0,4, 3),
(8, "Mayank", "Alkalk", "m.alkalk@sapalomera.cat",  'SMX', '1r', 'B', 1, 0,4, 3),
(9, "Alberto", "Cañon", "a.cañon@sapalomera.cat",  'SMX', '1r', 'B', 1,0, 5, 4),
(10, "Sergi", "Agudo", "s.agudo@sapalomera.cat",  'SMX', '1r', 'B', 0,0, 5, 4),
(11, "Angel", "Chulo", "a.chulo@sapalomera.cat",  'SMX', '1r', 'C', 0,0, 6, 5),
(12, "Victor", "Peralez", "v.peralez@sapalomera.cat",  'SMX', '1r', 'C', 0, 0,6, 5),
(13, "Marc", "Peral", "m.peral@sapalomera.cat",  'SMX', '2n', 'A', 1,0, 7, 6),
(14, "Benit", "Martinez", "b.martinez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0,7, 6),
(15, "Lucas", "Pampillon", "l.pampillon@sapalomera.cat",  'ASIX', '1r', 'A', 1, 0,8,9),
(16, "Eric", "Perico", "e.perico@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0,8, 9),
(17, "Elena", "Garcia", "e.garcia@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(18, "Carlos", "Lopez", "c.lopez@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(19, "Fatima", "Rodriguez", "f.rodriguez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(20, "Javier", "Martinez", "j.martinez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(21, "Andrea", "Gomez", "a.gomez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(22, "Pablo", "Sanchez", "p.sanchez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(23, "Carmen", "Martin", "c.martin@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(24, "Manuel", "Diaz", "m.diaz@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(25, "Eva", "Hernandez", "e.hernandez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(26, "Juan", "Gonzalez", "j.gonzalez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(27, "Luisa", "Jimenez", "l.jimenez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(28, "Antonio", "Perez", "a.perez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(29, "Isabel", "Fernandez", "i.fernandez@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(30, "David", "Ruiz", "d.ruiz@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(31, "Ana", "Sanz", "a.sanz@sapalomera.cat",  'DAW', '2n', 'A', 1, 0, 1, 7),
(32, "Pedro", "Gomez", "p.gomez@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(33, "Sara", "Navarro", "s.navarro@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(34, "Marta", "Gutierrez", "m.gutierrez@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(35, "Diego", "Alvarez", "d.alvarez@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(36, "Raul", "Romero", "r.romero@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(37, "Pablo", "Lopez", "p.lopez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(38, "Sofia", "Sanchez", "s.sanchez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(39, "Martina", "Martinez", "m.martinez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(40, "Hugo", "Gomez", "h.gomez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(41, "Lucia", "Hernandez", "l.hernandez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(42, "Daniel", "Gonzalez", "d.gonzalez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(43, "Julia", "Jimenez", "j.jimenez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(44, "Alvaro", "Perez", "a.perez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(45, "Nerea", "Fernandez", "n.fernandez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(46, "Iker", "Sanz", "i.sanz@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(47, "Ines", "Alvarez", "i.alvarez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(48, "Mateo", "Romero", "m.romero@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(49, "Ainhoa", "Lopez", "a.lopez@sapalomera.cat",  'ASIX', '2n', 'A', 1, 0, 2, 2),
(50, "Pau", "Sanchez", "p.sanchez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(51, "Abril", "Martinez", "a.martinez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(52, "Jan", "Gomez", "j.gomez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(53, "Lola", "Hernandez", "l.hernandez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(54, "Leo", "Gonzalez", "l.gonzalez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(55, "Emma", "Jimenez", "e.jimenez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(56, "Marcos", "Perez", "m.perez@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(57, "Aitana", "Gomez", "a.gomez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(58, "David", "Sanchez", "d.sanchez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(59, "Nora", "Martinez", "n.martinez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(60, "Izan", "Garcia", "i.garcia@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(61, "Julia", "Perez", "j.perez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(62, "Adrian", "Fernandez", "a.fernandez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(63, "Carla", "Gutierrez", "c.gutierrez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(64, "Hugo", "Ruiz", "h.ruiz@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(65, "Martina", "Hernandez", "m.hernandez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(66, "Sara", "Diaz", "s.diaz@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(67, "Diego", "Alvarez", "d.alvarez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(68, "Elena", "Romero", "e.romero@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(69, "Lucia", "Gomez", "l.gomez@sapalomera.cat",  'SMX', '1r', 'A', 1, 0, 3, 1),
(70, "Javier", "Sanchez", "j.sanchez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(71, "Laura", "Martinez", "l.martinez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(72, "Marcos", "Perez", "m.perez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(73, "Carolina", "Hernandez", "c.hernandez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(74, "Alejandro", "Garcia", "a.garcia@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(75, "Celia", "Ruiz", "c.ruiz@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(76, "Adriana", "Lopez", "a.lopez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(77, "Alicia", "Martinez", "a.martinez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(78, "Diego", "Gomez", "d.gomez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(79, "Elena", "Fernandez", "e.fernandez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(80, "Hugo", "Ruiz", "h.ruiz@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(81, "Julia", "Sanchez", "j.sanchez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(82, "Marcos", "Lopez", "m.lopez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(83, "Adrian", "Garcia", "a.garcia@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(84, "Carla", "Martinez", "c.martinez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(85, "David", "Perez", "d.perez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(86, "Elena", "Romero", "e.romero@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(87, "Fernando", "Gutierrez", "f.gutierrez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(88, "Iker", "Hernandez", "i.hernandez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(89, "Julia", "Gomez", "j.gomez@sapalomera.cat",  'SMX', '1r', 'B', 1, 0, 4, 3),
(90, "Marc", "Sanchez", "m.sanchez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(91, "Sofia", "Perez", "s.perez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(92, "Adrian", "Gutierrez", "a.gutierrez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(93, "Carlos", "Martinez", "c.martinez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(94, "Elena", "Perez", "e.perez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(95, "Fernando", "Gomez", "f.gomez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(96, "Iker", "Sanchez", "i.sanchez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(97, "Adrian", "Martinez", "a.martinez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(98, "Carlos", "Gomez", "c.gomez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(99, "Elena", "Sanchez", "e.sanchez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(100, "Hugo", "Perez", "h.perez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(101, "Julia", "Gutierrez", "j.gutierrez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(102, "Marcos", "Romero", "m.romero@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(103, "Adrian", "Gomez", "a.gomez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(104, "Carla", "Martinez", "c.martinez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(105, "David", "Perez", "d.perez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(106, "Elena", "Romero", "e.romero@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(107, "Fernando", "Gutierrez", "f.gutierrez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(108, "Iker", "Hernandez", "i.hernandez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(109, "Julia", "Gomez", "j.gomez@sapalomera.cat",  'SMX', '1r', 'C', 1, 0, 5, 4),
(110, "Marc", "Sanchez", "m.sanchez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(111, "Sofia", "Perez", "s.perez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(112, "Adrian", "Gutierrez", "a.gutierrez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(113, "Carlos", "Martinez", "c.martinez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(114, "Elena", "Perez", "e.perez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(115, "Fernando", "Gomez", "f.gomez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(116, "Iker", "Sanchez", "i.sanchez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(117, "Ainhoa", "Gomez", "a.gomez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(118, "David", "Sanchez", "d.sanchez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(119, "Nora", "Martinez", "n.martinez@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(120, "Izan", "Garcia", "i.garcia@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(121, "Julia", "Perez", "j.perez@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(122, "Adrian", "Fernandez", "a.fernandez@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(123, "Carla", "Gutierrez", "c.gutierrez@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(124, "Hugo", "Ruiz", "h.ruiz@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(125, "Martina", "Hernandez", "m.hernandez@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(126, "Sara", "Diaz", "s.diaz@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(127, "Diego", "Alvarez", "d.alvarez@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(128, "Elena", "Romero", "e.romero@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(129, "Lucia", "Gomez", "l.gomez@sapalomera.cat",  'SMX', '2n', 'A', 1, 0, 7, 6),
(130, "Javier", "Sanchez", "j.sanchez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(131, "Laura", "Martinez", "l.martinez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(132, "Marcos", "Perez", "m.perez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(133, "Carolina", "Hernandez", "c.hernandez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(134, "Alejandro", "Garcia", "a.garcia@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(135, "Celia", "Ruiz", "c.ruiz@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(136, "Adriana", "Lopez", "a.lopez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(137, "Alberto", "Martinez", "a.martinez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(138, "Beatriz", "Gomez", "b.gomez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(139, "Cristian", "Sanchez", "c.sanchez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(140, "David", "Perez", "d.perez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(141, "Elena", "Romero", "e.romero@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(142, "Fernando", "Gutierrez", "f.gutierrez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(143, "Gonzalo", "Hernandez", "g.hernandez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(144, "Hugo", "Gomez", "h.gomez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(145, "Isabel", "Martinez", "i.martinez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(146, "Julia", "Sanchez", "j.sanchez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(147, "Marcos", "Lopez", "m.lopez@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(148, "Nuria", "Garcia", "n.garcia@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(149, "Oscar", "Romero", "o.romero@sapalomera.cat",  'SMX', '2n', 'B', 1, 0, 8, 9),
(150, "Patricia", "Hernandez", "p.hernandez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(151, "Adrian", "Gutierrez", "a.gutierrez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(152, "Carlos", "Martinez", "c.martinez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(153, "Elena", "Perez", "e.perez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(154, "Fernando", "Gomez", "f.gomez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(155, "Iker", "Sanchez", "i.sanchez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(156, "Julia", "Garcia", "j.garcia@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(157, "Adrian", "Martinez", "a.martinez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(158, "Carlos", "Gomez", "c.gomez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(159, "Elena", "Sanchez", "e.sanchez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(160, "Hugo", "Perez", "h.perez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(161, "Julia", "Gutierrez", "j.gutierrez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(162, "Marcos", "Romero", "m.romero@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(163, "Adrian", "Gomez", "a.gomez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(164, "Carla", "Martinez", "c.martinez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(165, "David", "Perez", "d.perez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(166, "Elena", "Romero", "e.romero@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(167, "Fernando", "Gutierrez", "f.gutierrez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(168, "Iker", "Hernandez", "i.hernandez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(169, "Julia", "Gomez", "j.gomez@sapalomera.cat",  'SMX', '2n', 'C', 1, 0, 9, 10),
(170, "Marc", "Sanchez", "m.sanchez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(171, "Sofia", "Perez", "s.perez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(172, "Adrian", "Gutierrez", "a.gutierrez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(173, "Carlos", "Martinez", "c.martinez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(174, "Elena", "Perez", "e.perez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(175, "Fernando", "Gomez", "f.gomez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(176, "Iker", "Sanchez", "i.sanchez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(177, "Laura", "Gomez", "l.gomez@sapalomera.cat", 'SMX', '1r', 'B', 1, 0, 4, 3),
(178, "Marcos", "Gomez", "m.gomez@sapalomera.cat", 'SMX', '1r', 'C', 1, 0, 5, 4),
(179, "Sara", "Perez", "s.perez@sapalomera.cat", 'SMX', '2n', 'A', 1, 0, 7, 6),
(180, "Pablo", "Martinez", "p.martinez@sapalomera.cat", 'SMX', '2n', 'B', 1, 0, 8, 9),
(181, "Ana", "Sanchez", "a.sanchez@sapalomera.cat", 'SMX', '2n', 'C', 1, 0, 9, 10),
(182, "Sandra", "Lopez", "s.lopez@sapalomera.cat", 'DAW', '2n', 'A', 1, 0, 1, 7),
(183, "Mario", "Garcia", "m.garcia@sapalomera.cat", 'ASIX', '2n', 'A', 1, 0, 2, 2),
(184, "Laura", "Sanchez", "l.sanchez@sapalomera.cat", 'SMX', '1r', 'A', 1, 0, 3, 1),
(185, "Marcos", "Gomez", "m.gomez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(186, "Laura", "Sanchez", "l.sanchez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(187, "Natalia", "Lopez", "n.lopez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(188, "Ivan", "Gomez", "i.gomez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(189, "Alba", "Garcia", "a.garcia@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(190, "Sergio", "Martin", "s.martin@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(191, "Cristina", "Perez", "c.perez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(192, "Oscar", "Sanchez", "o.sanchez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(193, "Ainhoa", "Martinez", "a.martinez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(194, "David", "Lopez", "d.lopez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(195, "Elena", "Gomez", "e.gomez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(196, "Julia", "Sanchez", "j.sanchez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(197, "Mario", "Martinez", "m.martinez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(198, "Lucia", "Lopez", "l.lopez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(199, "Carlos", "Garcia", "c.garcia@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(200, "Laura", "Martin", "l.martin@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(201, "Sara", "Perez", "s.perez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(202, "Javier", "Sanchez", "j.sanchez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(203, "Nuria", "Martinez", "n.martinez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(204, "Adrian", "Gomez", "a.gomez@sapalomera.cat", 'DAW', '1r', 'A', 1, 0, 1, 7),
(205, "Sergio", "Martinez", "s.martinez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(206, "Elena", "Sanchez", "e.sanchez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(207, "Adriana", "Gomez", "a.gomez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(208, "Carlos", "Lopez", "c.lopez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(209, "David", "Perez", "d.perez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(210, "Elena", "Martinez", "e.martinez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(211, "Fernando", "Sanchez", "f.sanchez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(212, "Gonzalo", "Gomez", "g.gomez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(213, "Hugo", "Martinez", "h.martinez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9),
(214, "Isabel", "Sanchez", "i.sanchez@sapalomera.cat", 'ASIX', '1r', 'A', 1, 0, 8, 9);


/* INSERIR ACTIVITATS*/
INSERT INTO activitat(actividad_id, nom, descripcio, posicion_id, professor_id,grup1,grup2, material_id)
VALUES (1, /** Activitat ID*/ 
"Matar", /**Nom activitat*/
"Cada equip es dividirà en dues bandes del camp amb una línia de separació en el mig del camp. L'objectiu del joc és aguantar el màxim possible 'matant' a tots els jugadors de l'altre equip amb una pilota. Si un jugador rep un cop amb la pilota disparada per un jugador de l'altre equip, aquest mor.", /**Descripcio Activitat*/
1, /**Posició ID*/
1, /*Professor ID */
1, /*Grup1 ID*/
8, /*Grup2 ID*/
1 /*Material ID*/),

/*Activitat 2*/
(2, /** Activitat ID*/ 
"Ping-pong", /**Nom activitat*/
"Cada membre de cada equip haurà de jugar al Ping Pong contra l'altre membre de l'altre equip. Qui guanyi, contarà un punt. Els dos equips hauran de jugar a ping-pong fins que el temps acabi. Qui tingui majors punts guanya.",/**Descripcio Activitat*/
2, /**Posició ID*/
2, /*Professor ID */
2, /*Grup1 ID*/
7, /*Grup2 ID*/
2 /*Material ID*/),

/*Activitat 3*/
(3, /** Activitat ID*/ 
"Futbol", /**Nom activitat*/
"Els dos equips hauran de jugar a futbol fins que s'acabi el temps, qui hagi marcat més gols guanya.", /**Descripcio Activitat*/
3, /**Posició ID*/
3, /*Professor ID */
3, /*Grup1 ID*/
6, /*Grup2 ID*/
3 /*Material ID*/),

/*Activitat 4*/
(4, /** Activitat ID*/ 
"Basquet", /**Nom activitat*/
"Els dos equips hauran de jugar a bàsquet fins que s'acabi el temps, qui hagi marcat més gols guanya.", /**Descripcio Activitat*/
4, /**Posició ID*/
4, /*Professor ID */
4, /*Grup1 ID*/
5, /*Grup2 ID*/
4 /*Material ID*/);


/*INSERIR ADMIN*/
INSERT INTO admin (admin_id, nom, cognom, user, correu, actividad_id, grup_id, tutor)
VALUES 
(1, "Pere", "Sànchez", "psanchez","psanchez@sapalomera.cat", 0, 8, 1),
(2,"Martin","Jaime","mjaime", "m.jaime@sapalomera.cat",1,3,1),
(3,"Robert","Ventura","rventura","rventura@sapalomera.cat",3,4,1),
(4,"Pere","Pi","ppi","ppi@sapalomera.cat",4,5,1),
(5,"Josep","Catà","jcata", "jcata@sapalomera.cat",NULL,6,1),
(6,"Ricard","Pla","rpla","rpla@sapalomera.cat",NULL,7,1),
(7,"Xavi","Martin","xmartin","xmartin@sapalomera.cat",NULL,1,1),
(8,"David","Bancells","dbancells","dbancells@sapalomera.cat",2,2,1),
(9,"Ainhoa","Zaldua","azaldua", "azaldua@sapalomera.cat",NULL,8,1),
(10,"Alex","Vazquez","avazquez", "a.vazquez2@sapalomera.cat",NULL,10,1);

/*INSERIR PROFESSORS*/
INSERT INTO professor (professor_id, nom, cognom, user, correu, actividad_id,grup_id,tutor )
VALUES
(1,"Martin","Jaime","mjaime", "m.jaime@sapalomera.cat",1,3,1),
(2,"David","Bancells","dbancells","dbancells@sapalomera.cat",2,2,1),
(3,"Robert","Ventura","rventura","rventura@sapalomera.cat",3,4,1),
(4,"Pere","Pi","ppi","ppi@sapalomera.cat",4,5,1),
(5,"Josep","Catà","jcata", "jcata@sapalomera.cat",NULL,6,1),
(6,"Ricard","Pla","rpla","rpla@sapalomera.cat",NULL,7,1),
(7,"Xavi","Martin","xmartin","xmartin@sapalomera.cat",NULL,1,1),
(8,"Pere","Sànchez","psanchez","psanchez@sapalomera.cat",NULL,NULL,NULL),
(9,"Ainhoa","Zaldua","azaldua", "azaldua@sapalomera.cat",NULL,8,1),
(10,"Alex","Vazquez","avazquez", "a.vazquez2@sapalomera.cat",NULL,10,1);


ALTER TABLE `activitat`
ADD CONSTRAINT `activitat_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`professor_id`) ;

ALTER TABLE `activitat`
ADD CONSTRAINT `activitat_ibfk_4` FOREIGN KEY (`grup1`) REFERENCES `grup` (`grup_id`) ;

ALTER TABLE `activitat`
ADD CONSTRAINT `activitat_ibfk_5` FOREIGN KEY (`grup2`) REFERENCES `grup` (`grup_id`) ;

-- INSERT INTO enfrentaments(enfrentament_id, actividad_id, nom ,resultat)
-- VALUES
-- (1, 1, "G1vG8", ""),
-- (2, 2, "G1vG7", ""),
-- (3, 3, "G1vG6", ""),
-- (4, 4, "G1vG5", ""),
-- (5, 1, "G1vG4", ""),
-- (6, 2, "G1vG3", ""),
-- (7, 3, "G1vG2", ""),
-- (8, 4, "G2vG3", ""),
-- (9, 1, "G2vG4", ""),
-- (10, 2, "G2vG5", ""),
-- (11, 3, "G2vG6", ""),
-- (12, 4, "G2vG7", ""),
-- (13, 1, "G2vG8", ""),
-- (14, 2, "G3vG4", ""),
-- (15, 3, "G3vG5", ""),
-- (16, 4, "G3vG6", ""),
-- (17, 1, "G3vG7", ""),
-- (18, 2, "G3vG8", ""),
-- (19, 3, "G4vG5", ""),
-- (20, 4, "G4vG6", ""),
-- (21, 1, "G4vG7", ""),
-- (22, 2, "G4vG8", ""),
-- (23, 3, "G5vG6", ""),
-- (24, 4, "G5vG7", ""),
-- (25, 1, "G5vG8", ""),
-- (26, 2, "G6vG7", ""),
-- (27, 3, "G6vG8", ""),
-- (28, 4, "G7vG8", "");



