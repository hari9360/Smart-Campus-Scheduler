<?php
// connection.php

// Check if the Connect() function is already defined
if (!function_exists('Connect')) {
    function Connect()
    {
        $dbhost = "localhost";
        $dbuser = "traditional";
        $dbpass = "J!a9y12p6";
        $dbname = "tradiona_t";

        // Create Connection
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>
