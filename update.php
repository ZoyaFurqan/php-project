<?php
session_start();

if (array_key_exists("content", $_POST)) {
    include("connection.php");

    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if (!isset($_SESSION['id'])) {
        die("Session error: User not logged in.");
    }

    $query = "UPDATE `users` SET `diary` = ? WHERE `id` = ? LIMIT 1";

    $stmt = $link->prepare($query);
    if ($stmt === false) {
        die("Query preparation failed: " . $link->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("si", $_POST['content'], $_SESSION['id']);
    if ($stmt->execute()) {
        echo "Success";
    } else {
        die("Query execution failed: " . $stmt->error);
    }

    $stmt->close();
    $link->close();
}
?>
