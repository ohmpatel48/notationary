<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notationary";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashed_password]);
    $last_id = $conn->insert_id;
    $_SESSION["user_id"] = $last_id;
    header("Location: home.php");
    $conn->close();
    exit;
} else {
    header("Location: signin.html");
    exit;
}
