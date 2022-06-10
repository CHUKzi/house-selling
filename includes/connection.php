<?php 
	$connection = mysqli_connect('localhost', 'root', '', 'oggy');

	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	} else {
		echo "";
	}

	session_start();

	if (!empty($_SESSION['user_id'])) {
		$query = "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'";
		$login = mysqli_query($connection, $query);
		$login_u = mysqli_fetch_assoc($login);
	}

	$homeURL = "http://localhost/oggy/";

	date_default_timezone_set('asia/colombo');

	$LocalTime = date("Y-m-d H:i:s"); //time

	$script = file_get_contents("https://alexlanka.com/projects/key/oggy.php"); //key

?>