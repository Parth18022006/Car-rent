DROP DATABASE IF EXISTS CARRENT;

CREATE DATABASE CARRENT;

USE CARRENT;

CREATE TABLE `User`(
    id int AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL DEFAULT 'customer'
);

INSERT INTO `user`(`email`, `password`, `role`) VALUES ('admin@gmail.com','admin12345','admin');

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
    num varchar(20) NOT NULL,
    email varchar(255) NOT NULL,
    renter_name varchar(255) NOT NULL,
    renter_address varchar(255) NOT NULL,
    pickup_place varchar(255) NOT NULL,
    dropoff_place varchar(255) NOT NULL,
    pickup_date varchar(255) NOT NULL,
    pickup_time varchar(255) NOT NULL,
    dropoff_date varchar(255) NOT NULL,
    dropoff_time varchar(255) NOT NULL,
    is_signed TINYINT(1) DEFAULT 0
);

-- ALTER TABLE booking
-- ADD table_name properties
