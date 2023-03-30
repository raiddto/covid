<?php
	// Connection
	require_once'connection.php';

	// Add
	if(isset($_POST['add']))
	{
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$age=$_POST['age'];
		$mobile=$_POST['mobile'];
		$temp=$_POST['temp'];
		$diag=$_POST['diag'];
		$encounter=$_POST['encounter'];
		$vax=$_POST['vax'];
		$nationality=$_POST['nationality'];
		$sql=mysqli_query($con,"call sp_insert('$name','$gender','$age','$mobile','$temp','$diag','$encounter','$vax','$nationality')");
		if ($sql) {
			echo "<script>alert('Record inserted successfully');</script>";
			echo "<script>window.location.href='index.php'</script>"; 
		} else {
			echo "<script>alert('Something went wrong. Please try again');</script>";
			echo "<script>window.location.href='index.php'</script>"; 
		}
	}

	// Delete
	if(isset($_REQUEST['del']))
	{
		$rid=intval($_GET['del']);
		$sql =mysqli_query($con,"call sp_delete('$rid')");

		echo "<script>alert('Record deleted');</script>";
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
	                <a href="#form" class="nav-link text-white">Form</a>
	                <a href="#table" class="nav-link text-white">Table</a>
	                <a href="#counter" class="nav-link text-white">Counter</a>
	                <a href="#about" class="nav-link text-white">About</a>
	                <a href="/covid" class="nav-link text-white">New</a>
	            </div>
	        </div>
	        <div class="col-11 offset-1">
	        	<div id="form">
					<h2 class="text-center mb-5">Case Study 2</h2>
					<div>
						<form name="add" method="POST">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" placeholder="Name" name="name" required>
							</div>
							<div class="form-group">
								<label for="gender">Gender</label><br>
								&nbsp;
								<input type="radio" name="gender" value="male" checked="checked">
								<label for="gender1">Male</label>&emsp;
								<input type="radio" name="gender" value="female">
								<label for="gender2">Female</label><br>
							</div>
							<div class="form-group">
								<label for="age">Age</label>
								<input type="number" class="form-control" placeholder="Age" name="age" required>
							</div>
							<div class="form-group">
								<label for="mobile">Mobile Number</label>
								<input type="text" class="form-control" placeholder="Mobile Number" name="mobile" required>
							</div>
							<div class="form-group">
								<label for="temp">Body Temperature (Celsius)</label>
								<input type="number" step=".01" class="form-control" placeholder="Temperature" name="temp">
							</div>
							<div class="form-group">
								<label for="diag">COVID-19 Diagnosed</label><br>
								&nbsp;
								<input type="radio" name="diag" value="yes">
								<label for="diag1">Yes</label>&emsp;
								<input type="radio" name="diag" value="no" checked="checked">
								<label for="diag2">No</label><br>
							</div>
							<div class="form-group">
								<label for="encounter">COVID-19 Encounter</label><br>
								&nbsp;
								<input type="radio" id="html" name="encounter" value="yes">
								<label for="enc1">Yes</label>&emsp;
								<input type="radio" name="encounter" value="no" checked="checked">
								<label for="enc2">No</label><br>
							</div>
							<div class="form-group">
								<label for="vax">Vacinated</label><br>
								&nbsp;
								<input type="radio" name="vax" value="yes">
								<label for="vax1">Yes</label>&emsp;
								<input type="radio" name="vax" value="no" checked="checked">
								<label for="vax2">No</label><br>
							</div>
							<div class="form-group">
								<label for="nationality">Nationality</label>
								<input type="text" class="form-control" placeholder="Nationality" name="nationality" required>
							</div>
							<button type="submit" class="btn btn-primary" name="add" value="Submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
						</form>
					</div>
				</div>
				<hr>
				<div id="table">
					<h2 class="text-center mb-5">Table</h2>
					<table id="dTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
						<thead>
							<tr>
							<th scope="col"></th>
							<th scope="col">Name</th>
							<th scope="col">Age</th>
							<th scope="col">Gender</th>
							<th scope="col">Mobile No.</th>
							<th scope="col">Body Temp</th>
							<th scope="col">COVID-19 Diagnosed</th>
							<th scope="col">COVID-19 Encounter</th>
							<th scope="col">Vacinated</th>
							<th scope="col">Nationality</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sql = mysqli_query($con, "call sp_read()");
								$cnt = 1;
								$enc = 0;
								$vax = 0;
								$fev = 0;
								$ad = 0;
								$min = 0;
								$for = 0;
								$row = mysqli_num_rows($sql);

								if($row > 0) {
									while ($result = mysqli_fetch_array($sql)) {
										if ($result['Encounter'] == "yes") {
											$enc++;
										}

										if ($result['Vax'] == "yes") {
											$vax++;
										}

										if ($result['Temp'] >= 37) {
											$fev++;
										}

										if ($result['Age'] >= 18) {
											$ad++;
										}

										if ($result['Age'] <= 17) {
											$min++;
										}

										if (strtolower($result['Nationality']) != "filipino") {
											$for++;
										}
							?>
							<tr>
							    <td><?php echo $cnt; ?></td>
							    <td><?php echo ucwords($result['Name']); ?></td>
							    <td><?php echo ucwords($result['Age']); ?></td>
							    <td><?php echo ucwords($result['Gender']); ?></td>
							    <td><?php echo ucwords($result['Mobile']); ?></td>
							    <td><?php echo ucwords($result['Temp']); ?></td>
							    <td><?php echo ucwords($result['Diag']); ?></td>
							    <td><?php echo ucwords($result['Encounter']); ?></td>
							    <td><?php echo ucwords($result['Vax']); ?></td>
							    <td><?php echo ucwords($result['Nationality']); ?></td>
							 
							    <td><a href="update.php?id=<?php echo htmlentities($result['id']);?>"><button class="btn btn-primary btn-xs"><i class="fa-solid fa-pen-to-square"></i></button></a></td>
							 
							    <td><a href="?del=<?php echo htmlentities($result['id']);?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa-solid fa-trash-can"></i></button></a></td>
						    </tr>
						    <?php 
										$cnt++;
									}
								} else {
							?>
							<tr>
							    <td colspan="9" style="font-weight:bold;text-align:center;"> No Record found</td>
							</tr>
							<?php } ?>    
						</tbody>
					</table>
				</div>
				<hr>
	        	<div id="counter">
					<h2 class="text-center mb-5">Counter</h2>
					<div class="card-deck mb-5">
						<div class="card card-1">
							<div class="card-body text-center text-white">
								<h3 class="card-title"><?php echo $enc; ?></h3>
								<strong class="card-text">COVID-19 ENCOUNTER</strong>
							</div>
						</div>
						<div class="card card-2">
							<div class="card-body text-center text-white">
								<h3 class="card-title"><?php echo $vax; ?></h3>
								<strong class="card-text">VACCINATED</strong>
							</div>
						</div>
						<div class="card card-3">
							<div class="card-body text-center text-white">
								<h3 class="card-title"><?php echo $fev; ?></h3>
								<strong class="card-text">FEVER</strong>
							</div>
						</div>
					</div>
					<div class="card-deck">
						<div class="card card-4">
							<div class="card-body text-center text-white">
								<h3 class="card-title"><?php echo $ad; ?></h3>
								<strong class="card-text">ADULT</strong>
							</div>
						</div>
						<div class="card card-5">
							<div class="card-body text-center text-white">
								<h3 class="card-title"><?php echo $min; ?></h3>
								<strong class="card-text">MINOR</strong>
							</div>
						</div>
						<div class="card card-6">
							<div class="card-body text-center text-white">
								<h3 class="card-title"><?php echo $for; ?></h3>
								<strong class="card-text">FOREIGNER</strong>
							</div>
						</div>
					</div>
				</div>
				<hr>
	        	<div id="about">
					<h2 class="text-center mb-5">About</h2>
	            	<img src="images/peo.png" class="peo-logo img-fluid img-thumbnail">
					<p class="text-center">PGMO-PEO</p>
					<ul class="list-group">
						<li class="list-group-item text-center"><a href="https://www.facebook.com/raiddto/"><i class="fa-brands fa-facebook"></i> Ryan Abcede</a></li>
					</ul>
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