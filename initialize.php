<?php
//bech n3aytelha marra barka , to create all the data bases at once
$host="localhost";
$user="rooy";
$pass="";
$db="account";



// Create connection (do not specify a database name yet)
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    role ENUM('client','restaurant','admin') DEFAULT 'client'
);
CREATE TABLE restaurant (
    id INT NOT NULL PRIMARY KEY,
    rest_name VARCHAR(50),
    email VARCHAR(100),
    url varchar(255),
    password VARCHAR(255),

    
);

CREATE TABLE tags (
    id INT NOT NULL PRIMARY KEY,
    mexican BOOLEAN DEFAULT FALSE,
    tunisian BOOLEAN DEFAULT FALSE,
    chinese BOOLEAN DEFAULT FALSE,
    japenese BOOLEAN DEFAULT FALSE,
    frensh BOOLEAN DEFAULT FALSE,
    korean BOOLEAN DEFAULT FALSE,
    asian BOOLEAN DEFAULT FALSE,
    italian BOOLEAN DEFAULT FALSE,
    
    
);
CREATE TABLE post(
    id AUTO_INCREMENT PRIMARY KEY,
    user_id INT,



);
CREATE TABLE vibe (
    id INT NOT NULL PRIMARY KEY,
    romantic int,
    family int,
    sports int,
    cha3bya int,
    mixt int,
    street int,
    hight class int,
    

    vibe ENUM('romantic','family','sports','cha3bya','mixt','street','hight class','unclassified') DEFAULT 'unclassified',
    
    
);
CREATE TABLE menu(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);
CREATE TABLE item(
    menu_id INT NOT NULL PRIMARY KEY,
    id INT AUTO_INCREMENT ,
    catagory INT,
    name VARCHAR(50),
    Prix float,


);

CREATE TABLE catagory(
    id AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),

    image1 VARCHAR(255),
    image2 VARCHAR(255),
    image2 VARCHAR(255),
);


";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();