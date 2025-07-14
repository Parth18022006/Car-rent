DROP DATABASE IF EXISTS CARRENT;

CREATE DATABASE CARRENT;

USE CARRENT;

CREATE TABLE `User`(
    id int AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
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
    year int,
    ImageFile varchar(255) NOT NULL
);

CREATE TABLE booking(
    id int AUTO_INCREMENT PRIMARY KEY,
    car_id varchar(30) NOT NULL,
    price varchar(20) NOT NULL,
    num int(10),
    email varchar(255) NOT NULL,
    pickup_place varchar(255) NOT NULL,
    dropoff_place varchar(255) NOT NULL,
    pickup_date varchar(255) NOT NULL,
    pickup_time varchar(255) NOT NULL,
    dropoff_date varchar(255) NOT NULL,
    dropoff_time varchar(255) NOT NULL
);
