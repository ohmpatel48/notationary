<?php
session_start();
$foldername = $_SESSION["folder_name"];
    if (isset($_SESSION["user_id"])) {
        $id = $_SESSION["user_id"];
    } else {
        header("Location: signin.html");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Note Making Website</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.14/jodit.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.14/jodit.min.js"></script>
</head>
<body>
  <header>
    
    <div class="left-header">
      <h4>Notationary</h4>
      <nav style="margin-left: 5px">
        <ul>
          <li><a href="#">AI Assistance</a></li>
          <li><a href="#">Pricing</a></li>
          <li><a href="#">About Us</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="side-panel" style="background-color: #4481eb">
      <div class="side-panel-content">
        <div style="display: flex; justify-content: space-around">
          
          <div style="display: flex; flex-wrap: wrap; align-content: center">
            <button class="btn" id="new-file-button" style="background-color: #4481eb"
                  padding: 0px;
                  margin-right:10px;
                  border: none;
                  width: 25px;
                  height: 25px;
                ">
              <img style="width: 100%; height: 100%" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABUElEQVR4nO2Wz0rDQBCHv4u9GDxK8QmkRerFVp9Ra/rnSTx56FOIVfGqPoBioS0qKwu/QqhpuhvHxkMHlizLL7NfZmd2Alv7x+ZKjHugXiWAAx6BA0uAUDOHcCUBHjLPehUA+8DYIhKuJABWEO4XOZBXHZUCuE0ArLItgNseARtOwiaQ6h6YZPycA4d/CVADhsBnQSl+AF1gxxqgBoyknwI9oA3sanSAPjCT5lrvmAEMpX0Cjgp0LeBZ2p4VQFNhn+ZsnuejpUh8AQ0LgFS6NMLHQOt9C4A76U4ifHS0PrYAeJcuiWhKieaTqgD2NH+zAFj8eLQjfJxq/dYC4LIgoVb5WJRtNwQgdMxUYusAjoG5SrdhCeB0ySxDLG/+EnoRxZi/Vq8ykRjonBONM4V9Ls0otB8QCXER0Iz8l5tvnjV/rr713gCvKlOf7T7hfpz5NyuZ/ag3EIF5AAAAAElFTkSuQmCC" />
            </button>
            <p id="Foldername" style="padding :0px;margin: 0px;">
            <?php echo $foldername; ?>
          </p>
          </div>
        </div>
        <input type="text" id="file-name" class="border border-0" style="background-color:white; 
        width:-webkit-fill-available;
        color:black;display:none;" placeholder="Untitled" />
        <ul class="list-group " id="myList">
          <?php 
          if (isset($_SESSION["folder_id"])) {
              $id = $_SESSION["folder_id"];
          } else {
              header("Location: home.php");
              exit;
          }
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "notationary";
          $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $db->prepare("SELECT fileid,name FROM file WHERE folderid = ?");
          $stmt->execute([$id]);
          $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if (!empty($files)) {
              foreach ($files as $file) {
                  echo "<li class='list-group-item border border-0' aria-current='true' id='{$file['fileid']}' style='background-color: transparent;'>{$file['name']}</li>";
              }
          }
          ?>
          </ul>
      </div>
    </div>
    <div id="result"></div>
    <div style="
          flex: 1;
          display: flex;
          flex-direction: column;
          align-items: stretch;
        ">
      <div id="editor"></div>
      <div style="display: flex; justify-content: center; padding-top: 25px">
        <button id="save-button" class="save" >Save</button>
      </div>
    </div>
  </main>
  <script src="script.js"></script>
</body>

</html>