insert into idiomas values
(null,"comun"),
(null,"elfico"),
(null,"enano"),
(null,"gigante"),
(null,"gnomo"),
(null,"trasgo"),
(null,"mediano"),
(null,"orco");

insert into armaduras values
(null,"acolchada","ligera",11,99,null,"desventaja",8,5),
(null,"cuero","ligera",11,99,null,null,10,10),
(null,"cuero tachonado","ligera",12,99,null,null,30,45),
(null,"pechera","media",14,2,null,null,20,400),
(null,"cota de escamas","media",14,2,null,"desventaja",20,50),
(null,"placas de acero","media",15,2,null,"desventaja",40,750),
(null,"malla","pesada",16,null,13,"desventaja",20,75),
(null,"ferula","pesada",17,null,15,"desventaja",600,200),
(null,"cota de malla","pesada",14,null,null,"desventaja",40,30),
(null,"escudo","escudo",2,null,null,null,6,10);

insert into armas values
(null,"daga",5,"simple melee","1d4","perforante",1,2),
(null,"maza",5,"simple melee","1d6","contundente",4,5),
(null,"hoz",5,"simple melee","1d6","cortante",2,1),
(null,"arco",320,"simple distancia","1d8","perforante",5,25),
(null,"dardo",60,"simple distancia","1d4","perforante",4,5),
(null,"arco corto",320,"simple distancia","1d6","perforante",2,25),
(null,"hacha de guerra",5,"marcial melee","1d4","cortante",4,10),
(null,"guja",5,"marcial melee","1d10","cortante",6,20),
(null,"tridente",5,"marcial melee","1d6","perforante",4,5),
(null,"ballesta",100,"marcial distancia","1d6","perforante",3,75);

