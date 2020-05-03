<?php


define("SERVER_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "root");
define("DB_NAME", "db_safefoodph");

$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>