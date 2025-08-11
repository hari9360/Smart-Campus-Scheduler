<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($conn->real_escape_string($_POST['name']));
    $date = trim($conn->real_escape_string($_POST['date']));
    $short_description = trim($conn->real_escape_string($_POST['short_description']));
    $description = trim($conn->real_escape_string($_POST['description']));
    $new_image_name = ""; // Default empty image

    // ✅ Image Upload Handling
    if (!empty($_FILES["p_image"]["name"])) {
        $targetDir = "uploads/"; // Upload directory
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // Allowed file types
        $fileTmp = $_FILES["p_image"]["tmp_name"];
        $fileSize = $_FILES["p_image"]["size"];
        $fileType = strtolower(pathinfo($_FILES["p_image"]["name"], PATHINFO_EXTENSION));

        // ✅ Validate file type
        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.'); window.location.href = 'add_event.php';</script>";
            exit();
        }

        // ✅ Validate file size (Max: 5MB)
        if ($fileSize > 5242880) {
            echo "<script>alert('File size too large. Maximum allowed size is 5MB.'); window.location.href = 'add_event.php';</script>";
            exit();
        }

        // ✅ Generate unique file name
        $new_image_name = "event_" . time() . "." . $fileType;
        $targetFile = $targetDir . $new_image_name;

        // ✅ Move uploaded file
        if (!move_uploaded_file($fileTmp, $targetFile)) {
            echo "<script>alert('Error uploading image. Try again.'); window.location.href = 'add_event.php';</script>";
            exit();
        }
    }

    // ✅ Insert event details into the database
    $insertQuery = $conn->prepare("INSERT INTO event (name, date, short_description, description, p_image) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->bind_param("sssss", $name, $date, $short_description, $description, $new_image_name);

    if ($insertQuery->execute()) {
        echo "<script>alert('Event added successfully!'); window.location.href = 'event.php';</script>";
    } else {
        echo "<script>alert('Error adding event!');</script>";
    }
}
?>
