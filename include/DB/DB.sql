DROP DATABASE IF EXISTS CARRENT;

CREATE DATABASE CARRENT;

USE CARRENT;

CREATE TABLE `User`(
    id int AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL DEFAULT 'customer'
);

CREATE TABLE CAR(
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    price int,
    review int,
    space int,  
    gas varchar(255) NOT NULL,  
    year int
);

ALTER TABLE CAR
ADD ImageFile varchar(255) NOT NULL;