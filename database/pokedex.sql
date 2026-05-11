
CREATE DATABASE pokedex;

USE pokedex;

CREATE TABLE usuarios (

                          id INT AUTO_INCREMENT PRIMARY KEY,

                          username VARCHAR(50) NOT NULL UNIQUE,

                          password VARCHAR(255) NOT NULL,

                          is_admin BOOLEAN DEFAULT FALSE

);


CREATE TABLE tipos (

                       id INT AUTO_INCREMENT PRIMARY KEY,

                       nombre VARCHAR(50) NOT NULL UNIQUE,

                       imagen VARCHAR(255) NOT NULL

);

CREATE TABLE pokemons (

                          id INT AUTO_INCREMENT PRIMARY KEY,

                          numero_pokedex INT NOT NULL UNIQUE,

                          nombre VARCHAR(100) NOT NULL,

                          tipo1_id INT NOT NULL,

                          tipo2_id INT NULL,

                          descripcion TEXT,

                          imagen VARCHAR(255) NOT NULL,

                          FOREIGN KEY (tipo1_id)
                              REFERENCES tipos(id),

                          FOREIGN KEY (tipo2_id)
                              REFERENCES tipos(id)

);

INSERT INTO usuarios
(username, password, is_admin)

VALUES
    ('admin1', '1234', TRUE),
    ('admin2', '1234', TRUE),
    ('admin3', '1234', TRUE);

INSERT INTO tipos (id, nombre, imagen) VALUES
(1, 'Steel', 'steel.svg'),
(2, 'Water', 'water.svg'),
(3, 'Bug', 'bug.svg'),
(4, 'Dragon', 'dragon.svg'),
(5, 'Electric', 'electric.svg'),
(6, 'Ghost', 'ghost.svg'),
(7, 'Fire', 'fire.svg'),
(8, 'Fairy', 'fairy.svg'),
(9, 'Ice', 'ice.svg'),
(10, 'Fighting', 'fighting.svg'),
(11, 'Normal', 'normal.svg'),
(12, 'Grass', 'grass.svg'),
(13, 'Psychic', 'psychic.svg'),
(14, 'Rock', 'rock.svg'),
(15, 'Dark', 'dark.svg'),
(16, 'Ground', 'ground.svg'),
(17, 'Poison', 'poison.svg'),
(18, 'Flying', 'flying.svg');

