<?php
include 'connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM timetable WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $teacher = $_POST['teacher'];
    $venue = $_POST['venue'];

    $updateQuery = "UPDATE timetable SET 
                    date='$date', start_time='$start_time', end_time='$end_time',
                    class='$class', subject='$subject', teacher='$teacher', venue='$venue'
                    WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Timetable updated successfully!";
        header("Location: view_timetable.php"); // Redirect after update
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Timetable</title>
	<link rel="stylesheet" href="timetable.css">

</head>
<body>
 <section>
        <?php include 'sidebar.php'; ?>
    </section>
    <h2>Edit Timetable</h2>

    <form method="POST">
        <label>Date:</label>
        <input type="date" name="date" value="<?php echo $row['date']; ?>" required>

        <label>Start Time:</label>
        <input type="time" name="start_time" value="<?php echo $row['start_time']; ?>" required>

        <label>End Time:</label>
        <input type="time" name="end_time" value="<?php echo $row['end_time']; ?>" required>

        <label>Class:</label>
        <input type="text" name="class" value="<?php echo $row['class']; ?>" required>

        <label>Subject:</label>
        <input type="text" name="subject" value="<?php echo $row['subject']; ?>" required>

        <label>Teacher:</label>
        <input type="text" name="teacher" value="<?php echo $row['teacher']; ?>" required>

        <label>Venue:</label>
        <input type="text" name="venue" value="<?php echo $row['venue']; ?>" required>

        <button type="submit">Update</button>
    </form>

</body>
</html>
