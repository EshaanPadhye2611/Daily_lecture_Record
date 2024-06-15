<?php
// Include database configuration
include("config.php");

// Query to fetch all faculties' details
$query = "SELECT full_name, user_branch, user_des, unique_id FROM user_tbl WHERE full_name != 'Vipul Dalal'"; // Exclude HOD from the list
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Faculty List</h2>
    <table>
        <tr>
            <th>Full Name</th>
            <th>Branch</th>
            <th>User Description</th>
            <th>Unique ID</th>
        </tr>
        <?php
        // Loop through each faculty and display their details in a table row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['full_name']}</td>";
            echo "<td>{$row['user_branch']}</td>";
            echo "<td>{$row['user_des']}</td>";
            echo "<td>{$row['unique_id']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
