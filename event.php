<?php
session_start();

// Include database connection
include 'connection.php';

// Query to fetch event details
$eventsSql = "SELECT * FROM event WHERE options ='ENABLE' ORDER BY date DESC";
$eventsResult = $conn->query($eventsSql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Events | Time Table Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="event.css" rel="stylesheet" type="text/css" media="all">
    <link href="img/logo.png" rel="icon">
    <style>
        p {
            line-height: 2rem;
        }

        .event-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .event-card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .event-card:hover {
            transform: scale(1.05);
        }

        .event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-card .content {
            padding: 15px;
            text-align: center;
        }

        .event-card h6 {
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #72393f;
        }

        .event-card p {
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: #332d2b;
        }
    </style>
</head>

<body id="top">
    <section>
        <?php include 'sidebar.php'; ?>
    </section>

    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="sectiontitle">
                <h6 class="heading font-x3">EVENTS</h6>
            </div>

            <div class="event-container">
                <?php
                if ($eventsResult->num_rows > 0) {
                    while ($eventRow = $eventsResult->fetch_assoc()) {
                        ?>
                        <div class="event-card">
                            <img src="uploads/<?php echo htmlspecialchars($eventRow['p_image']); ?>" alt="Event image">
                            <div class="content">
                                <h6><?php echo htmlspecialchars($eventRow['name']); ?></h6>
                                <p><strong>Date:</strong> <?php echo htmlspecialchars($eventRow['date']); ?></p>
                                <p><strong>Category:</strong> <?php echo htmlspecialchars($eventRow['catagory']); ?></p>
                                <p><?php echo htmlspecialchars($eventRow['short_description']); ?></p>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No events available.</p>";
                }
                ?>
            </div>
        </main>
    </div>

    <section>
        <?php include 'footer.php'; ?>
    </section>

</body>

</html>
