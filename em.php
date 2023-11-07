<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notationary";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$filename = $_POST["filename"];
$folderid = $_SESSION["folder_id"];
$stmt = $conn->prepare("INSERT INTO file (name, folderid) VALUES ( ?, ?)");
$stmt->execute([$filename, $folderid]);
$last_id = $conn->insert_id;
$_SESSION["file_id"] = $last_id;
}
$conn->close();
return;
?>
