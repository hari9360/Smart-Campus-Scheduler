<?php
include('connection.php');

// Get selected month & year (default: current month & year)
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$countryCode = 'IN'; // Country Code for India
$apiUrl = "https://date.nager.at/Api/v2/PublicHoliday/$year/$countryCode";

// Fetch API Data using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL issues (if any)
$response = curl_exec($ch);
curl_close($ch);

// Decode API response
$holidays = json_decode($response, true);

// Define an array to store holidays in the required structure
$specialDays = [];

// Check if API response is valid
if (is_array($holidays)) {
    foreach ($holidays as $holiday) {
        $date = $holiday['date']; // Format: YYYY-MM-DD
        $name = $holiday['localName']; // Holiday Name
        $specialDays[$date] = $name; // Store in structured format
    }
}

// Manually Add Special Days (Festivals & Observances)
$manualSpecialDays = [
    "$year-02-14" => "Valentine's Day",
    "$year-03-08" => "Women's Day",
    "$year-10-31" => "Halloween",
    "$year-04-14" => "Ambedkar Jayanti",
    "$year-04-22" => "Earth Day",
    "$year-05-01" => "Labour Day",
    "$year-08-29" => "National Sports Day",
    "$year-11-14" => "Children's Day",
];

// Merge API holidays with manually defined special days
$specialDays = array_merge($specialDays, $manualSpecialDays);


// Get total days in the month & first day
$totalDays = date('t', strtotime("$year-$month-01"));
$firstDayOfMonth = date('w', strtotime("$year-$month-01"));

// Month names for dropdown
$monthNames = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Event Calendar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .calendar {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }
        .calendar h2 {
            color: #007BFF;
            cursor: pointer;
        }
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .day, .empty {
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            transition: 0.3s;
            cursor: pointer;
            position: relative;
            min-height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        .day {
            background: #007BFF;
            color: white;
        }
        .day:hover {
            background: #0056b3;
        }
        .empty {
            background: transparent;
        }
        .special-day {
            background: #FF5733 !important;
            color: white;
            font-size: 14px;
        }
        .special-day span {
            font-size: 10px;
            display: block;
            margin-top: 5px;
            font-weight: normal;
        }
        .header {
            font-weight: bold;
            margin-bottom: 10px;
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            text-align: center;
        }
        .popup select {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="calendar">
        <div class="nav-buttons">
            <button class="btn btn-primary" onclick="changeDate(<?= $month-1 ?>, <?= $year ?>)">← Previous</button>
            <h2 onclick="openPopup()"><?= $monthNames[$month] ?> <?= $year ?> ⏷</h2>
            <button class="btn btn-primary" onclick="changeDate(<?= $month+1 ?>, <?= $year ?>)">Next →</button>
        </div>

        <div class="header">
            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
        </div>
        
       <div class="days">
    <?php
    for ($i = 0; $i < $firstDayOfMonth; $i++) {
        echo "<div class='empty'></div>";
    }

    for ($day = 1; $day <= $totalDays; $day++) {
        $currentDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
        $isSpecial = isset($specialDays[$currentDate]); // Check if it's a special day
        $class = $isSpecial ? "day special-day" : "day";
        $label = $isSpecial ? htmlspecialchars($specialDays[$currentDate], ENT_QUOTES) : ""; // Escape for safety
        $onclickLabel = $isSpecial ? "'$label'" : "''"; // Ensure JavaScript gets a valid string

        echo "<div class='$class' onclick=\"selectDate('$currentDate', $onclickLabel)\">$day <span>$label</span></div>";
    }
    ?>
</div>

    </div>
</div>

<div class="overlay" id="overlay" onclick="closePopup()"></div>
<div class="popup" id="popup">
    <h3>Select Month & Year</h3>
    <select id="monthSelect"><?php foreach ($monthNames as $num => $name) { echo "<option value='$num'>$name</option>"; } ?></select>
    <select id="yearSelect"><?php for ($y = 2020; $y <= 2030; $y++) { echo "<option value='$y'>$y</option>"; } ?></select>
    <button class="btn btn-success" onclick="applyDateChange()">Apply</button>
</div>

<script>
function changeDate(month, year) { window.location.href = "?month=" + month + "&year=" + year; }
function selectDate(date, label) {
    let eventName = label ? encodeURIComponent(label) : ""; // Encode for URL safety
    window.location.href = "add_details.php?selected_date=" + date + "&name=" + eventName;
}

	function openPopup() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("popup").style.display = "block";

    // Set the currently selected month and year in the dropdown
    let currentMonth = new URLSearchParams(window.location.search).get("month") || new Date().getMonth() + 1;
    let currentYear = new URLSearchParams(window.location.search).get("year") || new Date().getFullYear();

    document.getElementById("monthSelect").value = currentMonth;
    document.getElementById("yearSelect").value = currentYear;
}

function closePopup() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("popup").style.display = "none";
}

function applyDateChange() {
    let selectedMonth = document.getElementById("monthSelect").value;
    let selectedYear = document.getElementById("yearSelect").value;
    changeDate(selectedMonth, selectedYear);
}

</script>

</body>
</html>
