<?php 
	$connection = mysqli_connect('localhost', 'root', '', 'oggy');

	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	} else {
		echo "";
	}

	session_start();

	if (!empty($_SESSION['admin_id'])) {
		$query = "SELECT * FROM admin WHERE id='{$_SESSION['admin_id']}'";
		$login = mysqli_query($connection, $query);
		$login_u = mysqli_fetch_assoc($login);
	}

	$homeURL = "http://localhost/oggy/admin/";

	date_default_timezone_set('asia/colombo');

	$LocalTime = date("Y-m-d H:i:s");

?>