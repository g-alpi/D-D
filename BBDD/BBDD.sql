drop database if exists dnd;
create database dnd;
use dnd;

-- Informacion de usuarios

create table usuarios (
	id int primary key auto_increment,
	usuario varchar(20),
	password varchar(300),
    fecha_nacimiento date,
	email varchar(100));

-- Informacion de personajes 

create table personajes (
	id int primary key auto_increment,
    nombre varchar(30),
	raza int,
	clase int,
	nivel int,
	experiencia int,
	trasfondo int,
	rasgo int,
	ideales varchar(300),
	vinculos varchar(300),
	defectos varchar(300),
	fuerza int,
	destreza int,
	constitucion int,
	inteligencia int,
	sabiduria int,
	carisma int,
	ruta_imagen varchar(100)
);

-- Relacionamos los usuarios con sus personajes

create table usuarios_personajes (
	id_usuario int,
	id_personaje int
);

alter table usuarios_personajes add foreign key(id_usuario) references usuarios(id);
alter table usuarios_personajes add foreign key(id_personaje) references personajes(id);

-- Tabla de idiomas

create table idiomas (
	id int primary key auto_increment,
	idioma varchar(50)
);

-- Tabla de transfondos

create table trasfondos (
	id int primary key auto_increment,
	nombre varchar(30),
	descripcion varchar(1100),
	habilidad_adicional_1 varchar(20),
	habilidad_adicional_2 varchar(20)
);

-- Relacionamos los personajes con su transfondo

alter table personajes add foreign key (trasfondo) references trasfondos(id);

-- Relacionamos los transfondos con los idiomas que poseen

create table idiomas_trasfondos (
	id_idioma int,
    id_trasfondo int
);

alter table idiomas_trasfondos add foreign key (id_idioma) references idiomas(id);
alter table idiomas_trasfondos add foreign key (id_trasfondo) references trasfondos(id);

-- Tabla habilidades

create table habilidades (
	id int primary key auto_increment,
	habilidad varchar(30)
);

create table habilidades_trasfondos (
	id_habilidad int,
    id_trasfondo int
);

alter table habilidades_trasfondos add foreign key (id_habilidad) references habilidades(id);
alter table habilidades_trasfondos add foreign key (id_trasfondo) references trasfondos(id);

-- Tabla de razas

create table razas ( 
	id int primary key auto_increment,
	nombre varchar(20),
	descripcion varchar(700),
    ruta_imagen varchar(50),
	incremento_estadistica int,
	estadistica_incrementada varchar(20),
	tamano varchar(20),
    vision varchar(50),
	velocidad int,
	id_razaPadre int
);

-- Relacionamos los personajes con su raza

alter table personajes add foreign key (raza) references razas (id);

-- Relacionamos las las razas con su raza padre

alter table razas add foreign key (id_razaPadre) references razas (id);

-- Relacionamos las razas con los idiomas 

create table razas_idiomas (
	id_raza int,
    id_idioma int
);

alter table razas_idiomas add foreign key(id_raza) references razas(id);
alter table razas_idiomas add foreign key(id_idioma) references idiomas(id);


-- Tabla de habilidades raciales

create table habilidadesRaciales (
	id int primary key auto_increment,
	nombre varchar(50),
	descripcion varchar(1000)
);

-- Relacionamos las habilidades raciales con las razas

create table habilidadesRaciales_razas (
	id_habilidadRacial int,
    id_raza int
);

alter table habilidadesRaciales_razas add foreign key(id_habilidadRacial) references habilidadesRaciales(id);
alter table habilidadesRaciales_razas add foreign key(id_raza) references razas(id);

-- Tabla de clases

create table clases(
	id int primary key auto_increment,
	nombre varchar(20),
	DG varchar(4),
	caracteristicaPrimaria1 varchar(20),
	caracteristicaPrimaria2 varchar(20),
	competenciaSalvacion1 varchar(30),
	competenciaSalvacion2 varchar(30),
	armaBase int,
	armaduraBase int,
	POInicial int
);

alter table personajes add foreign key (clase) references clases (id);

create table habilidades_clases (
	id_habilidad int,
    id_clase int
);

alter table habilidades_clases add foreign key (id_habilidad) references habilidades(id);
alter table habilidades_clases add foreign key (id_clase) references clases(id);

-- Tabla competencias

