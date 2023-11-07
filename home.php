<?php
    session_start();
    if (isset($_SESSION["user_id"])) {
        $id = $_SESSION["user_id"];
    } else {
        header("Location: signin.html");
        exit;
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>NOTATIONARY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar bg-primary" data-bs-theme="dark" style="justify-content: flex-start;">
            <a class="navbar-brand" href="#">
                Notationary
            </a>
            <button class="btn" style="">About Us</button>
            <button class="btn" >Log out</button>
    </nav>
    <div class="container " id="container">
        <div class="row mt-5 row-cols-4">
            <div class="col">
                <div class="card w-75 shadow" style="height: 12rem;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class='card-title mb-3'>Add new folder</h5>
                        <button class="btn btn-primary rounded-circle bold shadow" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button>
                    </div>
                </div>
            </div>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "notationary";
            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT folderid,foldername,folderdisc FROM folder WHERE id = ?");
            $stmt->execute([$id]);
            $folders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($folders)) {
                foreach ($folders as $folder) {
                    echo "<div class='col' id='{$folder['folderid']}'>
                            <div class='card w-75 shadow'style='height: 12rem;'>
                                <div class='card-body d-flex flex-column justify-content-center '>
                                    <h5 class='card-title align-items-center'>{$folder['foldername']}</h5>
                                    <p class='card-text align-items-start'>{$folder['folderdisc']}.</p>
                                    <button class='btn btn-primary rounded-2 align-items-center' id='open'>open</button>
                                </div>
                            </div>
                        </div>";
                }
            }
            ?>
        </div>
    </div>
    <div class="modal bg-light bg-opacity-25 " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Folder Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="newpage.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="foldername" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="foldername" name="foldername">
                        </div>
                        <div class="mb-3">
                            <label for="folderdisc" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="folderdisc" name="folderdisc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const dialog = document.getElementById("myDialog");
        const container = document.getElementById("container");
        document.getElementById("open").addEventListener("click", function() {
            var grandparent = this.parentElement.parentElement.parentElement;
            var grandparentId = grandparent.id;
            var xhr = new XMLHttpRequest();
            var url = "setfolder.php";
            xhr.open("POST", url, true);
            var data = "folderid="+grandparentId;
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    console.log(response);
                }
            };
            xhr.send(data);
            window.location.href = "notationary.php";
        });

        function showDialog() {
            container.style.filter = "blur(2px)";
            dialog.show();
        }

        function closeDialog() {
            dialog.close();
        }
    </script>
</body>

</html>