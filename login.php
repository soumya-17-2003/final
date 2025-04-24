<?php
session_start();

// Replace with your DB credentials
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

// Fetch inputs
$email = $_POST['email'];
$pass = $_POST['password'];

// Securely fetch user
$sql = "SELECT * FROM register WHERE emailid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($pass, $row['password'])) {
        // Auth successful, redirect
        $_SESSION['user'] = $row['fullname'];
        header("Location: index.html");
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
