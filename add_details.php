<?php
$selected_date = $_GET['selected_date'] ?? '';
$name = $_GET['name'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png">
    <title>Add Event</title>
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-area {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 30px auto;
        }

        .form-area h3 {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #007BFF;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .file-input {
            border: 2px dashed #007BFF;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            color: #007BFF;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <section>
        <?php include 'sidebar.php'; ?>
    </section>

    <div class="container">
        <div class="col-lg-8 mx-auto">
            <div class="form-area">
                <h3>Add Event Details</h3>
                <form action="add_details1.php" method="POST" enctype="multipart/form-data">
                    
                    <!-- Hidden input to set category -->
                    <input type="hidden" name="catagory" value="event">

                    <div class="mb-3">
                        <label for="name" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?php echo $name; ?>" placeholder="Enter event name" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="date" name="date" 
                               value="<?php echo $selected_date; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" 
                                  placeholder="Enter event description" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" 
                               placeholder="Enter short event description" required>
                    </div>

                    <div class="mb-3">
                        <label for="p_image" class="form-label">Invitation Image</label>
                        <input type="file" class="form-control file-input" id="p_image" name="p_image" required>
                    </div>

                    <div class="mb-3">
                        <label for="options" class="form-label">Visibility</label>
                        <select class="form-control" id="options" name="options" required>
                            <option value="ENABLE">Show</option>
                            <option value="DISABLE">Hide</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Add Event</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <section>
        <?php include 'footer.php'; ?>
    </section>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
