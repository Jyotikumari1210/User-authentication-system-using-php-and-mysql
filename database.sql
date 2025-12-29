Database Details
Database Name: auth_system
Table Name:users


CREATE DATABASE auth_system;

CREATE TABLE users (
' id'INT AUTO_INCREMENT PRIMARY KEY,
'username'VARCHAR(100) NOT NULL,
'password'VARCHAR(255) NOT NULL,
'email' VARCHAR(100) NOT NULL UNIQUE,
);



