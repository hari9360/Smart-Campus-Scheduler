<?php
include("db_connect.php");
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = Connect();

    // Escape special characters in form inputs
    $u_id = mysqli_real_escape_string($conn, $_POST['u_id']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
    
    $stmt = $conn->prepare("SELECT class_id, password, role FROM teachers WHERE mobile = ?");
    $stmt->bind_param("s",  $u_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Compare the entered password with the hashed password in the database
        if ($mypassword === $row['password']) {
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);
$class_staff_id = $row['class_id'];
            // Store the role in the session
            $_SESSION['login_user'] = $row['name'] . '|' . $class_staff_id . '|' . $row['role'];
            $role = $row['role'];
            
if($role === 'admin'){
    header("location: class/class_list.php");
            exit();
}else{
            header("location: time_table/timetable.php?id=$class_staff_id");
            exit();
}
        } else {
            $error = "Your User Name or Password is invalid";
        }
    } else {
        $error = "Your Login Name or Password is invalid";
    }

    // If there's an error, store it in the session and redirect back to login page
    if (!empty($error)) {
        $_SESSION['error'] = $error;
        header("location: login_from.php");
        exit();
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
