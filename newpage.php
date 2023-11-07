<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notationary";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$foldername = $_POST["foldername"];
$folderdesc = $_POST["folderdisc"];
$id = $_SESSION["user_id"];
$stmt = $conn->prepare("INSERT INTO folder (foldername, folderdisc, id) VALUES (?, ?, ?)");
$stmt->execute([$foldername, $folderdesc, $id]);
$last_id = $conn->insert_id;
$_SESSION["folder_id"] = $last_id;
$_SESSION["folder_name"] = $foldername;
}
$conn->close();
header("Location: notationary.php");
?>
