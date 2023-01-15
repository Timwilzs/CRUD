<?php

session_start(); 

$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$Name = '';
$Email = '';
$Phone_number = '';
$Location = '';

if (isset($_POST['save'])) {
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Phone_number = $_POST['Phone_number'];
	$Location = $_POST['Location'];

	$mysqli->query("INSERT INTO `data`(Name, Email, Phone_number, Location) VALUES ('$Name', '$Email', '$Phone_number', '$Location')") or die($mysqli->error);


	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM `data` WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM `data` WHERE id=$id") or die ($mysqli->error());
	if (count($result)==1) {
		$row = $result->fetch_array();
		$Name = $row['Name'];
		$Email = $row['Email'];
		$Phone_number = $row['Phone_number'];
		$Location = $row['Location'];
	}
}
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Phone_number = $_POST['Phone_number'];
	$Location = $_POST['Location'];

	$mysqli->query("UPDATE `data` SET `Name`='$Name',`Email`='$Email',`Phone_number`='$Phone_number',`Location`='$Location' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "warning";

	header('location: index.php');
}
?>