insert into usuarios values(null,'Test','123',null,'test@gmail.com');
insert into usuarios values(null,'Bot','123',null,'Bot@gmail.com'); 

insert into arma values(1,'Garrote','--','Melee','1d4','Contundente',2,'Ligero');
insert into arma values(2,'Daga','20/60','Melee','1d4','Penetrante',1,'Ligero, Arrojadiza');

insert into armadura values(1,'Armadura ligera acolchada','Light armor',11,'True',0,'Desventaja',8);
insert into armadura values(2,'Armadura ligera de cuero','Light armor',11,'True',0,'--',10);

insert into idiomas values('Común','Humanos');
insert into idiomas values('Orco','Orcos');

insert into razas values('Humano','humano simple',1,1,1,1,1,1,20,100,'No concreto','Mediano',30,'Humano');
insert into razas values('Semiorco','orco a medias',2,0,1,0,0,0,14,75,'Caos','Medium',30,'Semiorco');

insert into clase values('Barbaro','Hacha y armadura mediana',0,0);
insert into clase values('Picaro','Daga y armadura ligera de cuero',0,0);
