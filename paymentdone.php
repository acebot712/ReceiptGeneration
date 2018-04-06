<?php

	session_start();

	include('dbcred.php');

	$error = "";

	if(array_key_exists("pay",$_POST)){

		$link = mysqli_connect("localhost", $user, $pass, $db);

        if (mysqli_connect_error()) {
            die("Database Connection Error");
        }

        $query = "UPDATE `users` SET paid = '".$_POST['amount']."' WHERE regid = '".mysqli_real_escape_string($link, $_POST['regid'])."' LIMIT 1";
		mysqli_query($link,$query);

		$query = "SELECT `regid` FROM `counter_activity` WHERE regid = '".mysqli_real_escape_string($link, $_POST['regid'])."' LIMIT 1";
		$result = mysqli_query($link,$query);

		if(mysqli_num_rows($result) == 0){

			$query = "INSERT INTO `counter_activity` (`participant_name`,`counterperson_name`, `email`,`regid`,`amount`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_SESSION['name'])."', '".mysqli_real_escape_string($link, $_SESSION['email'])."', '".mysqli_real_escape_string($link, $_POST['regid'])."', '".mysqli_real_escape_string($link, $_POST['amount'])."')";
			mysqli_query($link,$query);

		}

	}

	header("Location: loggedinpage.php");

?>