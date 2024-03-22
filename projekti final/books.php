<?php
$server = "LAPTOP-84OUBPJ4";
$user = "root";
$password = "";
$db = "Libraria";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getAllBooks() {
    global $conn;
    $sql = "SELECT * FROM book_catalog";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
