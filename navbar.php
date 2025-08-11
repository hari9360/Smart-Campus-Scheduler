<?php
session_start(); // Ensure the session is started

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header('Location: https://projects.traditionaltech.in/hari/login_from.php');
    exit();
}
if (isset($_SESSION['login_user'])) {
list($l_user_name, $l_user_id, $l_user_role) = explode('|', $_SESSION['login_user']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imgs/logo.jpg" rel="icon">
    <title>Traditional Tech</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .Navbar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            height: 100%;
            background-color: #fff;
            border-right: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
        }

        .Navbar .navbar {
            width: 60px;
            background-color: #fff;
            color: #000;
            height: 100%;
            overflow-y: auto; /* Enable vertical scrolling */
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: width 0.3s ease;
            padding-top: 60px;
            z-index: 1000;
        }

        /* Scrollbar customization */
        .Navbar .navbar::-webkit-scrollbar {
            width: 8px; /* Adjust scrollbar width */
        }

        .Navbar .navbar::-webkit-scrollbar-track {
            background: #f1f1f1; /* Scrollbar track color */
        }

        .Navbar .navbar::-webkit-scrollbar-thumb {
            background: #888; /* Scrollbar thumb color */
            border-radius: 10px; /* Rounded edges for the scrollbar thumb */
        }

        .Navbar .navbar::-webkit-scrollbar-thumb:hover {
            background: #555; /* Change thumb color on hover */
        }

        .Navbar .navbar.expanded {
            width: 250px;
        }

        .Navbar .navbar a,
        .Navbar .navbar .dropdown-btn {
            padding: 10px 15px;
            text-decoration: none;
            color: #000;
            display: flex;
            align-items: center;
            width: 100%;
            transition: background 0.3s;
            box-sizing: border-box;
            font-size: 14px;
        }

        .Navbar .navbar a:hover,
        .Navbar .navbar a.active,
        .Navbar .navbar .dropdown-btn:hover {
            background-color: #f1f3f4;
        }

        .Navbar .navbar a img,
        .Navbar .navbar .dropdown-btn img {
            width: 24px;
            height: 24px;
            margin-right: 15px;
            transition: transform 0.3s;
        }

        .Navbar .navbar.expanded a img,
        .Navbar .navbar.expanded .dropdown-btn img {
            transform: translateX(0);
        }

        .Navbar .navbar a span,
        .Navbar .navbar .dropdown-btn span {
            display: none;
            color: #202124;
            white-space: nowrap;
        }

        .Navbar .navbar.expanded a span,
        .Navbar .navbar.expanded .dropdown-btn span {
            display: inline;
        }

        .Navbar .navbar .logout {
            position: absolute;
            bottom: 10px; /* Always keep it at the bottom */
            width: 100%;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }

        .Navbar .navbar .dropdown {
            width: 100%;
        }

        .Navbar .navbar .dropdown-content {
            display: none;
            background-color: #f4f4f4;
            width: 100%;
            padding-left: 30px; /* Indent the dropdown content */
            box-sizing: border-box;
        }

        .Navbar .navbar.expanded .dropdown-content {
            display: block;
        }

        .Navbar .navbar .dropdown-content a {
            padding: 10px 0;
            color: #000;
            text-decoration: none;
            display: block;
            text-align: left;
            font-size: 14px;
        }

        .Navbar .navbar .dropdown-content a:hover {
            background-color: #e7e7e7;
        }

        /* Toggle button outside of the navbar */
        .Navbar .toggle-btn-wrapper {
            position: fixed;
            top: 5px; /* Adjust this value to control vertical positioning */
            left: 5px; /* Adjust this value based on the navbar's width */
            z-index: 1100; /* Ensure it's above the navbar */
            transition: left 0.3s ease; /* Smooth transition when navbar expands/collapses */
            margin: 5px;
        }

        .Navbar .toggle-btn {
            background-color: #f4f4f4;
            color: #000;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            width: 30px; /* Adjust the size of the toggle button */
            height: 30px; /* Make it a square button */
            border-radius: 20%; /* Make it circular */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: Add a slight shadow for depth */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .Navbar .toggle-btn:hover {
            background-color: #e7e7e7;
        }

        .Navbar .toggle-btn img {
            width: 20px;
            height: 20px;
        }

        .Navbar .navbar.expanded ~ .toggle-btn-wrapper {
            left: 260px; /* Adjust this value to match the expanded navbar width */
        }

        @media (max-width: 768px) {
            .Navbar .navbar {
                width: 50px;
                position: absolute;
                left: -50px;
            }

            .Navbar .navbar.expanded {
                width: 200px;
                left: 0;
            }

            .Navbar .toggle-btn-wrapper {
                left: 0px;
            }

            .Navbar .navbar.expanded ~ .toggle-btn-wrapper {
                left: 210px;
            }

            .Navbar .navbar a span,
            .Navbar .navbar .dropdown-btn span {
                font-size: 12px;
            }
            
        }
    </style>
</head>
<body>
<section class="Navbar">
    <div class="toggle-btn-wrapper" id="toggleBtnWrapper">
        <div class="toggle-btn" onclick="toggleNavbar()">
            <img id="toggleIcon" src="https://projects.traditionaltech.in/food/img/open.png" alt="Toggle Button">
        </div>
    </div>
    <div class="navbar" id="navbar" >
        <a href="https://projects.traditionaltech.in/hari/index.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>
            <img src="https://projects.traditionaltech.in/food/img/home.gif" alt="Home">
            <span>Home</span>
        </a>
				
		<?php if (isset($_SESSION['login_user']) && $l_user_role === 'admin') {?>
		
		<a href="https://projects.traditionaltech.in/hari/class/class_list.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'class_list.php') ? 'class="active"' : ''; ?>>
            <img src="https://projects.traditionaltech.in/food/img/stock.gif" alt="Manage Class">
            <span>Manage Class</span>
        </a>
		
		<a href="https://projects.traditionaltech.in/hari/class/create_class.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'create_class.php') ? 'class="active"' : ''; ?>>
            <img src="https://projects.traditionaltech.in/food/img/manage_requests.gif" alt="Add New Class">
            <span>Add New Class</span>
        </a>
	
		<a href="https://projects.traditionaltech.in/hari/class/staff_list.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'staff_list.php') ? 'class="active"' : ''; ?>>
            <img src="https://projects.traditionaltech.in/food/img/users.gif" alt="Manage Staff">
            <span>Manage Staff</span>
        </a>
		<a href="https://projects.traditionaltech.in/hari/class/create_staff.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'create_staff.php') ? 'class="active"' : ''; ?>>
            <img src="https://projects.traditionaltech.in/food/img/users.gif" alt="Manage Staff">
            <span>Add Staff</span>
        </a>
				
		<?php }?>
		
				<?php if (isset($_SESSION['login_user']) && $l_user_role === 'staff') {?>
		
		<a href="https://projects.traditionaltech.in/hari/time_table/timetable.php?id=<?php echo $l_user_id;?>" <?php echo (basename($_SERVER['PHP_SELF']) == 'timetable.php') ? 'class="active"' : ''; ?>>
            <img src="https://projects.traditionaltech.in/food/img/stock.gif" alt="Manage Time Table">
            <span>Manage Time Table</span>
        </a>
		
		<?php }?>
		
		<?php if (isset($_SESSION['login_user'])) {
    // Show Logout if logged in
    echo '
    <a href="https://projects.traditionaltech.in/hari/logout.php">
        <img src="https://projects.traditionaltech.in/food/img/logout.gif" alt="Logout">
        <span>Logout</span>
    </a>';
} else {
    // Show Login if not logged in
    echo '
    <a href="https://projects.traditionaltech.in/hari/login_form.php" ' . ((basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : '') . '>
        <img src="https://projects.traditionaltech.in/food/img/login.gif" alt="Login">
        <span>Login</span>
    </a>';
} ?>
    </div>

</section>
<script>
    const navbar = document.getElementById('navbar');
    const toggleIcon = document.getElementById('toggleIcon');
    let isManuallyToggled = false; // Track if the navbar was manually toggled

    // Function to toggle the navbar open/close state
    function toggleNavbar() {
        isManuallyToggled = !isManuallyToggled; // Toggle the manual toggle flag
        const isExpanded = navbar.classList.toggle('expanded');
        toggleIcon.src = isExpanded ? "https://projects.traditionaltech.in/food/img/close.png" : "https://projects.traditionaltech.in/food/img/open.png";
        localStorage.setItem('sidebar-expanded', isExpanded);
    }

    

    // Add event listeners for dynamic sidebar with hover functionality
    navbar.addEventListener('mouseover', () => {
        if (!isManuallyToggled) {
            navbar.classList.add('expanded');
            toggleIcon.src = "https://projects.traditionaltech.in/food/img/close.png";
        }
    });

    navbar.addEventListener('mouseout', () => {
        if (!isManuallyToggled) {
            navbar.classList.remove('expanded');
            toggleIcon.src = "https://projects.traditionaltech.in/food/img/open.png";
        }
    });

    // Function to toggle dropdown menus
    function toggleDropdown(dropdownId) {
        document.getElementById(dropdownId).parentElement.classList.toggle('active');
    }

    // Auto close navbar if opened manually after mouseout
    navbar.addEventListener('mouseout', () => {
        if (isManuallyToggled && !navbar.classList.contains('expanded')) {
            isManuallyToggled = false;
        }
    });
    
</script>


</body>
</html>
