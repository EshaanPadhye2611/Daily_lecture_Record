<?php 
include "header.php";
include("config.php");

if (!isset($_SESSION['user_info'])) {
    header("Location: login.php"); 
    exit();
}

$user = $_SESSION['user_info'];
?>

<div class="container mt-5 mb-2">
  <div class="row m-2">
    <div class="col-md-7 m-auto emp_profile p-4 border border-secondary">
      <p class="text-center bg-white p-3">
        <span class="emp_name"><?= ucwords($user['full_name']) ?></span><br>
        <span><?= ucwords($user['user_des']) ?></span>
        <span><?= ucwords($user['user_branch']) ?></span>
        <span><?= ucwords($user['unique_id']) ?></span>
      </p>
      <div class="bg-white p-3">
        <form action="report.php" method="POST">
          <label><strong>Daily Work</strong></label>
          <input type="date" name="date" class="form-control" required>
          <button name="report_btn" class="btn btn-primary mt-2">Report Generate</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php" ?>
