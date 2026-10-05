CREATE DATABASE IF NOT EXISTS `aula12` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `aula12`;

CREATE TABLE estado (
    id      INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome    VARCHAR(60) NOT NULL UNIQUE,
    uf      CHAR(2)     NOT NULL UNIQUE
) ENGINE=INNODB;


CREATE TABLE cidade (
    id      INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome    VARCHAR(60) NOT NULL UNIQUE,
    estado  INT         NOT NULL,
    CONSTRAINT fk_cidade__estado FOREIGN KEY ( estado )
        REFERENCES estado( id ) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB;


INSERT INTO estado ( nome, uf ) VALUES
( 'Rio de Janeiro', 'RJ' ),
( 'São Paulo', 'SP' );