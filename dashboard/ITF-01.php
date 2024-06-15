<?php include("config.php");
if (isset($_SESSION['u_data'])) {
    $user = $_SESSION['u_data'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daily Lecture Record</title>
<style>
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
    .form_1{
        font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
    }

    form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            
            
        }
      
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Welcome to Daily Lecture Record</h1>
        <h2 class="text-center bg-white p-3"> <span class="emp_name"><?= ucwords($user['0'])?></span>
        <br> <span><?=ucwords($user['1'])?> </span> <span><?=ucwords($user['2'])?></span> </h2>
    </header>
</div>
<div class="form_1">
<form action="" method="POST">
        <h2>Section Information Form</h2>
        <div class="form-group">
            <label for="section_id">Section Name:</label>
            <input type="text" id="section_name" name="section_name" required>
        </div>
        <div class="form-group">
            <label for="course_no">Course Number:</label>
            <input type="text" id="course_no" name="course_no" required>
        </div>
        <div class="form-group">
            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" required>
        </div>
        <div class="form-group">
            <label for="instructor_id">Instructor ID:</label>
            <input type="text" id="instructor_id" name="instructor_id" required>
        </div>
        <div class="form-group">
            <label for="instructor_name">Instructor Name:</label>
            <input type="text" id="instructor_name" name="instructor_name" required>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="text" id="time" name="time" required>
        </div>
        <div class="form-group">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>
</div>

        <div class="form-group">
            <label for="day">Day:</label>
            <input type="text" id="day" name="day" required>
        </div>
        
        <button name= "submit_btn"type="submit">Submit</button>
        <a href="rasika-DLR.php"<button name= "DLR_btn"type="Enter DLR">Enter DLR</button>

</form> 
        
        
        
</div>
    </body>
</html>
<?php 
if(isset($_POST["submit_btn"])){
  $section_name =mysqli_real_escape_string($conn, $_POST['section_name']);
  $course_no = mysqli_real_escape_string($conn, $_POST['course_no']);
  $course_name =mysqli_real_escape_string($conn, $_POST['course_name']);
  $instructor_id =mysqli_real_escape_string($conn, $_POST['instructor_id']);
  $instructor_name =mysqli_real_escape_string($conn, $_POST['instructor_name']);
  $time =mysqli_real_escape_string($conn, $_POST['time']);
  $date =mysqli_real_escape_string($conn, $_POST['date']);
  $day =mysqli_real_escape_string($conn, $_POST['day']);
  if(strlen($course_no) > 8){
    
    header("Location:ITF-01.php");
}

else{
  $sql="INSERT INTO lecture_record(section_name,course_no,course_name,instructor_id,instructor_name,time,date,day) VALUES
  ('$section_name','$course_no','$course_name','$instructor_id','$instructor_name','$time','$date','$day')";
  $query =mysqli_query($conn,$sql);
  if($query){
    echo "<script>
    alert('Data Inserted: Successful Data Insertion.');
    window.location.href='ITF-01.php';
  </script>";
  }
}
}
if(isset($_POST["DLR_btn"])){
    header("Location:rasika-DLR.php");
}


?>
