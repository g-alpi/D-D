-- insert into usuarios values(null,'Test','123','test@gmail.com');
-- insert into usuarios values(null,'Bot','123','Bot@gmail.com'); 

-- insert into arma values(1,'Garrote','--','Melee','1d4','Contundente',2,'Ligero');
-- insert into arma values(2,'Daga','20/60','Melee','1d4','Penetrante',1,'Ligero, Arrojadiza');

-- insert into armadura values(1,'Armadura ligera acolchada','Light armor',11,'True',0,'Desventaja',8);
-- insert into armadura values(2,'Armadura ligera de cuero','Light armor',11,'True',0,'--',10);

-- insert into idiomas values('Común','Humanos');
-- insert into idiomas values('Orco','Orcos');

-- insert into razas values('Humano','humano simple',1,1,1,1,1,1,20,100,'No concreto','Mediano',30,'Humano');
-- insert into razas values('Semiorco','orco a medias',2,0,1,0,0,0,14,75,'Caos','Medium',30,'Semiorco');

-- insert into clase values('bárbaro','Hacha y armadura mediana',0,0);
-- insert into clase values('Picaro','Daga y armadura ligera de cuero',0,0);

select* from idiomas;

insert into idiomas values (null,"comun"),(null,"elfico"),(null,"enano"),(null,"gigante"),(null,"gnomo"),(null,"trasgo"),(null,"mediano"),(null,"orco");

select* from armaduras;
insert into armaduras values(null,"acolchada","ligera",11,99,null,"desventaja",8,5),(null,"cuero","ligera",11,99,null,null,10,10),(null,"cuero tachonado","ligera",12,99,null,null,30,45)
,(null,"pechera","media",14,2,null,null,20,400),(null,"cota de escamas","media",14,2,null,"desventaja",20,50),(null,"placas de acero","media",15,2,null,"desventaja",40,750),
(null,"malla","pesada",16,null,13,"desventaja",20,75),(null,"ferula","pesada",17,null,15,"desventaja",600,200),(null,"cota de malla","pesada",14,null,null,"desventaja",40,30),
(null,"escudo","escudo",2,null,null,null,6,10);

select* from armas;

insert into armas values(null,"daga",5,"simple melee","1d4","perforante",1,2),(null,"maza",5,"simple melee","1d6","contundente",4,5),(null,"hoz",5,"simple melee","1d6","cortante",2,1),
(null,"arco",320,"simple distancia","1d8","perforante",5,25),(null,"dardo",60,"simple distancia","1d4","perforante",4,5),(null,"arco corto",320,"simple distancia","1d6","perforante",2,25),
(null,"hacha de guerra",5,"marcial melee","1d4","cortante",4,10),(null,"guja",5,"marcial melee","1d10","cortante",6,20),(null,"tridente",5,"marcial melee","1d6","perforante",4,5),
(null,"ballesta",100,"marcial distancia","1d6","perforante",3,75);


select * from razas;

insert into razas values
 (null,"enano","Duros y valientes, los enanos son conocidos como hábiles guerreros, mineros y trabajadores de la piedra y el metal. Aunque midan menos de un metro y medio, los enanos son 
tan anchos y compactos que pueden pesar tanto como un humano más de medio metro más alto. Su coraje y resistencia también iguala fácilmente a cualquiera de las gentes más altas.","enano.jpg",
2,"constitucion","mediano",25,null);
insert into razas values
(null,"enano de la colina","Como enano de las colinas tienes sentidos perspicaces, una profunda intuición y una notable resistencia. Los Enanos dorados de Faerûn en su poderoso reino del sur
 son enanos de las colinas, como son el exiliado Neidar y el envilecido Klar of Krynn en el escenario de Dragonlance.","enanoColina.jpg",
1,"sabiduria","mediano",25,1);
insert into razas values
(null,"enano de la montaña","Como enano de las montañas, eres fuerte y duro, acostumbrado a una vida difícil en un terreno áspero. Probablemente eres alto (para un enano) y tiendes hacia una 
coloración de piel más clara. Los enanos escudo del norte de Faerûn a la vez que el dominante clan Hylar y el noble clan Daewar de Dragonlance, son enanos de las montañas.","enanoMontana.jpg",
2,"fuerza","mediano",25,1);
insert into razas values
(null,"elfo","Los elfos son un pueblo mágico de gracia sobrenatural, viviendo en el mundo sin ser del todo parte de él. Viven en lugares de etérea belleza, 
en medio de antiguos bosques o en plateados minaretes que resplandecen con luz feérica, donde una suave música flota en el aire y delicadas fragancias son 
transportadas por la brisa. Los elfos aman la naturaleza y la magia, el arte y la maestría, la música y la poesía, y las cosas buenas del mundo.","elfo.jpg",
2,"destreza","mediano",30,null);
insert into razas values
(null,"alto elfo","Como alto elfo, tienes una mente aguda y dominio de al menos lo básico de la magia. En muchos de los mundos de D&D hay dos tipos de altos elfos.
Un tipo (que incluye los elfos grises y elfos de los valles de Greyhawk, los Silvanesti de Dragonlance y los elfos solares de los Reinos Olvidados) son altivos y aislacionistas,
 creyéndose superiores a los no-elfos e incluso al resto de elfos. El otro tipo (incluyendo a los altos elfos de Greyhawk, los Qualinesti de Dragonlance y 
 los elfos lunares de los Reinos Olvidados) son más comunes y más amistosos, y a menudo se les encuentra entre humanos y otras razas.","elfoAlto.jpg",
1,"inteligencia","mediano",30,4),
(null,"elfo del bosque","Como elfo de los bosques, tu intuición y tus sentidos son agudos, y tus pies ligeros pueden transportarte rápida y sigilosamente a través de tus bosques natales. 
Esta categoría incluye a los elfos salvajes (grugach) de Greyhawk y a los Kagonesti de Dragonlance, al igual que a las razas conocidas como elfos de los bosques en Greyhawk y los Reinos Olvidados.","elfoBosque.jpg",
1,"sabiduria","mediano",30,4);

