<?php
// Database connection
$link = mysqli_connect("localhost", "root", "", "secret diary", 3307);


if (mysqli_connect_errno()) {
    die("There is a problem connecting to the database");
}
?>