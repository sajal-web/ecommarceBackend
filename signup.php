<?php
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['mobile'])) {
	$conn = mysqli_connect("localhost", "root", "", "ecomdb");
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = password_hash($_POST['name'], PASSWORD_DEFAULT);
	$mobile = $_POST['mobile'];

	if ($conn) {
		$qry = "INSERT INTO `users` (`name`, `email`, `password`, `mobile`)
			 VALUES ('" . $name . "', '" . $email . "', '" . $password . "', '" . $mobile . "')";
		if (mysqli_query($conn, $qry)) {
			echo "success";
		} else
			echo "Registration failed";
	} else
		echo "Database connection failed";
} else
	echo "All fields are required";
?>