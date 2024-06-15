<?php include "header.php" ?>
<?php include "footer.php" ?>
<?php
include("config.php");

if (!isset($_SESSION['user_info'])) {
  header("Location: login.php");
  exit();
}

$user = $_SESSION['user_info'];



if(isset($_POST["add_emp"])){
  $full_name =mysqli_real_escape_string($conn, $_POST['full_name']);
  $des = mysqli_real_escape_string($conn, $_POST['user_des']);
  $res =mysqli_real_escape_string($conn, $_POST['unique_id']);
  $branch =mysqli_real_escape_string($conn, $_POST['user_branch']);
  $username =mysqli_real_escape_string($conn, $_POST['username']);
  $pass =mysqli_real_escape_string($conn, $_POST['user_pass']);
  $role =mysqli_real_escape_string($conn, $_POST['user_role']);
  if(strlen($pass) < 4){
    $_SESSION['error'] ="Password must have minimum 4 char long";
    header("Location:add_emp.php");
}
else{
  $sql="SELECT * FROM user_tbl WHERE username = '$username'";
  $query =mysqli_query($conn,$sql);
  $rows= mysqli_num_rows($query);
  if($rows){
    $_SESSION['alert'] = 'Failed to insert data!';
            $_SESSION['alert_type'] = 'error';
}
else{
  $sql="INSERT INTO user_tbl(full_name,user_des,user_branch,unique_id,username,user_pass,user_role) VALUES
  ('$full_name','$des','$branch','$res','$username','$pass','$role')";
  $query =mysqli_query($conn,$sql);
  if($query){
    $_SESSION['alert'] = 'Faculty has been inserted successfully!';
            $_SESSION['alert_type'] = 'success';
  }
}
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body></body>
<div class="container mt-2">
  <form action="" method="POST">
    <div class="row m-2 p-3 register_form border border-secondary">
      <h5 class="text-center">Faculty Registration Form</h5>
      <div class="col-md-5 m-auto">
        <div class="mb-2">
          <label>Fullname</label>
          <input type="text" name="full_name" placeholder="Fullname" class="form-control" required maxlength="30" minlength="3"> </div>
        <div class="mb-2">
          <label>Designation</label>
          <input type="text" name="user_des" placeholder="Designation" class="form-control" required maxlength="30" minlength="3"> </div>
        <div class="mb-2">
          <label>Unique_ID</label>
          <textarea class="form-control"  name="unique_id" maxlength="30" minlength="3"></textarea>
        </div>
      </div>
      <div class="col-md-5 m-auto">
        <div class="mb-2">
          <label>Scale</label>
          <select class="form-control required" name="user_branch">
            <option value="">Select Branch</option>
            <option value="INFT">INFT</option>
            <option value="CMPN">CMPN</option>
            <option value="EXCS">EXCS</option>
            <option value="EXTC">EXTC</option>
            <option value="BIO-MED">BIO-MED</option>
            
          </select>
        </div>
        <div class="mb-2">
          <label>User ID</label>
          <input type="text" name="username" class="form-control" maxlength="30" minlength="4"> </div>
        <div class="mb-2">
          <label>Password</label>
          <input type="password" name="user_pass" class="form-control" maxlength="100" minlength="4"> </div>
        <div class="mb-2">
          <label>User Role</label>
          <select required name="user_role" class="form-control">
            <option value="">Select Role</option>
            <option value="1">Faculty</option>
            <option value="0">admin</option>
          </select>
        </div>
        <div class="mb-2">
          <button class="btn btn-primary" name="add_emp">Register</button> <a href="hod.php" class="btn btn-secondary">Back</a> </div>
      </div>
    </div>
  </form>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_SESSION['alert'])): ?>
                Swal.fire({
                    title: 'Success!',
                    text: '<?php echo htmlspecialchars($_SESSION['alert']); ?>',
                    icon: '<?php echo $_SESSION['alert_type']; ?>',
                    confirmButtonText: 'Ok'
                });
                <?php unset($_SESSION['alert']); unset($_SESSION['alert_type']); ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>

