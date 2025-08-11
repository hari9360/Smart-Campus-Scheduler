<link rel="stylesheet" href="styles.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="sidebar" id="sidebar">
    <div class="toggle-btn" onclick="toggleSidebar()">
        ☰
    </div>
    <div class="logo">
        <a href="index.php"><img src="img/logo.png" alt="Logo"></a>
    </div>
    <ul>
        <li><a href="add_details.php">Add Event</a></li>
        <li><a href="event.php">View Events</a></li>
        <li><a href="manage_event.php">Manage Event</a></li>
		<li><a href="add_timetable.php">Add Timetable</a></li>
		<li><a href="view_timetable.php">view Timetable</a></li>
    </ul>
</div>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("open");
    }
</script>