create table competencias (
	id int primary key auto_increment,
	nombre varchar(50)
);

-- Relacionamos las clases con sus competencias

create table competencias_clases (
	id_competencia int,
    id_clase int
);

alter table competencias_clases add foreign key (id_competencia) references competencias (id);
alter table competencias_clases add foreign key (id_clase) references clases (id);

-- Tabla Rasgos

create table rasgos (
	id int primary key auto_increment,
	nombre varchar(50),
	descripcion varchar(1000)
);

alter table personajes add foreign key (rasgo) references rasgos(id);

-- Tabla de habilidades claseas

create table habilidadesClaseas (
	id int primary key auto_increment,
	nombre varchar(50),
	descripcion varchar(1000)
);

create table habilidadesClaseas_clases (
	id_habilidadClasea int,
    id_clase int
);

alter table habilidadesClaseas_clases add foreign key(id_habilidadClasea) references habilidadesClaseas(id);
alter table habilidadesClaseas_clases add foreign key(id_clase) references clases(id);

-- Tabla de hechizos

create table hechizos (
	id int primary key auto_increment,
	nombre varchar(100),
	tipo varchar(30),
	tiempoLanzamiento varchar(30),
	alcance varchar(20),
	componentes varchar(20),
	duracionEnMinutos int, 
	descripcion varchar(1000),
	salvacion varchar(20)
);

-- Relacionamos los conjuros con los que conoce cada personaje

create table hechizos_personajes (
	id_hechizo int,
    id_personaje int
);

alter table hechizos_personajes add foreign key (id_hechizo) references hechizos (id);
alter table hechizos_personajes add foreign key (id_personaje) references personajes (id);

create table hechizosNivel (
	id int primary key auto_increment,
    nivel int,
    trucos int,
    nivel_1 int,
    nivel_2 int,
    nivel_3 int,
    nivel_4 int,
    nivel_5 int,
    nivel_6 int,
    nivel_7 int,
    nivel_8 int,
    nivel_9 int
);

create table clase_hechizosNivel(
	id_clase int,
    id_hechizoNivel int
);

alter table clase_hechizosNivel add foreign key (id_clase) references clases (id);
alter table clase_hechizosNivel add foreign key (id_hechizoNivel) references hechizosNivel (id);

-- Tabla de armas

create table armas (
	id int primary key auto_increment,
	nombre varchar(30),
	rango varchar(10),
	tipo varchar(20),
	dano varchar(4),
	tipo_dano varchar(20),
	peso int,
	costeEnPO int
);

-- Relacionamos a los personajes con las armas que poseen

create table armas_personajes (
	id_arma int,
    id_personaje int
);

alter table clases add foreign key (armaBase) references armas(id);
alter table armas_personajes add foreign key(id_arma) references armas(id);
alter table armas_personajes add foreign key(id_personaje) references personajes(id);

create table propiedadesDeArma (
	id int primary key auto_increment,
	nombre varchar(100),
	descripcion varchar(1000)
);

-- Relacionamos a las armas con sus propiedades

create table propiedadesDeArma_armas (
	id_propiedad int,
    id_arma int
);

alter table propiedadesDeArma_armas add foreign key(id_arma) references armas(id);
alter table propiedadesDeArma_armas add foreign key(id_propiedad) references propiedadesDeArma(id);

-- Tabla armaduras

create table armaduras (
	id int primary key auto_increment,
	nombre varchar(30),
	tipo varchar(20),
	CA int,
	maximoDestreza int,
	fuerza int,
	sigilo varchar(20),
	peso int,
	costeEnPO int
);


-- Relacionamos a los personajes con las armaduras que poseen

create table armaduras_personajes (
	id_armadura int,
    id_personaje int
);

alter table clases add foreign key (armaduraBase) references armaduras(id);
alter table armaduras_personajes add foreign key(id_armadura) references armaduras(id);
alter table armaduras_personajes add foreign key(id_personaje) references personajes(id);

-- Tabla de objetos 

create table objetos (
	id int primary key auto_increment,
	nombre varchar(100),
	descripcion varchar(1000),
	peso int,
	costeEnPO int
);

-- Relacionamos a los personajes con los objetos que poseen

create table objetos_personajes (
	id_objeto int,
    id_personaje int
);

alter table objetos_personajes add foreign key(id_objeto) references objetos(id);
alter table objetos_personajes add foreign key(id_personaje) references personajes(id);