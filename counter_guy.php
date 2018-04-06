<?php

	session_start();

	include("dbcred.php");

	$error = "";

	if (array_key_exists("submit", $_POST)) {

        $link = mysqli_connect("localhost", $user, $pass, $db);

        if (mysqli_connect_error()) {
            die("Database Connection Error");
        }

        if (!($_POST['email'])||(empty($_POST['email']))) {
        	$error .= "Enter a valid Email address<br>";
        }

        if (!($_POST['password'])||(empty($_POST['password']))) {
        	$error .= "Enter a valid password<br>";
        }

        if ($error != "") {
        	$error = "<p>Following fields are invalid:</p>".$error;
        }else{

            $query = "SELECT * FROM `counter_guy` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

            $result = mysqli_query($link, $query);

            $row = mysqli_fetch_array($result);

            if(is_array($row)&&(array_key_exists("id", $row))&&($row!=null)){

            	$password = $_POST['password'];

            	if($password == $row['password']){

            		$_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
            		header("Location: loggedinpage.php");

            	}else{
            		$error = "<p>You entered a Wrong Password!</p>";
            	}
            }else{
            	$error = "<p>Please enter valid login credentials</p>";
            }

        }
    }
/*
    else if(array_key_exists("id", $_SESSION)){
    	header("Location: loggedinpage.php");
    }
*/

?>

<div id="error"><?php echo $error;?></div>

<form method="post">
	Email
	<input type="email" name="email">
	Password:
	<input type="password" name="password">
	<input type="submit" name="submit" value="Login!">
</form>