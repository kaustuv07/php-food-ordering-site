<?php
session_start();
define("SITEURL","http://localhost/SnackPack/");
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Default username for XAMPP MySQL is 'root'
$password = ""; // Default password for XAMPP MySQL is empty
$database = "snackpack"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}