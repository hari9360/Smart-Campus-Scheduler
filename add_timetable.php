<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Timetable</title>
    <link rel="stylesheet" href="timetable.css"> <!-- Link your CSS -->
</head>
<body>
 <section>
        <?php include 'sidebar.php'; ?>
    </section>
    <h2>Add Timetable</h2>
    
    <form action="process_timetable.php" method="POST">
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" required>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" required>

        <label for="class">Class/Batch:</label>
        <input type="text" id="class" name="class" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="teacher">Teacher:</label>
        <input type="text" id="teacher" name="teacher" required>

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" required>

        <button type="submit">Save Timetable</button>
    </form>

</body>
</html>
