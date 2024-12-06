<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../config.php';
    $email = $_POST['email'];
    $password = $_POST['psw'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, hash: $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['message'] = "Login successful!";
            header("Location: ../pages/Welcome/welcome.php");
            exit();
        } else {
            $_SESSION['message'] = "Invalid email or password.";
            header("Location: ../pages/login/Login.php");
            exit();
        }
        
    } else {
        $_SESSION['message'] = "Invalid email or password.";
        header("Location: ../pages/login/Login.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
