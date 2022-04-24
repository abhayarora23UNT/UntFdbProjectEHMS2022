<?php
include_once '../../../../DATABASE/connection.php';
session_start();
if (!isset($_SESSION['Nurse']) && !isset($_SESSION['password'])) {
	$error="You must log-in first";
		header("location: nurse_login.php?error=$error");
	}
	if (!empty($_POST['Email']) && !empty($_POST['Temp']) && !empty($_POST['Pressure']) && !empty($_POST['Height'])
  && !empty($_POST['Sugar']) && !empty($_POST['Weight'])) {
	$Email        =$_POST['Email'];
	$Temp         =$_POST['Temp'];
	$Pressure     = $_POST['Pressure'];
	$Height       = $_POST['Height'];
	$Weight       = $_POST['Weight'];
	$Sugar        = $_POST['Sugar'];

	//Insert
  $sql="INSERT INTO table_basic_test(Email,Temp,Pressure,Height,Weight,Sugar) VALUES('$Email','$Temp','$Pressure','$Height','$Weight','$Sugar')";
	$query = mysqli_query($conn,$sql);
	if ($query) {
	  $success="Patient tests added successfuly";
	  header("Location: manage_patients.php?success=$success");
		exit();
	}
	else {
		$error="error in insertion!!!";
		header("Location: manage_patients.php?error=$error");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Nurse  | Patient Consultation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">.
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
		<style>
    .view_patient_table{
      width: 100%;
      height: auto;
      background-color: inherit;
			margin-top: 30px;
			margin-bottom: 20px;
      padding: 0.5px;
    }
    h5{
      margin-left: 50px;
    }
    table{
      width: 90%;
      height: auto;
      margin: 0 auto;
      border-color: silver;
      border-collapse: collapse;
      background-color: #ffffff;
      font-family: lucida, sans-serif;
    }
    td{
      padding: 10px;
    }
		.Patientdetails_bottom{
			width: 90%;
			height: 200px;
			margin: 0 auto;
		}
		.medical__history__form{
			width: 100%;
			height: 100px;
			background-color: inherit;
			padding: 0.5px;
			margin-bottom: 70px;
		}
    .patient__medical__history{
      width: 100%;
      height: 100px;
      background-color: inherit;
			padding: 0.5px;
    }
    form input{
      width: 100%;
      height: auto;
      border-style:none;
      outline: none;
      background-color: #ffffff;
    }
    .save__btn{
      position: fixed;
    }
		textarea .Prescription{
			border: none
		}
		</style>
 </head>
	<body>
<?php include('../NURSE/INCLUDES/sidebar.php');?>
<?php include('../ADMIN/INCLUDES/footer.php');?>
<div id="section__content" class="section__content">
	<section id="admin__dashboard" class="admin__dashboard">
		<h1>Nurse | Patient Consultation</h1>
	</section>
	<?php
	$Email= $_GET['Email'];
	$sql="SELECT * FROM table_patients WHERE Email='$Email'";
	$query=mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($query)){
	$date=date("d-F-yy,h:i:s a",strtotime($data['Visit_date']));
	$Name=strtolower($data['FullName']);
	$Phone=$data['Phone'];
	$Address=$data['Address'];
	$City=$data['City'];
	$Dob=date("d-F-Y",strtotime($data['DOB']));
	$Gender=$data['Gender'];
	$Age=date("Y") - date("Y",strtotime($Dob));
?>
  <div class="view_patient_table">
    <table border="1">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:black">Patient Details</td>
</tr>
<tr>
  <td style="font-weight:bold;">Patient Name</td>
  <td><?php echo $Name; ?></td>
  <td style="font-weight:bold;">Patient Email</td>
  <td><?php echo $Email; ?></td>
</tr>
<tr>
  <td style="font-weight:bold;">Patient Phone</td>
  <td><?php echo $Phone; ?></td>
  <td style="font-weight:bold;">Patient Address</td>
  <td><?php echo $Address; ?></td>
</tr>
<tr>
  <td style="font-weight:bold;">City</td>
  <td><?php echo $City; ?></td>
  <td style="font-weight:bold;">D.O.B</td>
  <td><?php echo $Dob; ?></td>
</tr>
<tr>
	<td style="font-weight:bold;">Gender</td>
	<td><?php echo $Gender; ?></td>
	<td style="font-weight:bold;">Patient Age</td>
	<td><?php echo $Age; ?> Year ('s)</td>
</tr>
<tr>
	<td style="font-weight:bold;">Registration Date</td>
	<td><?php echo $date; ?></td>
</tr>
</table>
  </div>
	<?php } ?>
	<h3>Basic Test Form</h3>
<form action="consultation.php" method="post">
  <div class="medical__history__form">
    <table border="1">
                        <thead>
                          <tr>
                            <th>#</th>
														<th>Email</th>
                            <th>Body Temp</th>
                            <th>Blood Pressure</th>
														<th>weight(kg)</th>
														<th>Height(m)</th>
                            <th>Blood sugar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
														<td><input type="text" name="Email" value="<?php echo $Email; ?>" required readonly></td>
                            <td> <input type="text" name="Temp" value="" required> </td>
                            <td><input type="text" name="Pressure" value="" required></td>
														<td><input type="text" name="Weight" value="" required></td>
														<td><input type="text" name="Height" value="" required></td>
														<td><input type="text" name="Sugar" value="" required></td>
                          </tr>
                        </tbody>
</table>
<div class="save__btn">
  <button type="submit" class="btn btn-primary pull-right" name="submit">
    Send <i class="fa fa-arrow-circle-right"></i>
  </button>
</div>
  </div>
  </form>
	<?php
	$Email=$_GET['Email'];
	$sql="SELECT * FROM table_basic_test WHERE Email='$Email' ORDER BY Visit_date DESC";
	$query=mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($query)){
	$date=date("d-F-yy,h:i:s a",strtotime($data['Visit_date']));
	$count=1;
?>
<div class="patient__medical__history">
	<table border="1">
											<thead>
												<tr>
													<th>#</th>
													<th>Body Temperature</th>
													<th>Blood Pressure</th>
													<th>Weight</th>
													<th>Blood Sugar</th>
													<th>Medical Prescription</th>
													<th>Visit Date</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><?php echo $count ?></td>
													<td><?php echo $data['Temp']; ?></td>
													<td><?php echo $data['Pressure']; ?></td>
													<td><?php echo $data['Weight']; ?></td>
													<td><?php echo $data['Height']; ?></td>
													<td><?php echo $data['Sugar']; ?></td>
													<td><?php echo $date; ?></td>
												</tr>
											</tbody>
</table>
</div>
	<?php $count=$count+1;} ?>


	</body>
</html>
