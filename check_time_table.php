<?php
include("back.html");// Load JSON file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_number = trim($_POST['class_number']);
    $floor_no = trim($_POST['floor_no']);
    $class_incharge = trim($_POST['class_incharge']);

    $files = glob("time_table/files/*.json");
    $found_file = null;
    
    foreach ($files as $file) {
        $data = json_decode(file_get_contents($file), true);
        
        if (
            isset($data['class_no'], $data['floor_no'], $data['class_incharge']) &&
            $data['class_no'] === $class_number &&
            $data['floor_no'] === $floor_no &&
            $data['class_incharge'] === $class_incharge
        ) {
            $found_file = explode('.', $file)[0];

            break;
        }
    }
    
    if ($found_file) {
        header("Location: time_table/view_time_table.php?id=" . urlencode(basename($found_file)));
        exit;
    } else {
        echo "<script>alert('Class not found!'); window.location.href='check_time_table.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Timetable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">Check Timetable</h2>
        <form action="check_time_table.php" method="post" class="mt-4">
            <div class="mb-3">
                <label class="form-label">Class Number</label>
                <input type="text" name="class_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Class Incharge</label>
                <input type="text" name="class_incharge" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Floor Number</label>
                <input type="text" name="floor_no" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Timetable</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
