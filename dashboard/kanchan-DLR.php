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
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
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
    }
    .button:hover {
        background-color: #007BFF;
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
        include("config.php");
        $sql = "SELECT * FROM lecture_record WHERE instructor_id = 'ITF-03'";
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
        echo "<td>" . htmlspecialchars($row['date']) . "</td>";  // Display the date
        echo "<td><button class='button' onclick='redirectToDLR(\"" . $row['section_name'] . "\", \"" . $row['course_no'] . "\", \"" . $row['course_name'] . "\", \"" . $row['instructor_id'] . "\", \"" . $row['day'] . "\", \"" . $row['time'] . "\", \"" . $row['date'] . "\")'>Record DLR</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>Error: " . mysqli_error($conn) . "</td></tr>";  // Adjust colspan to 9
}

        ?>
    </tbody>
</table>
<script>
    function redirectToDLR(sectionName, courseNumber, courseName, instructorId, day, time, date) {
    window.location.href = "rsr_record.php?section_name=" + encodeURIComponent(sectionName) +
        "&course_number=" + encodeURIComponent(courseNumber) +
        "&course_name=" + encodeURIComponent(courseName) +
        "&instructor_id=" + encodeURIComponent(instructorId) +
        "&day=" + encodeURIComponent(day) +
        "&time=" + encodeURIComponent(time) +
        "&date=" + encodeURIComponent(date);  // Add the date parameter
}

</script>
</body>
</html>

