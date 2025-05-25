<?php
include 'db.php';

$id = $_GET['id'];

$sql = "UPDATE users SET flag = 1 WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: view.php");
    exit();
} else {
    echo "Delete error: " . $conn->error;
}
?>
