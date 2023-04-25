<?php 
include '../..//db/conn.php';

if(isset($_POST['register'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpass = $_POST['cpass'];
    if(empty($lname) || empty($email) || empty($password) || empty($cpass) || empty($fname) || empty($mname)){
        $err = 'Fill up all the forms!';
    } else if ($password !== $cpass || $cpass !== $password){
        $err = 'Password does not match!';
    } else {
        $emailExist = "select * from child where email='$email'";
        $emailResult = mysqli_query($con, $emailExist);
        if(mysqli_num_rows($emailResult) > 0){
            $err = 'Email already exists!';
        } else {
          $stmt = $con->prepare("insert into child (first_name, middle_name, last_name, email, password) values(?, ?, ?, ?, ?)");
          $stmt->bind_param("sssss", $fname, $mname, $lname, $email, $password);
          $stmt->execute();
          $stmt->close();
            header('location: ./login.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTED</title>
</head>
<body>
<div class="container">
  <h1>Sign up</h1>
  <?php if(!empty($err)): ?>
    <div id='err'><?php echo $err; ?></div>
  <?php endif; ?>
  <form method='post'>
    <Br>
    <label for="">First Name</label>
    <div>
      <input type="text" name='fname' required>
    </div>  
    <label for="">Middle Name</label>
    <div>
      <input type="text" name='mname' required>
    </div>  
    <label for="">Last Name</label>
    <div>
      <input type="text" name='lname' required>
    </div>  
    <label for="">Email</label>
    <div>
      <input type="email" name='email' required>
    </div>  
    <label for="">Password</label>
    <div>
      <input type="password" name='pass' required>
    </div>  
    <label for="">Confirm password</label>
    <div>
      <input type="password" name='cpass' required>
    </div>  
    <br>
    <button name='register'>Sign up</button>
  </form>
  <Br>
  <div>Already signed up? <a href="./login.php">Login</a></div>
</div>
</body>
</html>