INSERT INTO pokemons (numero_pokedex, nombre, tipo1_id, tipo2_id, descripcion, imagen) VALUES
                                                                                           (1, 'Bulbasaur', 12, 17, 'Una rara semilla fue plantada en su espalda al nacer. La planta brota y crece con este Pokémon.', '001.png'),
                                                                                           (2, 'Ivysaur', 12, 17, 'Cuando el bulbo de su espalda crece, parece perder la capacidad de ponerse de pie sobre sus patas traseras.', '002.png'),
                                                                                           (3, 'Venusaur', 12, 17, 'La planta florece cuando absorbe energía solar. Ésta se mueve para buscar la luz del sol.', '003.png'),
                                                                                           (4, 'Charmander', 7, NULL, 'Prefiere las cosas calientes. Dicen que cuando llueve sale vapor de la punta de su cola.', '004.png'),
                                                                                           (5, 'Charmeleon', 7, NULL, 'Cuando columpia su ardiente cola, eleva la temperatura a niveles muy altos.', '005.png'),
                                                                                           (6, 'Charizard', 7, 18, 'Escupe fuego tan caliente que funde las rocas. Causa incendios forestales sin querer.', '006.png'),
                                                                                           (7, 'Squirtle', 2, NULL, 'Tras nacer, su espalda se hincha y se endurece formando una concha. Echa potente espuma por la boca.', '007.png'),
                                                                                           (8, 'Wartortle', 2, NULL, 'Se le considera un símbolo de longevidad. Los ejemplares más ancianos tienen musgo en su caparazón.', '008.png'),
                                                                                           (9, 'Blastoise', 2, NULL, 'Un Pokémon brutal con chorros de agua a presión en su caparazón. Se usan para ataques a distancia.', '009.png'),
                                                                                           (10, 'Caterpie', 3, NULL, 'Sus patas cortas tienen ventosas que le permiten trepar muros y pendientes sin cansarse.', '010.png'),
                                                                                           (11, 'Metapod', 3, NULL, 'Este Pokémon es vulnerable al ataque mientras su concha sea blanda, exponiendo su cuerpo tierno y débil.', '011.png'),
                                                                                           (12, 'Butterfree', 3, 18, 'En combate, aletea a gran velocidad para lanzar polvos tóxicos al aire.', '012.png'),
                                                                                           (13, 'Weedle', 3, 17, 'El aguijón de su cabeza es muy puntiagoso. Se alimenta de hojas en la maleza de bosques y praderas.', '013.png'),
                                                                                           (14, 'Kakuna', 3, 17, 'Casi incapaz de moverse, este Pokémon solo puede endurecer su caparazón para protegerse de los depredadores.', '014.png'),
                                                                                           (15, 'Beedrill', 3, 17, 'Vuela a gran velocidad y ataca usando los grandes aguijones venenosos de sus patas delanteras y cola.', '015.png'),
                                                                                           (16, 'Pidgey', 11, 18, 'Muy común en bosques y selvas. Aletea al nivel del suelo para levantar arena y cegar a sus rivales.', '016.png'),
                                                                                           (17, 'Pidgeotto', 11, 18, 'Muy protector de su amplio territorio, este Pokémon picotea ferozmente a todo intruso.', '017.png'),
                                                                                           (18, 'Pidgeot', 11, 18, 'Cuando caza, vuela muy cerca del agua a gran velocidad para sorprender a presas incautas como Magikarp.', '018.png'),
                                                                                           (19, 'Rattata', 11, NULL, 'Come cualquier cosa. Allá donde haya comida, pondrá su nido y se reproducirá sin parar.', '019.png'),
                                                                                           (20, 'Raticate', 11, NULL, 'Sus patas traseras tienen tres dedos y son palmeadas. Le permiten nadar por los ríos y cazar presas.', '020.png'),
                                                                                           (21, 'Spearow', 11, 18, 'Come insectos en zonas de hierba. Tiene que agitar sus alas muy rápido para mantenerse en el aire.', '021.png'),
                                                                                           (22, 'Fearow', 11, 18, 'Con su enorme y largo pico, es capaz de sacar presas de la tierra o del agua con gran facilidad.', '022.png'),
                                                                                           (23, 'Ekans', 17, NULL, 'Se desplaza en silencio para engullir huevos de aves, como los de Pidgey o Spearow, enteros.', '023.png'),
                                                                                           (24, 'Arbok', 17, NULL, 'Se dice que las feroces señales de alerta de su panza varían de una zona a otra.', '024.png'),
                                                                                           (25, 'Pikachu', 5, NULL, 'Cuando se enfada, libera inmediatamente la energía almacenada en las bolsas de sus mejillas.', '025.png'),
                                                                                           (26, 'Raichu', 5, NULL, 'Su larga cola le sirve de toma de tierra para protegerse a sí mismo de su propio alto voltaje.', '026.png'),
                                                                                           (27, 'Sandshrew', 16, NULL, 'Se enrolla en una bola cuando se siente amenazado. Así puede rodar para escapar o atacar.', '027.png'),
                                                                                           (28, 'Sandslash', 16, NULL, 'Se enrolla en una bola de pinchos si se siente amenazado. Puede rodar para atacar o escapar.', '028.png'),
                                                                                           (29, 'Nidoran♀', 17, NULL, 'Aunque sea pequeño, sus cuernos venenosos lo hacen muy peligroso.', '029.png'),
                                                                                           (30, 'Nidorina', 17, NULL, 'El cuerno de la hembra crece lentamente. Prefiere los ataques físicos como arañar y morder.', '030.png'),
                                                                                           (31, 'Nidoqueen', 17, 16, 'Usa su cuerpo blindado con escamas duras para ejecutar potentes ataques.', '031.png'),
                                                                                           (32, 'Nidoran♂', 17, NULL, 'Mueve sus orejas en cualquier dirección para vigilar. Sus cuernos lanzan un potente veneno.', '032.png'),
                                                                                           (33, 'Nidorino', 17, NULL, 'Muy agresivo, está siempre listo para atacar. El cuerno de su cabeza segrega un potente veneno.', '033.png'),
                                                                                           (34, 'Nidoking', 17, 16, 'Usa su potente cola en combate para aplastar a su rival y triturarle los huesos.', '034.png'),
                                                                                           (35, 'Clefairy', 8, NULL, 'Su aspecto adorable y sus andares juguetones lo hacen muy popular.', '035.png'),
                                                                                           (36, 'Clefable', 8, NULL, 'Un Pokémon hada tímido que rara vez se deja ver. Corre a esconderse si siente gente.', '036.png'),
                                                                                           (37, 'Vulpix', 7, NULL, 'Al nacer, solo tiene una cola blanca. Ésta se divide en seis si recibe mucho cariño.', '037.png'),
                                                                                           (38, 'Ninetales', 7, NULL, 'Muy inteligente y muy vengativo. Se dice que si alguien le agarra una cola, lo maldice.', '038.png'),
                                                                                           (39, 'Jigglypuff', 11, 8, 'Cuando sus ojos se iluminan, canta una melodía que duerme a sus enemigos.', '039.png'),
                                                                                           (40, 'Wigglytuff', 11, 8, 'Su cuerpo es muy elástico. Si inhala mucho aire, puede inflarse a dimensiones enormes.', '040.png'),
                                                                                           (41, 'Zubat', 17, 18, 'Emite ondas ultrasónicas para notar lo que tiene delante y volar por cuevas oscuras.', '041.png'),
                                                                                           (42, 'Golbat', 17, 18, 'Una vez que muerde, no suelta a su presa. Succiona sangre incluso si ésta es venenosa.', '042.png'),
                                                                                           (43, 'Oddish', 12, 17, 'Durante el día, entierra su cuerpo en el suelo. Sus pies parecen raíces de árboles.', '043.png'),
                                                                                           (44, 'Gloom', 12, 17, 'El fluido que gotea de su boca es un néctar que usa para atraer a sus presas.', '044.png'),
                                                                                           (45, 'Vileplume', 12, 17, 'Cuanto más grandes son sus pétalos, más polen tóxico contienen.', '045.png'),
                                                                                           (46, 'Paras', 3, 12, 'Crece con setas llamadas tochukaso en su espalda que se alimentan de sus nutrientes.', '046.png'),
                                                                                           (47, 'Parasect', 3, 12, 'Una pareja de parásitos donde la seta ha tomado el control del bicho.', '047.png'),
                                                                                           (48, 'Venonat', 3, 17, 'Vive en las sombras de los árboles altos, donde come insectos. Le atrae la luz.', '048.png'),
                                                                                           (49, 'Venomoth', 3, 17, 'Las escamas de sus alas son difíciles de quitar y liberan veneno al contacto.', '049.png'),
                                                                                           (50, 'Diglett', 16, NULL, 'Vive a un metro bajo tierra, donde se alimenta de raíces. Sale a la superficie rara vez.', '050.png'),
                                                                                           (51, 'Dugtrio', 16, NULL, 'Un equipo de trillizos Diglett. Provocan terremotos cuando cavan a gran profundidad.', '051.png'),
                                                                                           (52, 'Meowth', 11, NULL, 'Le encantan las cosas brillantes. Especialmente las monedas que encuentra tiradas.', '052.png'),
                                                                                           (53, 'Persian', 11, NULL, 'Aunque muchos lo admiran por su elegancia, es muy difícil de entrenar por su carácter.', '053.png'),
                                                                                           (54, 'Psyduck', 2, NULL, 'Padece continuamente dolores de cabeza. Cuando el dolor se intensifica, usa extraños poderes.', '054.png'),
                                                                                           (55, 'Golduck', 2, NULL, 'Suele verse nadando elegantemente por las orillas de los lagos. Es increíblemente rápido.', '055.png'),
                                                                                           (56, 'Mankey', 10, NULL, 'Es muy difícil acercarse a él cuando se enfada. Si empieza a temblar, mejor alejarse.', '056.png'),
                                                                                           (57, 'Primeape', 10, NULL, 'Se enfada incluso cuando no hay motivo. Si alguien le mira a los ojos, lo perseguirá.', '057.png'),
                                                                                           (58, 'Growlithe', 7, NULL, 'Muy fiel a su entrenador. Ladra ferozmente a todo aquel que ose invadir su territorio.', '058.png'),
                                                                                           (59, 'Arcanine', 7, NULL, 'Un Pokémon muy admirado desde la antigüedad por su belleza. Corre con mucha ligereza.', '059.png'),
                                                                                           (60, 'Poliwag', 2, NULL, 'Sus patas recién nacidas no le dejan caminar bien. Parece que prefiere nadar.', '060.png'),
                                                                                           (61, 'Poliwhirl', 2, NULL, 'Puede vivir tanto dentro como fuera del agua. Suda para mantener su piel húmeda fuera.', '061.png'),
                                                                                           (62, 'Poliwrath', 2, 10, 'Un nadador experto y fuerte que utiliza todos los estilos. Supera a cualquier humano.', '062.png'),
                                                                                           (63, 'Abra', 13, NULL, 'Duerme 18 horas al día. Si nota peligro, se teletransporta incluso estando dormido.', '063.png'),
                                                                                           (64, 'Kadabra', 13, NULL, 'Se dice que un chico con capacidades extrasensoriales se transformó de repente en Kadabra.', '064.png'),
                                                                                           (65, 'Alakazam', 13, NULL, 'Su cerebro no para de crecer y sus neuronas se multiplican. IQ de 5000.', '065.png'),
                                                                                           (66, 'Machop', 10, NULL, 'Su cuerpo está lleno de músculos. Puede levantar a cien personas.', '066.png'),
                                                                                           (67, 'Machoke', 10, NULL, 'El cinturón que lleva es para contener su abrumadora energía.', '067.png'),
                                                                                           (68, 'Machamp', 10, NULL, 'Sus cuatro brazos reaccionan muy rápido. Puede dar muchos puñetazos a la vez.', '068.png'),
                                                                                           (69, 'Bellsprout', 12, 17, 'Un Pokémon carnívoro que atrapa y come insectos. Sus raíces le sirven de patas.', '069.png'),
                                                                                           (70, 'Weepinbell', 12, 17, 'Escupe polvo venenoso para inmovilizar a su presa y luego la remata con ácido.', '070.png'),
                                                                                           (71, 'Victreebel', 12, 17, 'Se dice que vive en grandes colonias en lo profundo de las selvas.', '071.png'),
                                                                                           (72, 'Tentacool', 2, 17, 'Flota a la deriva en aguas poco profundas. Si se le toca, lanzará una punzada venenosa.', '072.png'),
                                                                                           (73, 'Tentacruel', 2, 17, 'Tiene 80 tentáculos que se mueven libremente. Atrapan a muchísimas presas a la vez.', '073.png'),
                                                                                           (74, 'Geodude', 14, 16, 'Se suele encontrar en senderos de montaña. Si se pisa por error, atacará.', '074.png'),
                                                                                           (75, 'Graveler', 14, 16, 'Se desplaza rodando por las pendientes. No le importa chocar contra rocas.', '075.png'),
                                                                                           (76, 'Golem', 14, 16, 'Su cuerpo es tan duro que ni las explosiones de dinamita le hacen un rasguño.', '076.png'),
                                                                                           (77, 'Ponyta', 7, NULL, 'Al nacer es muy débil y apenas puede ponerse en pie. Corre tras sus padres.', '077.png'),
                                                                                           (78, 'Rapidash', 7, NULL, 'Muy competitivo, este Pokémon perseguirá a cualquier cosa que se mueva rápido.', '078.png'),
                                                                                           (79, 'Slowpoke', 2, 13, 'Es increíblemente lento y perezoso. Tarda cinco segundos en sentir dolor.', '079.png'),
                                                                                           (80, 'Slowbro', 2, 13, 'Dicen que el Shellder que tiene mordido en la cola se alimenta de sus sobras.', '080.png'),
                                                                                           (81, 'Magnemite', 5, 1, 'Flota en el aire gracias a la fuerza electromagnética de sus imanes.', '081.png'),
                                                                                           (82, 'Magneton', 5, 1, 'Formado por tres Magnemite unidos. Aparecen cuando hay manchas solares.', '082.png'),
                                                                                           (83, 'Farfetch\'d', 11, 18, 'Siempre lleva consigo el tallo de una planta. Lo usa como si fuera una espada.', '083.png'),
                                                                                           (84, 'Doduo', 11, 18, 'Un Pokémon de dos cabezas que corre a gran velocidad dejando huellas profundas.', '084.png'),
                                                                                           (85, 'Dodrio', 11, 18, 'Sus tres cabezas representan la alegría, la tristeza y la ira. Siempre está en guardia.', '085.png'),
                                                                                           (86, 'Seel', 2, NULL, 'Las aguas gélidas son su hogar. Le encanta nadar entre icebergs.', '086.png'),
                                                                                           (87, 'Dewgong', 2, 9, 'Almacena energía térmica en su cuerpo. Puede nadar en aguas congeladas.', '087.png'),
                                                                                           (88, 'Grimer', 17, NULL, 'Aparece en los vertederos. Se alimenta de los residuos tóxicos de las fábricas.', '088.png'),
                                                                                           (89, 'Muk', 17, NULL, 'Está cubierto de un lodo tóxico. Sus huellas dejan la tierra estéril años.', '089.png'),
                                                                                           (90, 'Shellder', 2, NULL, 'Su concha es más dura que el diamante. Sin embargo, por dentro es muy tierno.', '090.png'),
                                                                                           (91, 'Cloyster', 2, 9, 'Cuando cierra su concha, es imposible abrirla. Solo se abre para atacar.', '091.png'),
                                                                                           (92, 'Gastly', 6, 17, 'Casi invisible, este Pokémon gaseoso envuelve a su presa y la duerme.', '092.png'),
                                                                                           (93, 'Haunter', 6, 17, 'Debido a su capacidad para atravesar muros, dicen que viene de otra dimensión.', '093.png'),
                                                                                           (94, 'Gengar', 6, 17, 'Por la noche, se oculta en las sombras para absorber el calor corporal.', '094.png'),
                                                                                           (95, 'Onix', 14, 16, 'Al excavar el suelo, absorbe muchos objetos duros. Por eso su cuerpo es tan sólido.', '095.png'),
                                                                                           (96, 'Drowzee', 13, NULL, 'Si te pica la nariz al dormir, es señal de que intenta comerse tus sueños.', '096.png'),
                                                                                           (97, 'Hypno', 13, NULL, 'Siempre lleva un péndulo. Dicen que una vez hizo desaparecer a un niño.', '097.png'),
                                                                                           (98, 'Krabby', 2, NULL, 'Sus pinzas son armas potentes y le sirven para mantener el equilibrio.', '098.png'),
                                                                                           (99, 'Kingler', 2, NULL, 'Su enorme pinza tiene una fuerza inmensa, pero le pesa mucho.', '099.png'),
                                                                                           (100, 'Voltorb', 5, NULL, 'Se parece mucho a una Poké Ball. Muy peligroso, puede explotar al contacto.', '100.png'),
                                                                                           (101, 'Electrode', 5, NULL, 'Se alimenta de electricidad. En tormentas suele explotar por exceso de energía.', '101.png'),
                                                                                           (102, 'Exeggcute', 12, 13, 'Este Pokémon está formado por seis huevos que se comunican por telepatía.', '102.png'),
                                                                                           (103, 'Exeggutor', 12, 13, 'Se dice que, si una de sus cabezas se cae, se convierte en un Exeggcute.', '103.png'),
                                                                                           (104, 'Cubone', 16, NULL, 'Lleva el casco del cráneo de su madre. Sus lloros resuenan dentro con tristeza.', '104.png'),
                                                                                           (105, 'Marowak', 16, NULL, 'La evolución de un Cubone que ha superado su pena. Su carácter es ahora fiero.', '105.png'),
                                                                                           (106, 'Hitmonlee', 10, NULL, 'Cuando patea, sus piernas se estiran el doble de su longitud original.', '106.png'),
                                                                                           (107, 'Hitmonchan', 10, NULL, 'Se dice que posee el espíritu de un boxeador que entrenaba para el campeonato.', '107.png'),
                                                                                           (108, 'Lickitung', 11, NULL, 'Su lengua mide el doble que su cuerpo. La usa para agarrar comida y atacar.', '108.png'),
                                                                                           (109, 'Koffing', 17, NULL, 'Su cuerpo está lleno de gases tóxicos. Suele acercarse a los vertederos.', '109.png'),
                                                                                           (110, 'Weezing', 17, NULL, 'Vive en lugares sucios y contaminados. Se alimenta de gases y desperdicios.', '110.png'),
                                                                                           (111, 'Rhyhorn', 16, 14, 'Sus huesos son mil veces más duros que los humanos. Puede derribar edificios.', '111.png'),
                                                                                           (112, 'Rhydon', 16, 14, 'Su gruesa piel le permite vivir en el interior de un volcán.', '112.png'),
                                                                                           (113, 'Chansey', 11, NULL, 'Un Pokémon amable que comparte sus nutritivos huevos con heridos.', '113.png'),
                                                                                           (114, 'Tangela', 12, NULL, 'Todo su cuerpo está envuelto en lianas azules que no paran de crecer.', '114.png'),
                                                                                           (115, 'Kangaskhan', 11, NULL, 'La madre nunca deja solo al pequeño de su bolsa hasta que cumple tres años.', '115.png'),
                                                                                           (116, 'Horsea', 2, NULL, 'Se mantiene en equilibrio con su cola enrollada. Escupe tinta negra si se asusta.', '116.png'),
                                                                                           (117, 'Seadra', 2, NULL, 'Sus aletas y huesos son apreciados. Sus espinas segregan veneno.', '117.png'),
                                                                                           (118, 'Goldeen', 2, NULL, 'Sus aletas están muy desarrolladas, lo que le permite nadar a gran velocidad.', '118.png'),
                                                                                           (119, 'Seaking', 2, NULL, 'En otoño, los machos bailan para atraer a las hembras.', '119.png'),
                                                                                           (120, 'Staryu', 2, NULL, 'Si pierde una extremidad, se regenerará siempre que su núcleo brille.', '120.png'),
                                                                                           (121, 'Starmie', 2, 13, 'Su núcleo brilla con siete colores. Algunos creen que viene de otro planeta.', '121.png'),
                                                                                           (122, 'Mr. Mime', 13, 8, 'Experto de la pantomima. Capaz de crear muros invisibles con sus gestos.', '122.png'),
                                                                                           (123, 'Scyther', 3, 18, 'Agilidad de ninja, crea ilusiones de sí mismo. Corta todo con sus guadañas.', '123.png'),
                                                                                           (124, 'Jynx', 9, 13, 'Se mueve con ritmo seductor. Quien lo ve no puede evitar bailar.', '124.png'),
                                                                                           (125, 'Electabuzz', 5, NULL, 'Aparece cerca de centrales eléctricas. Se alimenta de energía.', '125.png'),
                                                                                           (126, 'Magmar', 7, NULL, 'Su cuerpo está en constante combustión. Vive cerca de volcanes activos.', '126.png'),
                                                                                           (127, 'Pinsir', 3, NULL, 'Si no destroza con sus pinzas, lo zarandeará y lo lanzará muy lejos.', '127.png'),
                                                                                           (128, 'Tauros', 11, NULL, 'Muy violento. Cuando va a cargar, se azota con sus tres colas.', '128.png'),
                                                                                           (129, 'Magikarp', 2, NULL, 'El Pokémon más débil del mundo. Es un misterio cómo sobrevive.', '129.png'),
                                                                                           (130, 'Gyarados', 2, 18, 'Muy destructivo. En la antigüedad destruyó ciudades enteras.', '130.png'),
                                                                                           (131, 'Lapras', 2, 9, 'Corazón noble. Le encanta llevar a la gente sobre su caparazón.', '131.png'),
                                                                                           (132, 'Ditto', 11, NULL, 'Puede copiar el código genético de cualquier enemigo para transformarse.', '132.png'),
                                                                                           (133, 'Eevee', 11, NULL, 'Un Pokémon raro que evoluciona distinto según el entorno.', '133.png'),
                                                                                           (134, 'Vaporeon', 2, NULL, 'Estructura similar al agua. Puede fundirse con ella y hacerse invisible.', '134.png'),
                                                                                           (135, 'Jolteon', 5, NULL, 'Lanza rayos de 10.000 voltios. Sus pelos parecen agujas.', '135.png'),
                                                                                           (136, 'Flareon', 7, NULL, 'Almacena calor, su temperatura puede subir hasta los 900 grados.', '136.png'),
                                                                                           (137, 'Porygon', 11, NULL, 'Pokémon artificial que puede desplazarse por el ciberespacio.', '137.png'),
                                                                                           (138, 'Omanyte', 14, 2, 'Extinguido hace mucho tiempo, resucitado a partir de un fósil.', '138.png'),
                                                                                           (139, 'Omastar', 14, 2, 'Se extinguió porque su caparazón pesaba demasiado para moverse.', '139.png'),
                                                                                           (140, 'Kabuto', 14, 2, 'Resucitado a partir de un fósil. Vive en el fondo del mar.', '140.png'),
                                                                                           (141, 'Kabutops', 14, 2, 'Sus garras son guadañas. Se estaba adaptando a la vida en tierra.', '141.png'),
                                                                                           (142, 'Aerodactyl', 14, 18, 'Feroz de la época de los dinosaurios, resucitado a partir de ámbar.', '142.png'),
                                                                                           (143, 'Snorlax', 11, NULL, 'Solo despierta para comer 400 kg al día y luego vuelve a dormir.', '143.png'),
                                                                                           (144, 'Articuno', 9, 18, 'Pájaro legendario. Aparece ante montañeros perdidos en la nieve.', '144.png'),
                                                                                           (145, 'Zapdos', 5, 18, 'Pájaro legendario. Vive en nubes de tormenta y controla los rayos.', '145.png'),
                                                                                           (146, 'Moltres', 7, 18, 'Pájaro legendario. Sus alas de fuego anuncian la primavera.', '146.png'),
                                                                                           (147, 'Dratini', 4, NULL, 'Se creyó mitológico hasta que se halló una colonia submarina.', '147.png'),
                                                                                           (148, 'Dragonair', 4, NULL, 'Vive en mares y lagos. Tiene la capacidad de controlar el clima.', '148.png'),
                                                                                           (149, 'Dragonite', 4, 18, 'Pokémon bondadoso. Puede dar la vuelta al mundo en 16 horas.', '149.png'),
                                                                                           (150, 'Mewtwo', 13, NULL, 'Fue creado mediante ingeniería genética. Es puro poder.', '150.png'),
                                                                                           (151, 'Mew', 13, NULL, 'Tan raro que muchos creen que es un espejismo.', '151.png');

