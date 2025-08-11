<?php

include('connection.php'); // ✅ Your proper connection file

if (isset($_GET['update'])) {
    $event_id = intval($_GET['update']);

    // ✅ Fetch Event Data
    $query = $conn->prepare("SELECT * FROM event WHERE F_ID = ?");
    $query->bind_param("i", $event_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
        $existing_image = $event['p_image']; // ✅ Store Old Image
    } else {
        echo "<script>alert('Event not found!'); window.location.href = 'event.php';</script>";
        exit();
    }

    // ✅ Handle Form Submit (Update Event)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // ✅ Handle Event Update
        if (isset($_POST['update'])) {
            $name = $conn->real_escape_string($_POST['name']);
            $date = $conn->real_escape_string($_POST['date']);
            $short_description = $conn->real_escape_string($_POST['short_description']);
            $description = $conn->real_escape_string($_POST['description']);

            // ✅ Handle Image Upload
            $new_image_name = $existing_image; // Default image is existing image

            // ✅ Image Upload Handling
            if (!empty($_FILES["p_image"]["name"])) {
                $targetDir = "uploads/"; // Upload directory
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types
                $fileTmp = $_FILES["p_image"]["tmp_name"];
                $fileSize = $_FILES["p_image"]["size"];
                $fileType = strtolower(pathinfo($_FILES["p_image"]["name"], PATHINFO_EXTENSION));

                // ✅ Validate File Type
                if (!in_array($fileType, $allowedTypes)) {
                    echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.'); window.location.href = 'update_news.php?update=$event_id';</script>";
                    exit();
                }

                // ✅ Validate File Size (Max: 5MB)
                if ($fileSize > 5242880) {
                    echo "<script>alert('File size too large. Maximum allowed size is 5MB.'); window.location.href = 'update_news.php?update=$event_id';</script>";
                    exit();
                }

                // ✅ Generate Unique File Name
                $new_image_name = "event_" . time() . "_" . rand(1000, 9999) . "." . $fileType;
                $targetFile = $targetDir . $new_image_name;

                // ✅ Move File to Upload Folder
                if (move_uploaded_file($fileTmp, $targetFile)) {

                    // ✅ Delete Old Image (If Exists)
                    if (!empty($existing_image) && file_exists("uploads/" . $existing_image)) {
                        unlink("uploads/" . $existing_image);
                    }

                } else {
                    echo "<script>alert('Failed to upload image. Try again.'); window.location.href = 'update_news.php?update=$event_id';</script>";
                    exit();
                }
            }

            // ✅ Update Event Data in Database
            $updateQuery = $conn->prepare("UPDATE event SET name=?, date=?, short_description=?, description=?, p_image=? WHERE F_ID=?");
            $updateQuery->bind_param("sssssi", $name, $date, $short_description, $description, $new_image_name, $event_id);

            if ($updateQuery->execute()) {
                echo "<script>alert('Event updated successfully!'); window.location.href = 'event.php';</script>";
            } else {
                echo "<script>alert('Error updating event!');</script>";
            }
        }

        // ✅ Handle Event Delete
        if (isset($_POST['delete'])) {
            $deleteQuery = $conn->prepare("DELETE FROM event WHERE F_ID=?");
            $deleteQuery->bind_param("i", $event_id);

            if ($deleteQuery->execute()) {
                // ✅ Delete Event Image
                if (!empty($existing_image) && file_exists("uploads/" . $existing_image)) {
                    unlink("uploads/" . $existing_image);
                }
                echo "<script>alert('Event deleted successfully!'); window.location.href = 'event.php';</script>";
            } else {
                echo "<script>alert('Error deleting event!');</script>";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event | Time Table Management</title>
    <link rel="stylesheet" href="event.css">
    <link href="img/logo.png" rel="icon">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { max-width: 600px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h3 { text-align: center; color: #72393f; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; }
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        .btn-container { display: flex; justify-content: space-between; }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-update { background: #3498db; color: #fff; }
        .btn-delete { background: #e74c3c; color: #fff; }
        .btn:hover { opacity: 0.8; }
        .img-preview { display: block; margin: 10px auto; max-width: 100%; border-radius: 8px; }
    </style>
</head>
<body>
<section>
        <?php include 'sidebar.php'; ?>
    </section>
<div class="container">
    <h3>Update Event</h3>
    <form method="POST">
        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required>
        </div>

        <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>
        </div>

        <div class="form-group">
            <label>Short Description:</label>
            <textarea name="short_description" rows="2" required><?php echo htmlspecialchars($event['short_description']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Long Description:</label>
            <textarea name="description" rows="4" required><?php echo htmlspecialchars($event['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Current Image:</label><br>
            <img src="uploads/<?php echo htmlspecialchars($event['p_image']); ?>" alt="Event Image" class="img-preview">
        </div>

        <div class="form-group">
            <label>New Image Name:</label>
            <input type="file" name="p_image" value="<?php echo htmlspecialchars($event['p_image']); ?>" required>
        </div>

        <div class="btn-container">
            <button type="submit" name="update" class="btn btn-update">Update</button>
            <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
        </div>
    </form>
</div>
<section>
        <?php include 'footer.php'; ?>
    </section>
</body>
</html>
