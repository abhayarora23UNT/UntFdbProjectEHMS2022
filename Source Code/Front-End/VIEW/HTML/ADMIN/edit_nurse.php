<?php
include_once '../../../../DATABASE/connection.php';
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
	$error="You must log-in first";
		header("location: ../admin_login.php?error=$error");
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin  | Edit Nurse</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
		<link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../fontawesome/css/all.css">
    <link rel="stylesheet" href="../../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../fontawesome/css/fa-brands.css">
    <link rel="stylesheet" href="../../fontawesome/css/fa-regular.css">
    <link rel="stylesheet" href="../../fontawesome/css/fa-regular.min.css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../themify-icons/themify-icons.min.css">
    <link rel="stylesheet" href="../../fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../../fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome/css/fontawesome.min.css">
 </head>
	<body>
<?php include('../ADMIN/INCLUDES/sidebar.php');?>
<?php include('../ADMIN/INCLUDES/footer.php');?>
<div id="section__content" class="section__content">
	<section id="admin__dashboard" class="admin__dashboard">
		<h1>Admin | Edit Nurse Details</h1>
	</section>
  <div class="adddoctor__main" style="display:flex;justify-content:center">
  <div class="adddoctor__content">
    <div class="adddoctor__title">
      <h5>Edit Nurse Info</h5>
      <?php
			$Email           =$_GET['Email'];
      $sql="SELECT * FROM table_nurse WHERE Email='$Email'";
      $query=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($query)){
      $date=date("d-m-yy",strtotime($data['Entry_date']));
      $Name=strtolower($data['Name']);
      $Phone=$data['Phone'];
      $Specialization=$data['Specialization'];
?>
<?php echo $Name;?>'s Profile
<p><b>Registration Date: </b><?php echo $date;?></p>
</p>
<?php } ?>
    </div>
    <form class="contactus__form" action="../../../CONTROL/ADMIN/edit_nurse.contr.php" method="POST">
           <div class="contactusform__inputs contactusform__inputs--adddoctor">
              <div class="usericon">
              <i class="fa fa-user"></i>
                </div>
               <input type="text" name="Name" value="<?php echo $Name;?>" required style="color:black;"><br>
                <div class="passicon">
                <i class="fa fa-envelope"></i>
                </div>
               <input type="email"name="Email" value="<?php echo $Email; ?>" required style="color:black;" readonly>
               <select name="Specialization" required class="specialization">
								 <option value="<?php echo $Specialization; ?>"><?php echo $Specialization ?></option>
								 <option value="Clinical officer">Clinical Officer</option>
                 <option value="Dermatologist">Dermatologist</option>
                 <option value="Gynecologist">Gynecologist</option>
                 <option value="Dentist">Dentist</option>
                 <option value="Orthopaedic">Orthopaedic</option>
                 <option value="Optician">Optician</option>
                 <option value="Pediatrician">Pediatrician</option>
                 <option value="Neurologist">Neurologist</option>
                 <option value="Psychiatrist">Psychiatrist</option>

               </select>
               <div class="passicon">
               <i class="fa fa-phone"></i>
               </div>
              <input type="text"name="Phone" value="<?php echo $Phone; ?>" required style="color:black;">
           <div class="submit__btn">
             <button type="submit" name="submit">
               Update <i class="fa fa-arrow-circle-right"></i>
             </button>
           </div>
             </div>
       </form>
  </div>
</div>
</div>
	</body>
</html>
