<?php 
session_start(); // Ensure the session is started
if (isset($_SESSION['login_user'])) {
include("navbar.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Timetable Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .index_container {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #2c3e50;
        }
        .index_container .container {
            max-width: 900px;
            margin: auto;
            padding: 40px;
            text-align: center;
        }
        .index_container .hero {
            background: #ffffff;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }
        .index_container .btn-primary, .btn-secondary {
            border-radius: 30px;
            padding: 12px 20px;
            font-size: 1rem;
        }
        .index_container .features {
            margin-top: 40px;
        }
        .index_container .feature-box {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .index_container .faq {
            margin-top: 50px;
        }
        .index_container .footer {
            margin-top: 50px;
            padding: 20px;
            background: #192A56;
            color: #ffffff;
            text-align: center;
        }
    </style>
</head>
<body>
	
<section class="index_container">
    <div class="container">
        <div class="hero">
            <h1>Welcome to College Timetable Management Software</h1>
            <p>Effortlessly manage class schedules, faculty assignments, and student timetables with our easy-to-use system.</p>
			<?php if (!isset($_SESSION['login_user'])) {?>
			<a href="login_form.php" class="btn btn-primary">Login</a>
			<?php }?>
            <a href="check_time_table.php" class="btn btn-secondary">Check Timetable</a>
        </div>
        
              <div class="features">
            <h2>Why Choose Our Timetable Management System?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-school fa-2x"></i>
                        <h4>Admin-Controlled Class Creation</h4>
                        <p>Admins can define classrooms with floor numbers and capacity for better organization.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-user-tie fa-2x"></i>
                        <h4>Staff Registration & Permissions</h4>
                        <p>Admins assign teachers, allowing controlled timetable modifications for staff.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                        <h4>Timetable Creation & Editing</h4>
                        <p>Only assigned staff and admins can edit related schedules, ensuring security.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-exchange-alt fa-2x"></i>
                        <h4>Real-time Class Reallocation</h4>
                        <p>Admins can adjust classroom schedules instantly to avoid conflicts.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-bell fa-2x"></i>
                        <h4>Instant WhatsApp Notifications</h4>
                        <p>Automated updates notify students & staff instantly via WhatsApp.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-users fa-2x"></i>
                        <h4>Student Timetable Access</h4>
                        <p>Students can check schedules using Class Number & Staff Name.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq">
            <h2>Frequently Asked Questions</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            How can the timetable be modified?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            Only authorized <strong>Admin</strong> and <strong>Assigned Staff</strong> can edit timetable entries related to them.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Can students check their schedules?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Yes! Students can <strong>search by class number</strong> and <strong>staff name</strong> to view the latest updates.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            What happens if a class is reallocated?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            The system <strong>automatically updates</strong> schedules and notifies students via WhatsApp messages.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>&copy; <?php echo date("Y"); ?> College Timetable Management. All rights reserved.</p>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</section>
</body>
</html>