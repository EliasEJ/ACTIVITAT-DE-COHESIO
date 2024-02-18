USE projecte2;


/*INSERIR GRUPS*/
INSERT INTO grup (grup_id, nom, foto, puntuacio,id_professor_encarregat)
VALUES 
(1, "Grup-1", "", 0, 7),
(2, "Grup-2", "", 0,2),
(3, "Grup-3", "", 0,1),
(4, "Grup-4", "", 0,3),
(5, "Grup-5", "", 0,4),
(6, "Grup-6", "", 0,5),
(7, "Grup-7", "", 0,6),
(8, "Grup-8", "", 0,1);


/*INSERIR POSICIONS*/
INSERT INTO posicion (posicion_id, nom, descripcio)
VALUES 
(1, "patio", "Zona principal de l'entrada de l'institut. Enfront dels cicles."),
(2, "taules ping pong", "Enfront de la cafeteria. On les taules de ping-pong."),
(3, "pista1", "Zona de la pista on darrere dels cicles. On les porteries de futbol."),
(4, "pista2", "Zona de la pista enfront de les taules de ping-pong. On les canastes de bàsquet.");


/*INSERIR MATERIAL*/
INSERT INTO material (material_id, nom, comprar)
VALUES (1, "pilota de goma", 1),
(2, "Pales de Ping Pong", 0),
(3, "Pilota de futbol", 0),
(4, "Pilota de bàsquet", 0);


/*INSERIR ALUMNES*/
INSERT INTO alumne(alumne_id, nom, cognom, correu, curs, any, classe, asistencia, grup_id, tutor)
VALUES
(1, "Martin", "Jaime", "m.jaime@sapalomera.cat", 'DAW', '2n', 'A', 1, 1, 7),
(2, "Alejandro", "Vazquez", "a.vazquez2@sapalomera.cat", 'DAW', '2n', 'A', 1, 1, 7),
(3, "El Yass", "El Jerari", "e.jerari@sapalomera.cat",  'ASIX', '2n', 'A', 1, 2, 2),
(4, "Marc", "Gomez", "m.gomez@sapalomera.cat",  'ASIX', '2n', 'A', 0, 2, 2),
(5, "Maria", "Sola", "m.sola@sapalomera.cat",  'SMX', '1r', 'A', 1, 3, 1),
(6, "Laura", "Perez", "l.perez@sapalomera.cat",  'SMX', '1r', 'A', 1, 3, 1),
(7, "Santiago", "Peral", "s.peral@sapalomera.cat",  'SMX', '1r', 'B', 0, 4, 3),
(8, "Mayank", "Alkalk", "m.alkalk@sapalomera.cat",  'SMX', '1r', 'B', 1, 4, 3),
(9, "Alberto", "Cañon", "a.cañon@sapalomera.cat",  'SMX', '1r', 'B', 1, 5, 4),
(10, "Sergi", "Agudo", "s.agudo@sapalomera.cat",  'SMX', '1r', 'B', 0, 5, 4),
(11, "Angel", "Chulo", "a.chulo@sapalomera.cat",  'SMX', '1r', 'C', 0, 6, 5),
(12, "Victor", "Peralez", "v.peralez@sapalomera.cat",  'SMX', '1r', 'C', 0, 6, 5),
(13, "Marc", "Peral", "m.peral@sapalomera.cat",  'SMX', '2n', 'A', 1, 7, 6),
(14, "Benit", "Martinez", "b.martinez@sapalomera.cat", 'SMX', '2n', 'A', 1, 7, 6),
(15, "Lucas", "Pampillon", "l.pampillon@sapalomera.cat",  'ASIX', '1r', 'A', 1, 8,8),
(16, "Eric", "Perico", "e.perico@sapalomera.cat", 'ASIX', '1r', 'A', 1, 8, 8);


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
1 /*Material ID*/),

/*Activitat 4*/
(4, /** Activitat ID*/ 
"Basquet", /**Nom activitat*/
"Els dos equips hauran de jugar a bàsquet fins que s'acabi el temps, qui hagi marcat més gols guanya.", /**Descripcio Activitat*/
4, /**Posició ID*/
4, /*Professor ID */
4, /*Grup1 ID*/
5, /*Grup2 ID*/
1 /*Material ID*/);


/*INSERIR ADMIN*/
INSERT INTO admin (admin_id, nom, cognom, user, correu, actividad_id, grup_id, tutor)
VALUES 
(1, "Pere", "Sànchez", "psanchez","psanchez@sapalomera.cat", 0, 8, 1);

/*INSERIR PROFESSORS*/
INSERT INTO professor (professor_id, nom, cognom, user, correu, actividad_id,grup_id,tutor )
VALUES
(1,"Ainhoa","Zaldua","azaldua", "azaldua@sapalomera.cat",1,3,1),
(2,"David","Bancells","dbancells","dbancells@sapalomera.cat",2,2,1),
(3,"Robert","Ventura","rventura","rventura@sapalomera.cat",3,4,1),
(4,"Pere","Pi","ppi","ppi@sapalomera.cat",4,5,1),
(5,"Josep","Catà","jcata", "jcata@sapalomera.cat",NULL,6,1),
(6,"Ricard","Pla","rpla","rpla@sapalomera.cat",NULL,7,1),
(7,"Xavi","Martin","xmartin","xmartin@sapalomera.cat",NULL,1,1),
(8,"Pere","Sànchez","psanchez","psanchez@sapalomera.cat",NULL,NULL,NULL);


ALTER TABLE `activitat`
ADD CONSTRAINT `activitat_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`professor_id`) ON UPDATE CASCADE ON DELETE CASCADE;



INSERT INTO enfrentaments(enfrentament_id, actividad_id, nom ,resultat)
VALUES
(1, 1, "G1vG8", ""),
(2, 2, "G1vG7", ""),
(3, 3, "G1vG6", ""),
(4, 4, "G1vG5", ""),
(5, 1, "G1vG4", ""),
(6, 2, "G1vG3", ""),
(7, 3, "G1vG2", ""),
(8, 4, "G2vG3", ""),
(9, 1, "G2vG4", ""),
(10, 2, "G2vG5", ""),
(11, 3, "G2vG6", ""),
(12, 4, "G2vG7", ""),
(13, 1, "G2vG8", ""),
(14, 2, "G3vG4", ""),
(15, 3, "G3vG5", ""),
(16, 4, "G3vG6", ""),
(17, 1, "G3vG7", ""),
(18, 2, "G3vG8", ""),
(19, 3, "G4vG5", ""),
(20, 4, "G4vG6", ""),
(21, 1, "G4vG7", ""),
(22, 2, "G4vG8", ""),
(23, 3, "G5vG6", ""),
(24, 4, "G5vG7", ""),
(25, 1, "G5vG8", ""),
(26, 2, "G6vG7", ""),
(27, 3, "G6vG8", ""),
(28, 4, "G7vG8", "");



