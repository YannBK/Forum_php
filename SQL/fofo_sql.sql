drop database if exists forum;
create database forum;
use forum;

create table users (
	id_users int not null auto_increment primary Key,
    date_user date,
    mail_user varchar(100),
    login_user varchar(50),
    mdp_user varchar(255)
);

create table role (
	id_role int not null auto_increment primary Key,
    nom_role varchar(50)
);

create table sujet(
	id_sujet int not null auto_increment primary Key,
    nom_sujet varchar(50),
    contenu_sujet text,
    date_sujet datetime
);

create table commentaire(
	id_commentaire int not null auto_increment primary Key,
    nom_com varchar(50),
    contenu_com text,
    date_com datetime
);

create table categorie(
	id_categorie int not null auto_increment primary Key,
    nom_cat varchar(50)
);
    
create table appartenir(
	id_sujet int,
    id_categorie int,
    primary key(id_sujet,id_categorie),
    constraint fk_appartenir_sujet foreign key (id_sujet) references sujet(id_sujet),
    constraint fk_appartenir_categorie foreign key (id_categorie) references categorie(id_categorie)
);
    
    
Alter table users
add id_role int,
add constraint fk_users_role foreign key (id_role) references role(id_role);

Alter table sujet
add id_users int,
add constraint fk_sujet_users foreign key (id_users) references users(id_users);

Alter table commentaire
add id_users int,
add id_sujet int,
add constraint fk_commentaire_users foreign key (id_users) references users(id_users),
add constraint fk_commentaire_sujet foreign key (id_sujet) references sujet(id_sujet);

Insert into 
	categorie (nom_cat)
values
	('jeux vidéos'), ('HMLT / CSS'), ('Javascript'),('PHP'), ('MySQL'), ('Cobol');
Insert into 
	role (nom_role)
values 
	('Administrateur'),
    ('Utilisateur');   

Insert into
	users (date_user,mail_user,login_user, mdp_user, id_role)
values
	('1990-05-31','admin@admin.ad','admin','admin',1);

