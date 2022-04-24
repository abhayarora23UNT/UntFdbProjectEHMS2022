<?php
include_once '../../../DATABASE/connection.php';
//Validate
if (!empty($_POST['Name']) && !empty($_POST['Email']) && !empty($_POST['Specialization'])&& !empty($_POST['Phone']) && !empty($_POST['Pass1'])
&& !empty($_POST['Pass2'])) {

$Name            =strtoupper($_POST['Name']);
$Email           =strtolower($_POST['Email']);
$Specialization  =$_POST['Specialization'];
$Phone           =$_POST['Phone'];
$Password        =$_POST['Pass1'];

$sql="SELECT * FROM table_nurse WHERE Email='$Email' OR Phone='$Phone'";
$query=mysqli_query($conn,$sql);
$check_rows=mysqli_num_rows($query);

if ($Password != $_POST['Pass2']) {

 $error = "password do not match";
 header("Location: ../../VIEW/HTML/ADMIN/add_nurse.php?error=$error");
exit();
}
 else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){

  $error = "$Email is an invalid email format";
  header("Location:  ../../VIEW/HTML/ADMIN/add_nurse.php?error=$error");
exit();
}
else if (strlen($Password) < 6 ) {

  $error = "Password must be atleast 6 characters";
  header("Location:  ../../VIEW/HTML/ADMIN/add_nurse.php?error=$error");

exit();
}
else if ($check_rows > 0) {
  $error = "Nurse with '$Email'/'$Phone' already exist";
  header("Location:  ../../VIEW/HTML/ADMIN/add_nurse.php?error=$error");
  exit();
}
  else{
//Insert
$password_hash = md5($Password);
$sql = "INSERT INTO table_nurse(Name,Email,Specialization,Phone,Password) VALUES('$Name','$Email','$Specialization','$Phone','$password_hash')";
$query = mysqli_query($conn,$sql);
if ($query) {
  $Userinput= strtolower($Name);
  $success="Nurse $Userinput added successfuly";
  header("Location: ../../VIEW/HTML/ADMIN/add_nurse.php?success=$success");
}
}
}

else{
  $error = 'Fill the data in required fields';
  header("Location: ../../VIEW/HTML/ADMIN/add_nurser.php?error=$error");
}




 ?>
