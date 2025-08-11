<?php
include('connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = $conn->query("SELECT * FROM event WHERE F_ID = $id");
    $row = $query->fetch_assoc();

    echo "
    <p><strong>Event Name:</strong> {$row['name']}</p>
    <p><strong>Category:</strong> {$row['catagory']}</p>
    <p><strong>Date:</strong> {$row['date']}</p>
    <p><strong>Description:</strong> {$row['description']}</p>
    <img src='uploads/{$row['p_image']}' width='100%'>
    ";
}
?>
