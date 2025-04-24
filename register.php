<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password is empty for XAMPP
$dbname = "platform"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $fullname = $_POST['name'] ?? '';
    $emailid = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';
    $mobile = $_POST['phone'] ?? '';

    // Validate input
    if (empty($fullname) || empty($emailid) || empty($password) || empty($mobile)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO register (fullname, emailid, password, mobile) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $fullname, $emailid, $password, $mobile);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the connection
$conn->close();
?>