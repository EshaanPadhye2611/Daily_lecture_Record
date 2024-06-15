<?php
include("config.php"); 

if(isset($_GET['instructor_id'])) {
    $instructor_id = mysqli_real_escape_string($conn, $_GET['instructor_id']);
    $sql = "SELECT * FROM dlr_entry0 WHERE instructor_id = '$instructor_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo "<h1>DLR Records</h1>";
        echo "<table border='1' cellspacing='0' cellpadding='10'>";
        echo "<tr>
                <th style='background-color: #007BFF; color: white;'>Section Name</th>
                <th style='background-color: #007BFF; color: white;'>Course Number</th>
                <th style='background-color: #007BFF; color: white;'>Course Name</th>
                <th style='background-color: #007BFF; color: white;'>Day</th>
                <th style='background-color: #007BFF; color: white;'>Date</th>
                <th style='background-color: #007BFF; color: white;'>Time</th>
                <th style='background-color: #007BFF; color: white;'>Assignments Given</th>
                <th style='background-color: #007BFF; color: white;'>Assignments Collected</th>
                <th style='background-color: #007BFF; color: white;'>Quizzes Taken</th>
                <th style='background-color: #007BFF; color: white;'>Assignments Distributed</th>
                <th style='background-color: #007BFF; color: white;'>Attendance</th>
                <th style='background-color: #007BFF; color: white;'>Remarks</th>
              </tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['section_name']}</td>
                    <td>{$row['course_number']}</td>
                    <td>{$row['course_name']}</td>
                    <td>{$row['day']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['time']}</td>
                    <td>{$row['assignment_given']}</td>
                    <td>{$row['assignment_collected']}</td>
                    <td>{$row['quiz_taken']}</td>
                    <td>{$row['assignment_distributed']}</td>
                    <td>{$row['attendence']}</td>
                    <td>{$row['remarks']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found for this instructor.";
    }
} else {
    echo "Instructor ID not provided.";
}
?>
<html>
    <style>
        h1{
            text-align: center;
            justify-content: center;
        }
    </style>
</html>
