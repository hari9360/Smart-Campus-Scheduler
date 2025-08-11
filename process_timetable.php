<?php
include 'connection.php'; // Ensure you have a connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $teacher = $_POST['teacher'];
    $venue = $_POST['venue'];

    $sql = "INSERT INTO timetable (date, start_time, end_time, class, subject, teacher, venue) 
            VALUES ('$date', '$start_time', '$end_time', '$class', '$subject', '$teacher', '$venue')";

    if (mysqli_query($conn, $sql)) {
        echo "Timetable entry added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
