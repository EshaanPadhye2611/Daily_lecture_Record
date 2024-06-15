<?php
include("config.php");

if (!isset($_SESSION['user_info'])) {
    header("Location: login.php"); // Redirect to login if session is not set
    exit();
}


// Assign user info to $user variable
$user = $_SESSION['user_info'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Databases</title>
    <style>
        /* Apply height to html and body to cover full viewport height */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            color: #333;
        }

        header {
            background: #007BFF;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        /* Style the form and button */
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Aligns the form items vertically */
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Simple shadow for 3D effect */
        }

        button {
            padding: 10px 20px; /* Padding around text */
            font-size: 16px; /* Larger text size */
            color: white; /* White text color */
            background-color: #007BFF; /* Blue background color */
            border: none; /* No border */
            cursor: pointer; /* Cursor indicates button */
            border-radius: 5px; /* Rounded corners */
            transition: transform 0.6s;
            margin-bottom: 10px; /* Add margin at the bottom of the button */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.08); 
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Welcome to Daily Lecture Record</h1>
        <h2 class="text-center bg-white p-3">
            <span class="emp_name"><?= ucwords($user['full_name']) ?></span><br>
            <span><?= ucwords($user['user_des']) ?></span>
            <span><?= ucwords($user['user_branch']) ?></span>
            <span><?= ucwords($user['unique_id']) ?></span>
        </h2>
    </header>
</div>
<form action="http://localhost/phpmyadmin/index.php?route=/database/structure&db=work_reporting" method="post"> <!-- Replace '#' with your actual script -->
    <button type="submit">Access to All Databases</button>
    <a href="logout.php"><button type="button">Logout</button></a>
</form>
</body>
</html>