insert into razas values
(null,"enano","Duros y valientes, los enanos son conocidos como hábiles guerreros, mineros y trabajadores de la piedra y el metal. Aunque midan menos de un metro y medio, los enanos son tan anchos y compactos que pueden pesar tanto como un humano más de medio metro más alto. Su coraje y resistencia también iguala fácilmente a cualquiera de las gentes más altas."
,"./imagenes/personajes/enano.jpg",
2,"constitucion","mediano","visión en la oscuridad",25,null),
(null,"enano de la colina","Como enano de las colinas tienes sentidos perspicaces, una profunda intuición y una notable resistencia. Los Enanos dorados de Faerûn en su poderoso reino del sur son enanos de las colinas, como son el exiliado Neidar y el envilecido Klar of Krynn en el escenario de Dragonlance."
,"./imagenes/personajes/enanoColina.jpg",1,"sabiduria","mediano","visión en la oscuridad",25,1),
(null,"enano de la montaña","Como enano de las montañas, eres fuerte y duro, acostumbrado a una vida difícil en un terreno áspero. Probablemente eres alto (para un enano) y tiendes hacia una coloración de piel más clara. Los enanos escudo del norte de Faerûn a la vez que el dominante clan Hylar y el noble clan Daewar de Dragonlance, son enanos de las montañas."
,"./imagenes/personajes/enanoMontana.jpg",2,"fuerza","mediano","visión en la oscuridad",25,1),
(null,"elfo","Los elfos son un pueblo mágico de gracia sobrenatural, viviendo en el mundo sin ser del todo parte de él. Viven en lugares de etérea belleza, en medio de antiguos bosques o en plateados minaretes que resplandecen con luz feérica, donde una suave música flota en el aire y delicadas fragancias son transportadas por la brisa. Los elfos aman la naturaleza y la magia, el arte y la maestría, la música y la poesía, y las cosas buenas del mundo."
,"./imagenes/personajes/elfo.jpg",2,"destreza","mediano","visión en la oscuridad",30,null),
(null,"alto elfo","Como alto elfo, tienes una mente aguda y dominio de al menos lo básico de la magia. En muchos de los mundos de D&D hay dos tipos de altos elfos. Un tipo (que incluye los elfos grises y elfos de los valles de Greyhawk, los Silvanesti de Dragonlance y los elfos solares de los Reinos Olvidados) son altivos y aislacionistas, creyéndose superiores a los no-elfos e incluso al resto de elfos. El otro tipo (incluyendo a los altos elfos de Greyhawk, los Qualinesti de Dragonlance y los elfos lunares de los Reinos Olvidados) son más comunes y más amistosos, y a menudo se les encuentra entre humanos y otras razas."
,"./imagenes/personajes/elfoAlto.jpg",1,"inteligencia","mediano","visión en la oscuridad",30,4),
(null,"elfo del bosque","Como elfo de los bosques, tu intuición y tus sentidos son agudos, y tus pies ligeros pueden transportarte rápida y sigilosamente a través de tus bosques natales. Esta categoría incluye a los elfos salvajes (grugach) de Greyhawk y a los Kagonesti de Dragonlance, al igual que a las razas conocidas como elfos de los bosques en Greyhawk y los Reinos Olvidados."
,"./imagenes/personajes/elfoBosque.jpg",1,"sabiduria","mediano","visión en la oscuridad",30,4),
(null,"gnomo","Un zumbido constante de actividad impregna las madrigueras y vecindarios donde los gnomos forman sus estrechamente unidas comunidades. Sonidos más fuertes interrumpen el bullicio: el crujido de ruedas de moler por aquí, una pequeña explosión por allá, un aullido de sorpresa o triunfo y especialmente estallidos de risas. Los gnomos se toman la vida con deleite, disfrutando cada momento de invención, exploración, investigación, creación y juego."
,"./imagenes/personajes/gnomo.jpg",2,"inteligencia","pequeño","visión en la oscuridad",25,null),
(null,"gnomo del bosque","Como gnomo del bosque, tienes una habilidad natural para las ilusiones, y una rapidez y cautela inherentes. En los mundos de D&D, los gnomos del bosque son raros y reservados.Se reúnen en comunidades ocultas en bosques selváticos,usando ilusiones y trucos para esconderse de las amenazas o para enmascarar sus huidas sin ser detectados. Los gnomos del bosque tienden a ser amistosos con otros habitantes de buen corazón del busque, y mantienen a los elfos y los seres feéricos buenos como sus aliados más importantes. Estos gnomos también son amigos de los animales pequeños del bosque y confían en ellos para que les informen de las amenazas que pueden rondar por sus tierras."
,"./imagenes/personajes/gnomo.jpg", 1,"destreza","pequeño","visión en la oscuridad",25,7),
(null,"gnomo de la roca","Como gnomo de la roca, posees una inventiva natural y resistencia más allá de la de los otros gnomos. La mayoría de los gnomos en los mundos de D&D son gnomos de las rocas, incluyendo a los gnomos hojalateros del mundo de Dragonlance."
,"/imagenes/personajes/gnomo.jpg", 1,"destreza","pequeño","visión en la oscuridad",25,7),
(null,"mediano","Las comodidades del hogar son las metas para la mayoría de las vidas de los medianos: un lugar donde asentarse en paz y tranquilidad, lejos de monstruos merodeadores y enfrentamientos de ejércitos, buena bebida y buena conversación. Aunque algunos medianos viven sus días en alejadas comunidades agrícolas, otros forman grupos nómadas que viajan constantemente, atraídos por los nuevos caminos y anchos horizontes, para descubrir las maravillas de las nuevas tierras y gentes. Pero incluso estos viajeros aman la paz, comida, el bienestar y el hogar, aunque el hogar sea un vagón empujado a tirones a través de un camino embarrado o una barcaza flotando río abajo."
,"./imagenes/personajes/mediano.jpg", 2,"destreza","pequeño","visión en la oscuridad",25,null),
(null,"mediano piesligeros","Como un mediano piesligeros, puedes pasar desapercibido fácilmente, incluso usando a otra persona como cobertura. Tiendes a ser amable y llevarte bien con los demás. En los Reinos Olvidados, los medianos piesligeros son los más extendidos por lo que son la variedad más común. Los piesligeros son más propensos al gusto por viajar que otros medianos, y siempre viven junto a otras razas o emprenden una vida nómada. En el mundo de Greyhawk, estos medianos son llamados piespeludos o compañerosaltos."
,"./imagenes/personajes/mediano.jpg", 1,"carisma","pequeño","visión común",25,10),
(null,"mediano fornido","Como mediano fornido eres más duro que la mayoría y tienes algo de resistencia al veneno. Algunos dicen que los fornidos tienen sangre enana. En los Reinos Olvidados, estos medianos son llamados corazonesfuertes y son más comunes en el sur."
,"./imagenes/personajes/mediano.jpg", 1,"constitucion","pequeño","visión común",25,10);

set foreign_key_checks=0;
insert into razas_idiomas values
(1, 1),
(1, 3),
(4, 1),
(4, 2),
(7, 1),
(7, 5),
(10,1),
(10,7);
set foreign_key_checks=1;

