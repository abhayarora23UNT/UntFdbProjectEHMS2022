<?php
include_once '../../../DATABASE/connection.php';

if (!empty($_POST['Name'])&& !empty($_POST['Email'])) {

  $Name=$_POST['Name'];
  $Email=$_POST['Email'];

  $sql="SELECT * FROM table_pharmacist WHERE Name='$Name' AND  Email='$Email'";

  $query = mysqli_query($conn,$sql);

if($query){

$rowCount = mysqli_num_rows($query);

if($rowCount != 0){

  $result = mysqli_fetch_array($query);
  $username=strtolower($Name);
  $useremail=strtolower($Email);
$success="$username, Enter your new password to continue...";
session_start();
$_SESSION['Pharmacist_Email']=$result['Email'];
$_SESSION['Username']=$result['Name'];

header("Location: ../../VIEW/HTML/PHARMACIST/password_reset.php?success=$success");
}
else{
  $error =  "Name or the email does not exist";
  header("Location: ../../VIEW/HTML/PHARMACIST/forgotpassword.php?error=$error");
  exit();

}

}else{
  die(mysqli_error($conn));
}

}
else{

  $error = 'Fill the data in required fields';
  header("Location: ../../VIEW/HTML/PHARMACIST/forgotpassword.php?error=$error");
}


 ?>
