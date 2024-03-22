<?php
if ( isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $host = "localhost";
    $db = "libraria";
    $user = "root";
    $pass = "";
    $connection = new mysqli($host, $user, $pass, $db);

    $sql = "DELETE FROM books WHERE id=$id";
    $connection->query($sql);
    
    header("location: /projekti%20final/Admin.php");
    exit;
}
