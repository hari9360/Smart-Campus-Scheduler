<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM event WHERE F_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Event not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Invitation - <?php echo $row['name']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #72393f;
        }
        .event-image {
            text-align: center;
            margin-bottom: 20px;
        }
        .event-image img {
            max-width: 300px;
            border-radius: 5px;
        }
        .details {
            line-height: 1.8;
        }
        .details strong {
            font-size: 18px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer p {
            font-style: italic;
            color: #666;
        }
        .print-btn {
            text-align: center;
            margin-top: 20px;
        }
        .print-btn button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-btn button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body onload="window.print();">

<div class="container">
    <h2><?php echo $row['name']; ?></h2>
    <div class="event-image">
        <img src="uploads/<?php echo $row['p_image']; ?>" alt="Event Image">
    </div>
    <div class="details">
        <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
        <p><strong>Short Description:</strong> <?php echo $row['short_description']; ?></p>
        <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
    </div>
    <div class="footer">
        <p><strong>Thank you for being a part of our event!</strong></p>
    </div>
</div>

<!-- This will auto-open the print dialog -->
<script>
    setTimeout(() => {
        window.print();
        window.close();
    }, 1000);
</script>

</body>
</html>
