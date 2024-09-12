DROP DATABASE IF EXISTS BLOG;

CREATE DATABASE IF NOT EXISTS BLOG;

USE BLOG;

CREATE TABLE usuario
(
    id  int AUTO_INCREMENT,
    nome    VARCHAR(100),
    email   VARCHAR(100),
    senha   VARCHAR(050),
    ativo   BOOL,
    id_cidade   INT,
    PRIMARY KEY(id)
);