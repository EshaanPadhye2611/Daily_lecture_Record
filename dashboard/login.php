<?php

include("config.php");
 // Ensure the session starts at the beginning of the file

if (isset($_POST["login_btn"])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['user_pass']);

    $query = "SELECT * FROM user_tbl WHERE username = ? AND user_pass = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $total = mysqli_num_rows($result);

    if ($total == 1) {
        $record = mysqli_fetch_assoc($result);
        $_SESSION['user_info'] = $record;

        if ($username === "admin" && $password === "1234") {
            header("Location: ITF-02.php");
            exit();
        } elseif ($username === "vipul") {
            header("Location: hod.php");
            exit();
        } else {
            $redirectPage = "profile.php?user=" . urlencode($username);
            header("Location: $redirectPage");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Login failed: Invalid username or password.';
        header("Location: login.php"); // Redirect back to the login page
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | Dan Aleko</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }
  body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(bg.jpeg) no-repeat;
    background-size: cover;
    background-position: center;
  }
  .wrapper{
    width: 420px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(9px);
    color: #fff;
    border-radius: 12px;
    padding: 30px 40px;
  }
  .wrapper h1{
    font-size: 36px;
    text-align: center;
  }
  .wrapper .input-box{
    position: relative;
    width: 100%;
    height: 50px;
    
    margin: 30px 0;
  }
  .input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255, 255, 255, .2);
    border-radius: 40px;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
  }
  .input-box input::placeholder{
    color: #fff;
  }
  .input-box i{
    position: absolute;
    right: 20px;
    top: 30%;
    transform: translate(-50%);
    font-size: 20px;
  
  }
  .wrapper .remember-forgot{
    display: flex;
    justify-content: space-between;
    font-size: 14.5px;
    margin: -15px 0 15px;
  }
  .remember-forgot label input{
    accent-color: #fff;
    margin-right: 3px;
  
  }
  .remember-forgot a{
    color: #fff;
    text-decoration: none;
  
  }
  .remember-forgot a:hover{
    text-decoration: underline;
  }
  .ddj button{
    width: 100%;
    height: 45px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
    transition: box-shadow 0.3s, transform 0.3s;
  }
  
 .ddj button:hover{
  box-shadow: 2px 2px 4px rgba(0,0,0,0.9);
  transition: box-shadow 0.3s, transform 0.3s;
 }
 .ddj button:active{
  transform:translateY(2px);
 }

</style>
<body>
  <div class="wrapper">
    <form action="#" method="POST">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="user_pass" placeholder="Password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div >
     <div class="ddj">
      <button type="submit" onclick="validateLogin()" name="login_btn" class="btn">Login</button>
     </div>
    </form>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $_SESSION['error']; ?>'
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
  </script>
  
</body>
</html>
