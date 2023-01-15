<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.rtl.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.rtl.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.grid">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.rtl.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.rtl.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.rtl.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-utilities.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-utilities.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-utilities.rtl.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-utilities.rtl.min.css">
        <link href="css/style.css" rel="stylesheet">
<script src="file:///C:/xampp/htdocs/CRUD/bootstrap-5.0.0/js/bootstrap.bundle.min.js.map"></script>
<script src="js/jquery.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<?php require_once 'process.php'; ?>

<?php if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php
echo $_SESSION['message'];
unset($_SESSION['message']);

?>
</div>	
<?php endif ?>    
<div class="container">
<?php
$mysqli = new mysqli('localhost','root','','CRUD') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM `data`") or die($mysqli->error); 
//pre_r($result);
?>

<div class="row justify-content-center">
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone number</th>
				<th>Location</th>
			 	<th colspan="2">Action</th>
			</tr>
		</thead>
		<?php
			while ($row = $result->fetch_assoc()):
		?>
	<tr>
		<td><?php echo $row['Name']; ?></td>
		<td><?php echo $row['Email']; ?></td>
		<td><?php echo $row['Phone_number']; ?></td>
		<td><?php echo $row['Location']; ?></td>
		<td>
			<a href="index.php?edit=<?php echo $row['id']; ?>"
				class="btn btn-info">Edit</a>
			<a href="process.php?delete=<?php echo $row['id']; ?>"
			    class="btn btn-danger">Delete</a>
		</td>
	</tr>
<?php endwhile; ?>
	</table>
</div>

<?php
function pre_r( $array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

?>

<div class="row justify-content-center">
<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group"> 
	<label>Name</label>
	<input type="text" name="Name" class="form-control" value="<?php echo $Name; ?>" placeholder="Enter name" autocomplete="off" required/>
</div>
<div class="form-group"> 
	<label>Email</label>
	<input type="email" name="Email" class="form-control" value="<?php echo $Email; ?>" placeholder="Enter Email" autocomplete="off" required/>
</div>
<div class="form-group"> 
	<label>Phone number</label>
	<input type="text" name="Phone_number" class="form-control" value="<?php echo $Phone_number; ?>" placeholder="Enter Phone number" autocomplete="off" required/>
</div>
<div class="form-group">	
	<label>Location</label>
	<input type="text" name="Location" class="form-control" value="<?php echo $Location; ?>" placeholder="Enter location" autocomplete="off" required/>
</div>
<div class="form-group">	
<?php
if ($update == true): 
	?>
<button type="submit" class="btn btn-info" name="update">Update</button>
<?php else: ?>
	<button type="submit" class="btn btn-primary" name="save">Save</button>
<?php endif; ?> 
</div>	
</form>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>