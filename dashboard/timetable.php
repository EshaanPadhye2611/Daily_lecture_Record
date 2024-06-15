<?php
include("config.php");
if (!isset($_SESSION['user_info'])) {
    header("Location: login.php"); 
    exit();
}


$userUniqueId = $_SESSION['user_info']['unique_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Schedule Table</title>
<style>
 table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #007BFF; /* Updated color for headers */
        color: white; /* Ensure text is readable against the dark background */
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #e9e9e9; /* Hover color for table rows */
    }
    .button {
        padding: 5px 10px;
        margin-left: 10px; /* spacing between the button and text */
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.6s ease; /* Transition for hover effect */
    }
    .button:hover {
        background-color: #0056b3; 
        transform: scale(1.08);
    }
</style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>Section Name</th>
            <th>Course No</th>
            <th>Course Name</th>
            <th>Instructor ID</th>
            <th>Instructor Name</th>
            <th>Time</th>
            <th>Day</th>
            <th>Date</th>  <!-- Add this line inside <thead> after <th>Day</th> -->
            <th>Action</th> <!-- New header for the button -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch course schedule based on the logged-in user's unique ID
        $sql = "SELECT * FROM lecture_record WHERE instructor_id = '$userUniqueId'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['section_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['course_no']) . "</td>";
                echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['instructor_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['instructor_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                echo "<td>" . htmlspecialchars($row['day']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date']) . "</td>";  
                echo "<td><button class='button' onclick='redirectToDLR(\"" . $row['section_name'] . "\", \"" . $row['course_no'] . "\", \"" . $row['course_name'] . "\", \"" . $row['instructor_id'] . "\", \"" . $row['day'] . "\", \"" . $row['time'] . "\", \"" . $row['date'] . "\")'>Record DLR</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Error: " . mysqli_error($conn) . "</td></tr>";  
        }
        ?>
    </tbody>
</table>
<script>
    function redirectToDLR(sectionName, courseNumber, courseName, instructorId, day, time, date) {
        window.location.href = "dlr_record.php?section_name=" + encodeURIComponent(sectionName) +
            "&course_number=" + encodeURIComponent(courseNumber) +
            "&course_name=" + encodeURIComponent(courseName) +
            "&instructor_id=" + encodeURIComponent(instructorId) +
            "&day=" + encodeURIComponent(day) +
            "&time=" + encodeURIComponent(time) +
            "&date=" + encodeURIComponent(date); 
    }
</script>
</body>
</html>