insert into habilidadesRaciales values
(null, "Resistencia Enana", "Tienes ventaja en las tiradas de salvación contra veneno, y posees resistencia contra el daño por veneno."),
(null, "Entrenamiento de Combate Enano", "Eres competente con el hacha de batalla, hacha de mano, martillo arrojadizo y martillo de guerra."),
(null, "Competencia con Herramientas", "Ganas competencia con unas herramientas de artesano a tu elección: herramientas de herrero, materiales de cervecería o herramientas de albañil."),
(null, "Afinidad con la Piedra", "Cuando quiera que hagas una prueba de Inteligencia (Historia) relacionada con el origen de un trabajo hecho en piedra, eres considerado competente en la habilidad de Historia y añades el doble de tu bonificador de competencia a la tirada, en lugar de tu bonificador de competencia normal."),
(null, "Dureza Enana", "Tus Puntos de Golpe máximos aumentan en 1, y aumentan en 1 cada vez que ganes un nivel."),
(null, "Entrenamiento con Armadura Enana", "Tienes competencia con las armaduras ligeras y medias."),
(null, "Sentidos Agudos", "Eres competente con la habilidad de Percepción."),
(null, "Ascendencia Feérica", "Tienes ventaja en las tiradas de salvación contra Encantamiento, y no puedes ser dormido mediante la magia."),
(null, "Trance", "Los elfos no necesitan dormir. En lugar de eso, meditan profundamente, permaneciendo semiconscientes durante 4 horas al día. (La palabra en Común para tal meditación es “trance”). Mientras meditas, puedes soñar en cierta manera; tales sueños son en realidad ejercicios mentales quese han convertido en un reflejo a lo largo de años de práctica. Tras descansar de esta manera, obtienes el mismo beneficio que un humano tras 8 horas de sueño."),
(null, "Entrenamiento en Armas Élficas", "Eres competente con la espada larga, espada corta, arco largo y arco corto."),
(null, "Trucos", "Conoces un truco de tu elección de la lista de conjuros de mago. La Inteligencia es tu característica de lanzamiento de conjuros con él."),
(null, "Idioma Adicional", "Sabes hablar, leer y escribir un idioma adicional de tu elección."),
(null, "Ligero de Pies", "Tu velocidad base andando aumenta a 35 pies."),
(null, "Mascara de la Espesura", "Puedes intentar esconderte incluso cuando sólo estás ligeramente cubierto por el follaje, una lluvia fuerte, la nieve que cae, niebla y otros fenómenos naturales."),
(null, "Astucia Gnoma", "Obtienes ventaja en todas tus tiradas de salvación de Inteligencia, Sabiduría y Carisma contra magia."),
(null,"Ilusionista Natural","Conoces el truco ilusión menor. Inteligencia es tu característica para realizar el conjuro"),
(null,"Hablar con las Bestias Pequeñas","A través de sonidos y gestos, puedes comunicar ideas simples a bestias Pequeñas o más pequeñas. Los gnomos de los bosques aman a los animales y frecuentemente tienen ardillas, tejones, conejos, topos, pájaros carpinteros y otras criaturas como adoradas mascotas."),
(null,"Conocimiento de Artífice","Siempre que hagas una tirada de Inteligencia (Historia) relacionada con objetos mágicos, objetos alquímicos o aparatos tecnológicos, puedes añadir dos veces tu bonificación de competencia en lugar del bonificador de competencia que aplicarías normalmente."),
(null,"Hojalatero","Obtienes competencia con herramientas de artesano (herramientas de hojalatero). Usando estas herramientas, puedes gastar 1 hora y 10 po en materiales para construir un artefacto de cuerda diminuto (CA 5, 1 PG). El artefacto deja de funcionar tras 24 horas (a no ser que dediques 1 hora a repararlo para mantener el artefacto en funcionamiento), o cuando usas tu acción para desmantelarlo, momento en el cual puedes recuperar los materiales que usaste para crearlo. Puedes tener hasta tres de estos artefactos activos a la vez."),
(null,"Suertudo","Cuando obtienes un 1 en una tirada de ataque, prueba de característica o tirada de salvación, puedes volver a tirar el dado y debes usar la puntuación obtenida en la nueva tirada."),
(null,"Valiente","Tienes ventaja en las tiradas de salvación en contra de ser asustado."),
(null,"Agilidad Mediana","Puedes moverte a través del espacio de cualquier criatura que sea de un tamaño mayor que el tuyo"),
(null,"Sigiloso por Naturaleza","Puedes intentar esconderte incluso cuando solamente estás cubierto tras una criatura que es al menos un tamaño mayor que tú."),
(null,"Resistencia Fornida","Tienes ventaja en tiradas de salvación contra veneno, y tienes resistencia contra daño de veneno.");

set foreign_key_checks=0;
insert into habilidadesRaciales_razas values
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 3),
(7, 4),
(8, 4),
(9, 4),
(10, 5),
(11, 5),
(12, 5),
(10, 6),
(13, 6),
(14, 6),
(15, 7),
(16,8),
(17,8),
(18,9),
(19,9),
(20,10),
(21,10),
(22,10),
(23,11),
(24,12);


