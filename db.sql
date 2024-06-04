create database db;
use db;

create table users(
	id integer primary key auto_increment,
    nome varchar(255) not null,
    cognome varchar(255),
    data_nascita varchar(255) not null,
    username varchar(50) not null unique,
    email varchar(255) not null unique,
    password varchar(255)not null
    );

create table preferiti(
	id integer primary key auto_increment,
    user_id integer not null,
	foreign key (user_id) references users(id),
    image_id varchar(255),
    content json
)	
        