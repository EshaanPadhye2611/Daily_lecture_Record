<?php
// Include database configuration
include("config.php");

// Include mPDF library
require_once __DIR__ . '/vendor/autoload.php';

function getInstructorName($conn, $instructorId) {
    $query = "SELECT instructor_name FROM lecture_record WHERE instructor_id = '$instructorId'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['instructor_name'];
    }
    return null;
}

// Retrieve the selected date from the form submission
if(isset($_POST['report_btn'])) {
  $selected_date = $_POST['date'];

  // Prepare and execute query to fetch DLR entries for the selected date
  $query = "SELECT * FROM dlr_entry0 WHERE date = '$selected_date'";
  $result = mysqli_query($conn, $query);

  // Check if there are any DLR entries for the selected date
  if(mysqli_num_rows($result) > 0) {
    // Create new PDF document
    $mpdf = new \Mpdf\Mpdf(['format'=> 'A4-L']);

    // Start buffer to capture HTML content
    ob_start();

    // Display fetched DLR entries
    echo "<h2>Daily Lecture Records for $selected_date</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Section Name</th><th>Course Number</th><th>Course Name</th><th>Instructor ID</th><th>Day</th><th>Time</th><th>Assignments Given</th><th>Assignments Collected</th><th>Quizzes Taken</th><th>Assignments Distributed</th><th>Attendance</th><th>Remarks</th></tr>";

    // Loop through each DLR entry and display it in a table row
    while($row = mysqli_fetch_assoc($result)) {
      $instructorName = getInstructorName($conn, $row['instructor_id']);
      $remarks = $row['remarks'];
      $highlight = '';

      // Check if remarks contain an ID and if it is different from the actual instructor's ID
      if (!empty($remarks) && $instructorName) {
          $instructorIdInRemarks = preg_replace('/[^0-9]/', '', $remarks);
          if ($instructorIdInRemarks && $instructorIdInRemarks !== $row['instructor_id']) {
              $highlight = ' style="background-color: red;"';
          }
      }

      echo "<tr>";
      echo "<td>{$row['section_name']}</td>";
      echo "<td>{$row['course_number']}</td>";
      echo "<td>{$row['course_name']}</td>";
      echo "<td>{$row['instructor_id']}</td>";
      echo "<td>{$row['day']}</td>";
      echo "<td>{$row['time']}</td>";
      echo "<td>{$row['assignment_given']}</td>";
      echo "<td>{$row['assignment_collected']}</td>";
      echo "<td>{$row['quiz_taken']}</td>";
      echo "<td>{$row['assignment_distributed']}</td>";
      echo "<td>{$row['attendence']}</td>";

      // Highlight the remarks cell only if it contains an ID different from the instructor's ID
      if (!empty($remarks) && $instructorName) {
          $instructorIdInRemarks = preg_replace('/[^0-9]/', '', $remarks);
          if ($instructorIdInRemarks && $instructorIdInRemarks !== $row['instructor_id']) {
              echo "<td{$highlight}>{$remarks}</td>";
          } else {
              echo "<td>{$remarks}</td>";
          }
      } else {
          echo "<td>{$remarks}</td>";
      }
      echo "</tr>";
    }
    echo "</table>";

    // End buffer and get HTML content
    $html = ob_get_clean();

    // Write HTML content to PDF
    $mpdf->WriteHTML($html);

    // Output PDF as a download
    $mpdf->Output("Daily_Lecture_Records_$selected_date.pdf", 'D');
  } else {
    // If no DLR entries found for the selected date
    echo "<script>
    alert('Empty Records: No Records found for $selected_date.');
    window.location.href='admin_profile.php';
    </script>";
  }
}
?>
