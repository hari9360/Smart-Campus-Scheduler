<?php
include 'connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM timetable WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "Timetable entry deleted successfully!";
    header("Location: view_timetable.php"); // Redirect to timetable list
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
