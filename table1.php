<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE register (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
fullname VARCHAR(100) NOT NULL,
emailid VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
mobile VARCHAR(15),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Users created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