insert into clases values
(null,"barbaro","1d12","fuerza",null,"fuerza","constitucion", 7, 2, 50),
(null,"bardo","1d8","carisma",null,"destreza","carisma", 3, 1, 70),
(null,"brujo","1d8","carisma",null,"sabiduria","carisma", 1, 1, 75),
(null,"clerigo","1d8","sabiduria",null,"inteligencia","sabiduria", 2, 5, 40),
(null,"explorador","1d10","destreza","sabiduria","fuerza","destreza", 6, 2, 60),
(null,"guerrero","1d10","fuerza","destreza","fuerza","constitucion", 7, 6, 80),
(null,"hechicero","1d6","carisma",null,"constitucion","carisma", 1, 1, 30),
(null,"mago","1d6","inteligencia",null,"inteligencia","sabiduria", 1, 1, 50),
(null,"monje","1d8","destreza","sabiduria","fuerza","destreza", null, null, 20),
(null,"paladin","1d10","fuerza","carisma","sabiduria","carisma", 2, 6, 50),
(null,"picaro","1d8","destreza",null,"destreza","inteligencia", 1, 2, 60);
set foreign_key_checks=1;
insert into trasfondos values
(null,"acolito","Has pasado tu vida al servicio de un templo para un dios específico o panteón de dioses. Actúas como intermediario entre el reino del mundo sagrado y el mundo mortal, realizando ritos sagrados y ofreciendo sacrificios para llevar a los adoradores a la presencia de lo divino. No es necesariamente un clérigo; realizar ritos sagrados no es lo mismo que canalizar el poder divino. Elija un dios, un panteón de dioses o algún otro ser cuasi divino, y trabaje con su DM para detallar la naturaleza de su servicio religioso. La sección Gods of the Multiverse contiene un panteón de muestra, del escenario Forgotten Realms. ¿Fue usted un funcionario menor en un templo, criado desde la niñez para ayudar a los sacerdotes en los ritos sagrados? ¿O eras un sumo sacerdote que de repente experimentó un llamado a servir a tu dios de una manera diferente? Quizás eras el líder de un pequeño culto fuera de cualquier estructura de templo establecida, o incluso un grupo oculto que servía a un maestro diabólico que ahora niegas."
,"visión","religion"),
(null,"criminal","Es un criminal experimentado con un historial de infringir la ley. Has pasado mucho tiempo entre otros criminales y todavía tienes contactos dentro del inframundo criminal. Estás mucho más cerca que la mayoría de la gente del mundo de asesinatos, robos y violencia que invade la parte más vulnerable de la civilización, y has sobrevivido hasta este punto burlando las reglas y regulaciones de la sociedad. "
,"engaño","sigilo"),
(null,"soldado","La guerra ha sido su vida desde que quiere recordar. Te entrenaste cuando eras joven, estudiaste el uso de armas y armaduras, aprendiste técnicas básicas de supervivencia, incluido cómo mantenerte con vida en el campo de batalla. Es posible que haya sido parte de un ejército nacional permanente o una compañía de mercenarios, o quizás un miembro de una milicia local que saltó a la fama durante una guerra reciente. Cuando elija estos antecedentes, trabaje con su DM para determinar de qué organización militar formaba parte, cuánto progresó en sus filas y qué tipo de experiencias tuvo durante su carrera militar. ¿Era un ejército permanente, una guardia de la ciudad o una milicia de la aldea? O podría haber sido el ejército privado de un noble o un comerciante, o una compañía de mercenarios. "
,"atletismo","intimidacion");

insert into idiomas_trasfondos values
(1,1),(1,2),(1,3),
(2,1),(2,2),(2,3),
(3,1),(3,2),(3,3),
(4,1),(4,2),(4,3),
(5,1),(5,2),(5,3),
(6,1),(6,2),(6,3),
(7,1),(7,2),(7,3),
(8,1),(8,2),(8,3);

/* Usuario + personaje de prueba */ 
insert into usuarios (usuario, password) values ("Carlos", "ac9c2c34c9f7ad52528c3422af40a66e2e24aaf2a727831255413c9470158984");
set foreign_key_checks=0;
insert into personajes values(null, "Arghenom", 2, 1, null, null, 1, null, null, null, null, 13, 14, 15, 11, 10, 9, "./imagenes/personajes/enanoColina.jpg");
insert into usuarios_personajes (id_usuario, id_personaje) values(1, 1);
insert into personajes_idiomas (id_personaje, id_idioma) values(1, 1), (1, 3), (1, 4), (1, 6);
set foreign_key_checks=1;