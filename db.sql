CREATE DATABASE `f_agenda` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `f_agenda`;

CREATE TABLE tblEventos(
	id int primary key auto_increment,
	title varchar(255),
	descripcion text,
	color varchar(255),
	start datetime,
	end datetime
);

insert into tblEventos(title,descripcion,color,start,end)
	values 	('Evento 1','cumple de ericka cordova','#3A2FC5','2023-07-08 08:00:00','2023-07-08 17:00:12'),
			('Evento 2','cumple de wendy cordova','#3A2FC5','2023-07-10 07:55:00','2023-07-10 21:10:05'),
			('Aniversario 1','Fecha Civica de La Paz','#2DDCF1','2023-07-16 06:00:00','2023-07-16 15:30:00'),
			('Evento 3','cumple de lenny sandivel','#3A2FC5','2023-07-14 09:15:16','2023-07-14 10:15:00');
