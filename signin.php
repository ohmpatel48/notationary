<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notationary";
$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt = $db->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: home.php");
    } else {
        echo '<script>alert("Incorrect userId or password");</script>';
        echo '<script>window.location.href = "signin.html";</script>';
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<body style="background-color: #4481eb;">
</body>
</html>
