<?php
require '../config.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $email = trim($_POST["email"]);
    $password = trim($_POST["psw"]);
    $password_repeat = trim($_POST["psw-repeat"]);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    if ($password !== $password_repeat) {
        echo "Passwords do not match.";
        exit();
    }

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already registered.";
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        
        header("Location: /WS101/pages/login/Login.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
