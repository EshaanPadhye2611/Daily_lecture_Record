<?php
include("config.php");
 // Start the session at the very beginning
 
 
// Redirect to login if user info is not set in session
if (!isset($_SESSION['user_info'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user_info'];
session_unset(); // Unset all session variables
 session_destroy(); // Destroy the session
 
 // Redirect the user to the login page
 header("Location: login.php");
 
?> 
  
 <!DOCTYPE html>
<html>
<head>
    <title>Page with Background and Navbar</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-image: url('audi.jpeg');
            background-size: cover;
            background-position: center;
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar button {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 17px;
            background-color: #333; /* Same as navbar for consistency */
            border: none; /* Removes the button border */
            cursor: pointer; /* Changes the mouse cursor on hover */
        }
        .navbar button:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>

<div class="navbar">
 <a href="logout.php"><button onclick="location.href='#logout'">Logout</button></a>
  <a href="admin_profile.php"><button onclick="location.href='#checkDailyWork'">Check Daily Work</button></a>
   <a href="add_emp.php"> <button onclick="location.href='#addNewFaculty'">Add New Faculty</button></a>
   <a href="vipul.php"> <button onclick="location.href='#Enter DLR'">Enter DLR</button></a>
</div>

<div id="logout" style="padding:20px; margin-top:30px;">
    
</div>

<div id="checkDailyWork" style="padding:20px; margin-top:30px;">
    
</div>

<div id="addNewFaculty" style="padding:20px; margin-top:30px;">
   
</div>

</body>
</html>
