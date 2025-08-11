<?php
include 'connection.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=timetable_export.xls");

echo "Date\tStart Time\tEnd Time\tClass\tSubject\tTeacher\tVenue\n";

$sql = "SELECT * FROM timetable";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "{$row['date']}\t{$row['start_time']}\t{$row['end_time']}\t{$row['class']}\t{$row['subject']}\t{$row['teacher']}\t{$row['venue']}\n";
}
?>
