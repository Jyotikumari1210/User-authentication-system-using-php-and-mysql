<?php
$con=mysqli_connect("localhost","root","","auth_system");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>