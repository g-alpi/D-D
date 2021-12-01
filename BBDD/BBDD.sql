drop database dnd;
create database dnd;
use dnd;

create table usuarios(
id_user int primary key auto_increment,
login_usuario varchar(20),
passwd varchar(300),
correo varchar(100));

create table fichas(
id_user int,
id_personaje int
);



/*informacion personaje*/

create table personaje (
id_personaje int primary key auto_increment,
raza varchar(20),
clase varchar(20),
trasfondo varchar(30),
fuerza int,
destreza int,
constitucion int,
inteligencia int,
sabiduria int,
carisma int,
rasgos_personalidad varchar(300),
ideales varchar(300),
vinculos varchar(300),
defectos varchar(300),
idioma varchar(50),
armadura varchar(50),
arma varchar(50),
hechizos varchar(1000)

);
create table idiomasPersonaje(
id_personaje int,
idioma varchar(50)
);

create table trasfondo(
nombre varchar(30) primary key,
descripcion varchar(500),
idiomas_disponibles int,
bonus_skill_1 varchar(20),
bonus_skill_2 varchar(20)
);
alter table personaje add foreign key (trasfondo)references trasfondo(nombre);


/*tabla habilidades*/
create table habilidades(
id_personaje int primary key auto_increment,
acrobacias int,
arcanos int,
atletismo int,
engano int,
historia int,
interpretacion int,
intidmidacion int,
investigacion int,
juego_de_manos int,
medicina int,
naturaleza int,
percepcion int,
perspicacia int,
persuasion int,
religion int,
sigilo int,
supervivencia int,
trato_animales int
);

/*tabla con todas las razas*/
create table razas ( 
nombre varchar(20) primary key ,
desciption varchar(300),
fuerza int,
destreza int,
constitucion int,
inteligencia int,
sabiduria int,
carisma int,
edad_adulta int,
esperanza_vida int,
alinamiento varchar(1000),
tamano varchar(20),
velocidad int,
raza_principal varchar(30)
);
alter table personaje add foreign key (raza) references razas (nombre);


/*Definicion de tablas para cada raza*/
create table rasgo_raza(
id_rasgo int primary key auto_increment,
raza varchar(20),
nombre_rasgo varchar(20),
descripcion varchar(200)
);



/*tabla de clase*/
create table clase(
clase varchar(20) primary key,
equipo_inicial varchar(200),
trucos_conocidos int,
conjuros_conocidos int);

/*tablas competencias y rasgos*/
create table competencias_clase(
clase varchar(30),
armadura varchar(30),
armas varchar(30),
herraminetas varchar(30)
);
create table rasgo_clase(
clase varchar(30),
rasgo varchar(50),
descripcion varchar(100)
);
/*tablas de habilidades de clase*/
create table habilidad_clases(
clase varchar(30),
habilidad varchar(50) primary key,
descripcion varchar(1000)
);
alter table habilidad_clases  add foreign key (clase) references clase (clase);
alter table rasgo_clase  add foreign key (clase) references clase (clase);
alter table competencias_clase  add foreign key (clase) references clase (clase);

/*tabla hechizos*/
create table hechizos(
hechizo varchar(100) primary key,
clase varchar(30),
descripcion varchar(1000)
);
alter table hechizos add foreign key (clase) references clase (clase);


/*tabla de idiomas*/
create table idiomas(
idioma varchar(50) primary key,
hablante_habitual varchar(20));

alter table idiomas add foreign key (hablante_habitual) references razas(nombre);

/*tabla de armas*/

create table arma(
id_arma int primary key auto_increment,
nombre varchar(30),
rango varchar(10),
tipo varchar(20),
dano varchar(4),
tipo_dano varchar(20),
peso int,
porpiedades varchar(100)
);
create table propiedades_arma(
id_propiedad int primary key auto_increment,
id_arma int,
porpiedad varchar(100)
);

/*Tablas armaduras*/
create table armadura(
id_idioma int primary key auto_increment,
nombre varchar(30),
tipo varchar(20),
blindaje int,
modificador varchar(20),
fuerza int,
sigilo varchar(10),
peso int
);

/*Tabla de objetos*/
create table objetos (
id_objeto int primary key auto_increment,
nombre varchar(100),
peso int
);

/*Relacionamos los usuarios con sus personajes*/
alter table fichas add constraint fk_fichas_usuarios foreign key(id_user) references usuarios(id_user);
alter table fichas add constraint fk_fichas_personaje foreign key(id_personaje) references personaje(id_personaje);
/*Relacionamos la tabla personaje con sus habilidades*/
alter table personaje add constraint fk_personaje_habilidades foreign key(id_personaje) references habilidades(id_personaje);	
/*relazionamos razas con sus rasgos*/
alter table rasgo_raza add constraint fk_rasgos_raza foreign key (raza) references razas(nombre);
/*realazionamos las armas con sus propiedades*/
alter table propiedades_arma add constraint fk_poriedad_armas foreign key (id_arma) references arma (id_arma);

alter table idiomasPersonaje add foreign key (id_personaje) references personaje(id_personaje) ;
alter table idiomasPersonaje add foreign key (idioma) references idiomas(idioma);




