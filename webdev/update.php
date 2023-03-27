<?php
	// Connection
	require_once'connection.php';

	// Update
	if(isset($_POST['update']))
	{
		$rid=intval($_GET['id']);
		$name=$_POST['name'];
		$age=$_POST['age'];
		$gender=$_POST['gender'];
		$mobile=$_POST['mobile'];
		$temp=$_POST['temp'];
		$diag=$_POST['diag'];
		$encounter=$_POST['encounter'];
		$vax=$_POST['vax'];
		$nationality=$_POST['nationality'];
		$sql=mysqli_query($con,"call sp_update('$name','$gender','$age','$mobile','$temp','$diag','$encounter','$vax','$nationality','$rid')");
		echo "<script>alert('Record Updated successfully');</script>";
		echo "<script>window.location.href='index.php'</script>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
		<!-- favicon -->
		<link rel="icon" type="image/png" sizes="192x192"  href="images/favicons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="images/favicons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/favicons/favicon-16x16.png">
		<link rel="manifest" href="images/favicons/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">
		<title>Case Study 2 - PEO</title>
	</head>
	<body>
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-1 px-1 position-fixed bg-primary" id="sticky-sidebar">
	            <div class="nav flex-column flex-nowrap vh-100 overflow-auto p-2">
	                <a href="/dict_casestudy2/" class="nav-link text-white">Home</a>
	            </div>
	        </div>
	        <div class="col-11 offset-1">
	        	<div id="form">
					<?php 
					$userid = intval($_GET['id']);
					$sql = mysqli_query($con, "call sp_readarow('$userid')");
					while ($result=mysqli_fetch_array($sql)) {                 
						?>
					<h2 class="text-center mb-5">Update <?php echo ucwords($result['Name']); ?></h2>
					<div class="my-3">
						<form name="insertrecord" method="post" >
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo ucwords($result['Name']); ?>" required>
							</div>
							<div class="form-group">
								<label for="gender">Gender</label><br>
								&nbsp;
								<?php if ($result['Gender'] == "male") { ?>
									<input type="radio" name="gender" value="male" checked="checked">
									<label for="gender1">Male</label>&emsp;
								<?php } else { ?>
									<input type="radio" name="gender" value="male">
									<label for="gender1">Male</label>&emsp;
								<?php } ?>
								<?php if ($result['Gender'] == "female") { ?>
									<input type="radio" name="gender" value="female" checked="checked">
									<label for="gender2">Female</label><br>
								<?php } else { ?>
									<input type="radio" name="gender" value="female">
									<label for="gender2">Female</label><br>
								<?php } ?>
							</div>
							<div class="form-group">
								<label for="age">Age</label>
								<input type="number" class="form-control" placeholder="Age" name="age" value="<?php echo $result['Age']; ?>" required>
							</div>
							<div class="form-group">
								<label for="mobile">Mobile Number</label>
								<input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="<?php echo $result['Mobile']; ?>" required>
							</div>
							<div class="form-group">
								<label for="temp">Body Temperature (Celsius)</label>
								<input type="number" step=".01" class="form-control" placeholder="Temperature" name="temp" value="<?php echo $result['Temp']; ?>">
							</div>
							<div class="form-group">
								<label for="diag">COVID-19 Diagnosed</label><br>
								&nbsp;
								<?php if ($result['Encounter'] == "yes") { ?>
								<input type="radio" name="diag" value="yes" checked="checked">
								<label for="diag1">Yes</label>&emsp;
								<?php } else { ?>
								<input type="radio" name="diag" value="yes">
								<label for="diag1">Yes</label>&emsp;
								<?php } ?>
								<?php if ($result['Encounter'] == "no") { ?>
								<input type="radio" name="diag" value="no" checked="checked">
								<label for="diag2">No</label><br>
								<?php } else { ?>
								<input type="radio" name="diag" value="no">
								<label for="diag2">No</label><br>
								<?php } ?>
							</div>
							<div class="form-group">
								<label for="encounter">COVID-19 Encounter</label><br>
								&nbsp;
								<?php if ($result['Encounter'] == "yes") { ?>
									<input type="radio" id="html" name="encounter" value="yes" checked="checked">
									<label for="encounter1">Yes</label>&emsp;
								<?php } else { ?>
									<input type="radio" id="html" name="encounter" value="yes">
									<label for="encounter1">Yes</label>&emsp;
								<?php } ?>
								<?php if ($result['Encounter'] == "no") { ?>
									<input type="radio" name="encounter" value="no" checked="checked">
									<label for="encounter2">No</label><br>
								<?php } else { ?>
									<input type="radio" name="encounter" value="no">
									<label for="encounter2">No</label><br>
								<?php } ?>
							</div>
							<div class="form-group">
								<label for="vax">Vacinated</label><br>
								&nbsp;
								<?php if ($result['Vax'] == "yes") { ?>
									<input type="radio" name="vax" value="yes" checked="checked">
									<label for="vax1">Yes</label>&emsp;
								<?php } else { ?>
									<input type="radio" name="vax" value="yes">
									<label for="vax1">Yes</label>&emsp;
								<?php } ?>
								<?php if ($result['Vax'] == "no") { ?>
									<input type="radio" name="vax" value="no" checked="checked">
									<label for="vax2">No</label><br>
								<?php } else { ?>
									<input type="radio" name="vax" value="no">
									<label for="vax2">No</label><br>
								<?php } ?>
							</div>
							<div class="form-group">
								<label for="nationality">Nationality</label>
								<input type="text" class="form-control" placeholder="Nationality" name="nationality" value="<?php echo ucwords($result['Nationality']); ?>" required>
							</div>
							<?php } ?>
							<button type="submit" class="btn btn-primary" name="update" value="Submit"><i class="fa-solid fa-floppy-disk"></i> Update</button>
						</form>
					</div>
				</div>
	        </div>
	    </div>
	</div>
    <button onclick="topFunction()" id="btn-up" title="Go to top" class="bg-primary"><i class="fa-solid fa-arrow-up"></i></button>

	<script type="text/javascript" src="script.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>