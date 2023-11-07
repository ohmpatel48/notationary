<?php
session_start();
$folderid = $_SESSION["folder_id"];
$filename = $_POST["filename"];
$filecontent = $_POST["content"];
$fileid = $_POST["fileid"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notationary";
$conn = new mysqli($servername, $username, $password, $dbname);
$content = $_POST["content"];
$fileid = $_POST["fileid"];

$sql = "UPDATE file SET  contains = '$content' WHERE fileid = $fileid";
$conn->query($sql);
$conn->close();


?>