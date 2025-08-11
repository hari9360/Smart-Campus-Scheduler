<?php
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events | Time Table Management</title>
    <link rel="stylesheet" href="event.css">
    <link href="img/logo.png" rel="icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h3 {
            text-align: center;
            color: #72393f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background: #72393f;
            color: #fff;
        }

        table img {
            max-width: 100px;
            border-radius: 5px;
        }

        .action-btn {
            position: relative;
        }

        .action-btn button {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        .action-menu {
            display: none;
            position: absolute;
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .action-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .action-menu a:hover {
            background: #f4f4f4;
        }

        .action-btn:hover .action-menu {
            display: block;
        }

        .btn-delete {
            color: red;
        }

        .status-enable {
            color: green;
        }

        .status-disable {
            color: red;
        }

        /* Modal Design */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            z-index: 9999;
            width: 500px;
        }

        .modal-header {
            font-weight: bold;
        }

        .modal-content {
            margin-top: 10px;
        }

        .close-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            float: right;
        }

        .close-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<section>
    <?php include 'sidebar.php'; ?>
</section>

<div class="container">
    <h3>Manage Events</h3>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Date</th>
                <th>Options</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $conn->query("SELECT * FROM event ORDER BY F_ID DESC");
            while ($row = $query->fetch_assoc()) {
                ?>
                <tr>
                    <td><img src="uploads/<?php echo $row['p_image']; ?>" alt="Event"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['catagory']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['short_description']; ?></td>
                    <td>
                        <?php if ($row['options'] == 'ENABLE') { ?>
                            <span class="status-enable">Active</span>
                        <?php } else { ?>
                            <span class="status-disable">Disabled</span>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="action-btn">
                            <button>⋮</button>
                            <div class="action-menu">
                                <a href="update_event.php?update=<?php echo $row['F_ID']; ?>">✏ Edit</a>
                                <a href="javascript:void(0)" onclick="viewDetails(<?php echo $row['F_ID']; ?>)">👁 View More</a>
           <a href="print_invitation.php?id=<?php echo $row['F_ID']; ?>" target="_blank">Print Invitation</a>
								<a href="javascript:void(0)" onclick="deleteEvent(<?php echo $row['F_ID']; ?>)" class="btn-delete">🗑 Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- ✅ Modal Popup for View More -->
<div class="modal" id="eventModal">
    <h4 class="modal-header">Event Details</h4>
    <div class="modal-content" id="eventContent"></div>
    <button class="close-btn" onclick="closeModal()">Close</button>
</div>

<script>
// ✅ Delete Event with AJAX
function deleteEvent(id) {
    if (confirm("Are you sure you want to delete this event?")) {
        $.ajax({
            url: 'delete_event.php',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                alert("Event deleted successfully.");
                location.reload();
            }
        });
    }
}

// ✅ View More Popup
function viewDetails(id) {
    $.ajax({
        url: 'view_event.php',
        type: 'POST',
        data: {id: id},
        success: function(response) {
            $('#eventContent').html(response);
            $('#eventModal').fadeIn();
        }
    });
}

// ✅ Close Modal
function closeModal() {
    $('#eventModal').fadeOut();
}
</script>

<section>
    <?php include 'footer.php'; ?>
</section>

</body>
</html>
