<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notationary";
$id = $_GET["fileid"];
$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $db->prepare("SELECT contains FROM file WHERE fileid = ?");
$stmt->execute([$id]);
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($files)) {
    $ans = $files[0]["contains"];

}
$text = $ans;
echo $text;
?>
