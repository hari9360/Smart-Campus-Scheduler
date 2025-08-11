<?php
include 'connection.php'; // Database connection

// Initialize filters & sorting
$search = isset($_GET['search']) ? $_GET['search'] : "";
$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : "";
$sort = isset($_GET['sort']) ? $_GET['sort'] : "date ASC"; // Default sorting
$limit = 10; // Records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total records for pagination
$total_query = "SELECT COUNT(*) FROM timetable WHERE 1=1";
if (!empty($search)) {
    $total_query .= " AND (class LIKE '%$search%' OR subject LIKE '%$search%' OR teacher LIKE '%$search%')";
}
if (!empty($filter_date)) {
    $total_query .= " AND date = '$filter_date'";
}
$total_result = mysqli_query($conn, $total_query);
$total_rows = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_rows / $limit);

// Query with filters, sorting, and pagination
$sql = "SELECT * FROM timetable WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (class LIKE '%$search%' OR subject LIKE '%$search%' OR teacher LIKE '%$search%')";
}
if (!empty($filter_date)) {
    $sql .= " AND date = '$filter_date'";
}

$sql .= " ORDER BY $sort LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Timetable</title>
    <link rel="stylesheet" href="timetable.css"> <!-- Link CSS -->

</head>
<body>
          <section>
        <?php include 'sidebar.php'; ?>
    </section>
    <h2>View Timetable</h2>

    <!-- Search & Filter Form -->
    <form method="GET" action="view_timetable.php">
        <input type="text" name="search" placeholder="Search Class, Subject, Teacher" value="<?php echo $search; ?>">
        <input type="date" name="filter_date" value="<?php echo $filter_date; ?>">
        <select name="sort">
            <option value="date ASC" <?php if ($sort == "date ASC") echo "selected"; ?>>Date (Oldest First)</option>
            <option value="date DESC" <?php if ($sort == "date DESC") echo "selected"; ?>>Date (Newest First)</option>
            <option value="start_time ASC" <?php if ($sort == "start_time ASC") echo "selected"; ?>>Time (Earliest First)</option>
            <option value="start_time DESC" <?php if ($sort == "start_time DESC") echo "selected"; ?>>Time (Latest First)</option>
        </select>
        <button type="submit">Search</button>
        <a href="view_timetable.php"><button type="button">Reset</button></a>
    </form>

    <a href="export_timetable.php"><button>Export to Excel</button></a>

    <table>
        <tr>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Class</th>
            <th>Subject</th>
            <th>Teacher</th>
            <th>Venue</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['start_time']; ?></td>
                <td><?php echo $row['end_time']; ?></td>
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['teacher']; ?></td>
                <td><?php echo $row['venue']; ?></td>
                <td>
                    <a href="edit_timetable.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="delete_timetable.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="view_timetable.php?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
        <?php } ?>
    </div>

</body>
</html>