insert into razas values
(null,"gnomo","Un zumbido constante de actividad impregna las madrigueras y vecindarios donde los gnomos forman sus estrechamente unidas comunidades. 
Sonidos más fuertes interrumpen el bullicio: el crujido de ruedas de moler por aquí, una pequeña explosión por allá, un aullido de sorpresa o triunfo y especialmente estallidos de risas. 
Los gnomos se toman la vida con deleite, disfrutando cada momento de invención, exploración, investigación, creación y juego.","gnomo.jpg",
2,"inteligencia","small",25,null);
insert into razas values
(null,"alto elfo","Como alto elfo, tienes una mente aguda y dominio de al menos lo básico de la magia. En muchos de los mundos de D&D hay dos tipos de altos elfos.
Un tipo (que incluye los elfos grises y elfos de los valles de Greyhawk, los Silvanesti de Dragonlance y los elfos solares de los Reinos Olvidados) son altivos y aislacionistas,
 creyéndose superiores a los no-elfos e incluso al resto de elfos. El otro tipo (incluyendo a los altos elfos de Greyhawk, los Qualinesti de Dragonlance y 
 los elfos lunares de los Reinos Olvidados) son más comunes y más amistosos, y a menudo se les encuentra entre humanos y otras razas.","elfoAlto.jpg",
1,"inteligencia","mediano",30,4),
(null,"elfo del bosque","Como elfo de los bosques, tu intuición y tus sentidos son agudos, y tus pies ligeros pueden transportarte rápida y sigilosamente a través de tus bosques natales. 
Esta categoría incluye a los elfos salvajes (grugach) de Greyhawk y a los Kagonesti de Dragonlance, al igual que a las razas conocidas como elfos de los bosques en Greyhawk y los Reinos Olvidados.","elfoBosque.jpg",
1,"sabiduria","mediano",30,4);





select * from clases;

insert into clases values(null,"barbaro","1d12","fuerza",null,"fuerza","constitucion"),(null,"bardo","1d8","carisma",null,"destreza","carisma"),(null,"brujo","1d8","carisma",null,"sabiduria","carisma"),
(null,"clerigo","1d8","sabiduria",null,"inteligencia","sabiduria"),(null,"explorador","1d10","destreza","sabiduria","fuerza","destreza"),
(null,"guerrero","1d10","fuerza","destreza","fuerza","constitucion"),(null,"hechicero","1d6","carisma",null,"constitucion","carisma"),(null,"mago","1d6","inteligencia",null,"inteligencia","sabiduria"),
(null,"monje","1d8","destreza","sabiduria","fuerza","destreza"),(null,"paladin","1d10","fuerza","carisma","sabiduria","carisma"),
(null,"picaro","1d8","destreza",null,"destreza","inteligencia");

select * from trasfondos;

insert into trasfondos values
(null,"acolito","Has pasado tu vida al servicio de un templo para un dios específico o panteón de dioses. Actúas como intermediario entre el reino del mundo sagrado y el mundo mortal, realizando ritos sagrados y ofreciendo sacrificios para llevar a los adoradores a la presencia de lo divino. No es necesariamente un clérigo; realizar ritos sagrados no es lo mismo que canalizar el poder divino.

Elija un dios, un panteón de dioses o algún otro ser cuasi divino, y trabaje con su DM para detallar la naturaleza de su servicio religioso. La sección Gods of the Multiverse contiene un panteón de muestra, del escenario Forgotten Realms. ¿Fue usted un funcionario menor en un templo, criado desde la niñez para ayudar a los sacerdotes en los ritos sagrados? ¿O eras un sumo sacerdote que de repente experimentó un llamado a servir a tu dios de una manera diferente? Quizás eras el líder de un pequeño culto fuera de cualquier estructura de templo establecida, o incluso un grupo oculto que servía a un maestro diabólico que ahora niegas."
,"visión","religion"),
(null,"criminal","Es un criminal experimentado con un historial de infringir la ley. Has pasado mucho tiempo entre otros criminales y todavía tienes contactos dentro del inframundo criminal. Estás mucho más cerca que la mayoría de la gente del mundo de asesinatos, robos y violencia que invade la parte más vulnerable de la civilización, y has sobrevivido hasta este punto burlando las reglas y regulaciones de la sociedad. "
,"engaño","sigilo"),
(null,"soldado","La guerra ha sido su vida desde que quiere recordar. Te entrenaste cuando eras joven, estudiaste el uso de armas y armaduras, aprendiste técnicas básicas de supervivencia, incluido cómo mantenerte con vida en el campo de batalla. Es posible que haya sido parte de un ejército nacional permanente o una compañía de mercenarios, o quizás un miembro de una milicia local que saltó a la fama durante una guerra reciente.

Cuando elija estos antecedentes, trabaje con su DM para determinar de qué organización militar formaba parte, cuánto progresó en sus filas y qué tipo de experiencias tuvo durante su carrera militar. ¿Era un ejército permanente, una guardia de la ciudad o una milicia de la aldea? O podría haber sido el ejército privado de un noble o un comerciante, o una compañía de mercenarios. "
,"atletismo","intimidacion")
;

