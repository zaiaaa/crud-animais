CREATE DATABASE wda_crud;
USE wda_crud;



CREATE TABLE customers (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
name varchar(255) NOT NULL,
cpf_cnpj varchar(14) NOT NULL,
birthdate datetime NOT NULL,
address varchar(255) NOT NULL,
hood varchar(100) NOT NULL,
zip_code varchar(8) NOT NULL,
city varchar(100) NOT NULL,
state varchar(2) NOT NULL,
phone varchar(14) NOT NULL,
mobile varchar(15) NOT NULL,
ie varchar(15) NOT NULL,
created datetime NOT NULL,
modified datetime NOT NULL
);


-- Inserindo dois clientes
INSERT INTO customers (name, cpf_cnpj, birthdate, address, hood, zip_code, city, state, phone, mobile, ie, created, modified)
VALUES
('Fulano de Tal', '123.456.789-00', '1989-01-01', 'Rua da Web, 123', 'Internet', '1234568', 'Teste', 'SP', '5555555', '55555555', '123456',
'2016-05-24 00:00:00', '2016-05-24 00:00:00'),
('Ciclano de Tal', '123.456.789-00', '1989-01-01', 'Rua da Web, 123', 'Internet', '1234568', 'Teste', 'MG', '5555555', '55555555', '123456',
'2016-05-24 00:00:00', '2016-05-24 00:00:00');

CREATE TABLE usuarios(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    nome varchar(50) not null,
    user varchar(50) not null,
    password varchar(100) not null,
    foto varchar(50) );
 


INSERT INTO `usuarios`(`nome`, `user`, `password`)
VALUES ('Zé Lele','zelele','5243897562837456982'),
('Mary Zica','mazi','786098767869'),
('Fugiru Nakombi','fugina','623485634753234');

CREATE TABLE animal(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome varchar(50),
    tutor varchar(50),
    tipo varchar(25),
    dataNasc DATE,
    foto varchar(69)
);