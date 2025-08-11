<?php
include('connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = $conn->prepare("DELETE FROM event WHERE F_ID = ?");
    $query->bind_param("i", $id);
    $query->execute();

    echo "success";
}
?>
