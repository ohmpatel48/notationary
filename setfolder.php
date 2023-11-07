<?php
SESSION_START();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notationary";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $folderid = $_POST['folderid'];
    $sql = "SELECT foldername FROM folder WHERE folderid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$folderid]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION["folder_id"] = $folderid; 
    $_SESSION["folder_name"] = $result['foldername'];
    $fold = $_SESSION["folder_name"];
    
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$response = ["message" => $fold ];
echo json_encode($response);
?>
