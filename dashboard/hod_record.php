<?php
// Start the session and include database configuration
include("config.php");

// Retrieve parameters from the GET request
$sectionName = isset($_GET['section_name']) ? $_GET['section_name'] : 'Unknown';
$courseNo = isset($_GET['course_number']) ? $_GET['course_number'] : 'Unknown';
$courseName = isset($_GET['course_name']) ? $_GET['course_name'] : 'Unknown';
$instructorId = isset($_GET['instructor_id']) ? $_GET['instructor_id'] : 'Unknown';
$day = isset($_GET['day']) ? $_GET['day'] : 'Not provided';
$date = isset($_GET['date']) ? $_GET['date'] : 'Not provided';
$time = isset($_GET['time']) ? $_GET['time'] : date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DLR Entry</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], textarea { width: 300px; }
        input[type="submit"] { margin-top: 20px; padding: 10px 20px; font-weight: bold; background-color: #007BFF; color: white; border: none; cursor: pointer; position: relative;top:40px;right: 310px};
        input[type="submit"]:hover { background-color: #007BFF; }
        .button { margin-right: 10px; }
        .readonly { background-color: #f3f3f3; }
    </style>
</head>
<body>
    <h2>DLR Entry Form</h2>
    <form action="" method="post">
        <!-- Read-only Fields -->
        <label for="section_name">Section Name:</label>
        <input type="text" id="section_name" name="section_name" value="<?php echo htmlspecialchars($sectionName); ?>" readonly class="readonly">

        <label for="course_number">Course Number:</label>
        <input type="text" id="course_number" name="course_number" value="<?php echo htmlspecialchars($courseNo); ?>" readonly class="readonly">

        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" value="<?php echo htmlspecialchars($courseName); ?>" readonly class="readonly">

        <label for="instructor_id">Instructor ID:</label>
        <input type="text" id="instructor_id" name="instructor_id" value="<?php echo htmlspecialchars($instructorId); ?>" readonly class="readonly">

        <label for="day">Day:</label>
        <input type="text" id="day" name="day" value="<?php echo htmlspecialchars($day); ?>" readonly class="readonly">

        <label for="time">Time:</label>
        <input type="text" id="time" name="time" value="<?php echo htmlspecialchars($time); ?>" readonly class="readonly">
       
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" readonly class="readonly">
        <!-- Editable DLR Fields -->
        <label for="assignments_given">Assignments Given:</label>
        <input type="text" id="assignment_given" name="assignment_given">

        <label for="assignments_collected">Assignments Collected:</label>
        <input type="text" id="assignment_collected" name="assignment_collected">

        <label for="quizzes_taken">Quizzes Taken:</label>
        <input type="text" id="quiz_taken" name="quiz_taken">

        <label for="assignments_distributed">Assignments Distributed:</label>
        <input type="text" id="assignment_distributed" name="assignment_distributed">

        <label for="attendance">Attendance:</label>
        <input type="text" id="attendence" name="attendence">

        <label for="remarks">Remarks:</label>
        <textarea id="remarks" name="remarks"></textarea>

        <!-- Submit and Update Buttons -->
        <input class="button" type="submit" value="Submit DLR">
        <input class="button" type="submit" name="update_btn" value="Update DLR">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input data
    $section_name = mysqli_real_escape_string($conn, $_POST['section_name']);
    $course_number = mysqli_real_escape_string($conn, $_POST['course_number']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $instructor_id = mysqli_real_escape_string($conn, $_POST['instructor_id']);
    $day = mysqli_real_escape_string($conn, $_POST['day']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $assignment_given = mysqli_real_escape_string($conn, $_POST['assignment_given']);
    $assignment_collected = mysqli_real_escape_string($conn, $_POST['assignment_collected']);
    $quiz_taken = mysqli_real_escape_string($conn, $_POST['quiz_taken']);
    $assignment_distributed = mysqli_real_escape_string($conn, $_POST['assignment_distributed']);
    $attendance = mysqli_real_escape_string($conn, $_POST['attendence']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    if(isset($_POST['update_btn'])) {
        // If Update button is clicked
        // Check if the entry already exists in the database
        $check_sql = "SELECT * FROM dlr_entry0 WHERE section_name = '$section_name' AND course_number = '$course_number' AND course_name = '$course_name' AND instructor_id = '$instructor_id' AND day = '$day' AND date ='$date' AND time = '$time'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // If entry exists, update it
            $update_sql = "UPDATE dlr_entry0 SET assignment_given = '$assignment_given', assignment_collected = '$assignment_collected', quiz_taken = '$quiz_taken', assignment_distributed = '$assignment_distributed', attendence = '$attendance', remarks = '$remarks' WHERE section_name = '$section_name' AND course_number = '$course_number' AND course_name = '$course_name' AND instructor_id = '$instructor_id' AND day = '$day' AND time = '$time'";

            if (mysqli_query($conn, $update_sql)) {
                echo "<script>
                alert('Record Updated: DLR Updated Successfully.');
                window.location.href='hod_record.php';
                </script>";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "<script>
                alert('Record Not Found: Cannot update. Please submit a new entry.');
                </script>";
        }
    } else {
        // If Submit button is clicked
        // Check if the entry already exists in the database
        $check_sql = "SELECT * FROM dlr_entry0 WHERE section_name = '$section_name' AND course_number = '$course_number' AND course_name = '$course_name' AND instructor_id = '$instructor_id' AND day = '$day' AND date ='$date' AND time = '$time'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // If entry exists, notify the user and do not insert a new one
            echo "<script>
                alert('Record Already Exists: Cannot insert. Please update the existing entry.');
                </script>";
        } else {
            // If entry does not exist, insert it
            $insert_sql = "INSERT INTO dlr_entry0 (section_name, course_number, course_name, instructor_id, day,date, time, assignment_given, assignment_collected, quiz_taken, assignment_distributed, attendence, remarks) 
                        VALUES ('$section_name', '$course_number', '$course_name', '$instructor_id', '$day', '$date', '$time', '$assignment_given', '$assignment_collected', '$quiz_taken', '$assignment_distributed', '$attendance', '$remarks')";

            if (mysqli_query($conn, $insert_sql)) {
                echo "<script>
                alert('Record Inserted: DLR Saved Successfully.');
                window.location.href='hod_record.php';
                </script>";
            } else {
                echo "Error inserting record: " . mysqli_error($conn);
            }
        }
    }
}
?>
