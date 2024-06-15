
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | Dan Aleko</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    
 
  }
  
 .ddj button:hover{
  cursor:pointer;
  box-shadow: 2px 2px 4px rgba(0,0,0,0.9);
  transition: 1.5ms;
  
 }
 .ddj-button:active{
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
      <button type="submit" onclick="validateLogin()" name=" login_btn"class="btn">Login</button>
     </div>
    </form>
  </div>
  
</body>
</html>
<?php

use function PHPSTORM_META\elementType;

 include("config.php");
 if(isset($_POST["login_btn"])){
  $username = $_POST['username'];
  $password = $_POST['user_pass'];

  $query ="SELECT * FROM user_tbl WHERE username ='$username' AND user_pass ='$password'";
  $data = mysqli_query($conn, $query);
  $total = mysqli_num_rows($data);
  //echo "$total";
  if($total == 1)
  {
    if($username == 'admin' && $password == 1234){
      header("Location: http://localhost/phpmyadmin/index.php?route=/table/create&db=work_reporting");
    }
    $record=mysqli_fetch_assoc($data);
    $u_data =array($record['full_name'],$record['user_des'],
    $record['user_branch'],$record['unique_id'],$record['username']);
    $_SESSION['u_data']=$u_data;
    $role=$record['user_role'];
    
    
    if ($u_data[3] == $record['unique_id']) {
      // Construct the URL for the user's page using their username
      $unique_id = $record['unique_id'];
      header("Location: $unique_id.php");
      exit();
      
    }
   
 }
    if($username == "vipul"&& $password = 1234){
          header("Location: admin_main.php");

    }
    else{
      echo "<script>
      alert('Login failed: Invalid username or password.');
      window.location.href='index.php';
    </script>";
    }
}
  
 
  
 

?>