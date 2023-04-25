<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ./auth/login.php');
  exit();
}
$user = $_SESSION['user'];
$user_id = $user['id'];
$fname = $user['first_name'];
include './db/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTED</title>
</head>
<body>
<div class="notes">
<h1>welcome <?php echo $fname;?></h1>
        <a href="./pages/auth/logout.php">logout</a>
    </div>
</body>
</html>