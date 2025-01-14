<?php

if (array_key_exists("submit", $_POST)) {
    include("connection.php");
    $error="";
    if (empty($_POST['email'])) {
    $error .= "Email address is required.";
    }
    if (empty($_POST['password'])) {
    $error .= "Password is required.";
    }
    if ($error != "") {
        $error = "There are error(s) in your form:" . $error;
    } else {
        if ($_POST['Signup'] == '1') { // Sign up logic
            $query = "SELECT id FROM `users` WHERE email = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("s", $_POST['email']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error = "That email address is already taken.";
            } else {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $query = "INSERT INTO `users` (`email`, `password`) VALUES (?, ?)";
                $stmt = $link->prepare($query);
                $stmt->bind_param("ss", $_POST['email'], $hashedPassword);
                if ($stmt->execute()) {
                    $_SESSION['id'] = $stmt->insert_id;
                    if (!empty($_POST['stayLoggedIn'])) {
                        setcookie("id", $_SESSION['id'], time() + 60 * 60 * 24 * 365);
                    }
                    header("Location: logged.php");
                    exit();
                } else {
                    $error = "<p>Could not sign up - please try again.</p>";
                }
            }
        } else { // Log in logic
            $query = "SELECT * FROM `users` WHERE email = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("s", $_POST['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row && password_verify($_POST['password'], $row['password'])) {
                $_SESSION['id'] = $row['id'];
                if (!empty($_POST['stayLoggedIn'])) {
                    setcookie("id", $row['id'], time() + 60 * 60 * 24 * 365);
                }
                header("Location: logged.php");
                exit();
            } else {
                $error = "That email/password combination could not be found.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Secret Diary</title>
    <style>
        .container {
            max-width: 400px;
            text-align: center;
        }
        #homepagecontainer{
            margin-top: 100px;
        }
        #diary{
            width: 100%;
            height: 1000pc;
            margin-top: 80px;
        }
        body {
            background: none;
        }
        html {
            background: url(img1.jpeg) no-repeat center center fixed;
            background-size: cover;
        }
        #log-in {
            display: none;
        }
    </style>
</head>
<body>