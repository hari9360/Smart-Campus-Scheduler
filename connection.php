<?php
 $dbhost = "localhost";
        $dbuser = "traditional";
        $dbpass = "J!a9y12p6";
        $dbname = "tradiona_t";

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8 for proper encoding
$conn->set_charset("utf8");

?>
