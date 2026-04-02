<?php
$host = "localhost";
$user = "admin";
$pass = "TOnFlores02:10.";
$db   = "account";

// Create connection (without database)
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $db";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists.\n";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($db);

// Set charset
$conn->set_charset("utf8mb4");

// Define table creation statements (one per table)
$tables = [
    "CREATE TABLE user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        password VARCHAR(255),
        email VARCHAR(100),
        type ENUM('client','restaurant','admin') DEFAULT 'client'
    )",

    "CREATE TABLE restaurant (
        id INT NOT NULL PRIMARY KEY,
        name VARCHAR(50),
        email VARCHAR(100),
        telephone INT(8),
        facebook VARCHAR(255),
        instagram VARCHAR(255),
        whatsapp VARCHAR(255),
        image VARCHAR(255),
        url VARCHAR(255)
    )",

    "CREATE TABLE client (
        id INT NOT NULL PRIMARY KEY,
        name VARCHAR(50),
        email VARCHAR(100),
        telephone INT(8),
        image VARCHAR(255)
    )",

    "CREATE TABLE commande (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_user INT,
        id_resto INT,
        req_date DATE,
        end_date DATE,
        status ENUM('pending','preparing','delivering','completed') DEFAULT 'pending'
    )",

    "CREATE TABLE tags (
        id INT NOT NULL PRIMARY KEY,
        mexican BOOLEAN DEFAULT FALSE,
        tunisian BOOLEAN DEFAULT FALSE,
        chinese BOOLEAN DEFAULT FALSE,
        japenese BOOLEAN DEFAULT FALSE,
        frensh BOOLEAN DEFAULT FALSE,
        korean BOOLEAN DEFAULT FALSE,
        asian BOOLEAN DEFAULT FALSE,
        italian BOOLEAN DEFAULT FALSE
    )",

    "CREATE TABLE post (
        id INT AUTO_INCREMENT PRIMARY KEY,
        poster_id INT NOT NULL,
        image1 VARCHAR(255),
        image2 VARCHAR(255),
        image3 VARCHAR(255)
    )",

    "CREATE TABLE vibe (
        id INT NOT NULL PRIMARY KEY,
        romantic INT,
        family INT,
        sports INT,
        cha3bya INT,
        mixt INT,
        street INT,
        high_class INT,
        vibe ENUM('romantic','family','sports','cha3bya','mixt','street','hight class','unclassified') DEFAULT 'unclassified'
    )",

    "CREATE TABLE menu (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_resto INT NOT NULL,
        name VARCHAR(50),
        image VARCHAR(255)
    )",

    "CREATE TABLE item (
        id INT AUTO_INCREMENT PRIMARY KEY,
        menu_id INT NOT NULL,
        catagory INT,
        name VARCHAR(50),
        Prix FLOAT,
        image VARCHAR(255)
    )",

    "CREATE TABLE review (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image VARCHAR(255),
        text TEXT,
        id_poster INT,
        id_restaurant INT
    )",

    "CREATE TABLE catagory (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50),
        image1 VARCHAR(255),
        image2 VARCHAR(255),
        image3 VARCHAR(255)
    )"
];

// Execute each CREATE TABLE
foreach ($tables as $table_sql) {
    if ($conn->query($table_sql) === TRUE) {
        echo "Table created successfully.\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
    }
}

$conn->close();
?>