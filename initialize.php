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
    password VARCHAR(255),
    email VARCHAR(100),
    role ENUM('client','restaurant','admin') DEFAULT 'client',
);
CREATE TABLE restaurant (
    id INT NOT NULL PRIMARY KEY,
    resto_name VARCHAR(50),
    email VARCHAR(100),
    telephone int(8),
    facebook VARCHAR(255),
    instagram VARCHAR(255),
    whatsapp VARCHAR(255),

    image VARCHAR(255),
    url VARCHAR(255),
    

    
);
CREATE TABLE client(
    id INT NOT NULL PRIMARY KEY,
    client_name VARCHAR(50),
    email VARCHAR(100),
    telephone int(8),
    image VARCHAR(255),
);
CREATE TABLE commande(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user int(50),
    id_resto int(100),
    req_date DATE.
    end_date DATE,
    status ENUM('pending','preparing','delivering','completed') DEFAULT 'pending',
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
    poster_id INT NOT NULL ,
    
    image1 VARCHAR(255),
    image2 VARCHAR(255),
    image3 VARCHAR(255),




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
    id_resto INT NOT NULL ,
    name VARCHAR(50)
    image varchar(255),

);
CREATE TABLE item(
    id INT AUTO_INCREMENT  PRIMARY KEY,
    menu_id INT NOT NULL,
    
    catagory INT,
    name VARCHAR(50),
    Prix float,
    image VARCHAR(255),



);
CREATE TABLE review(
    id AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255),
    text TEXT,
    id_poster INT,
    id_restaurant INT,
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