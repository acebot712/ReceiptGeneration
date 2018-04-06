<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/searchbox.js"></script>

<form method="post">
	<div class="search-box">
		<input type="text" autocomplete="off" name="kritarthID" placeholder="Enter Kritarth ID">
		<div class="result"></div>
		<input type="submit" name="submit" value="Search">
	</div>
</form>

<a href="logout.php">Logout</a>

		<div style="padding: 20px;">
			<table border="1px solid black">
				<tr>
					<td>Kritarth ID</td>
					<td>Name</td>
					<td>Age</td>
					<td>University/School</td>
					<td>Email</td>
					<td>Phone</td>
					<td>Event 1</td>
					<td>Event 2</td>
					<td>Verified</td>
					<td>Due Amount</td>
					<td></td>
					<td></td>
				</tr>
				<?php
	
					session_start();

					include('dbcred.php');

					if (array_key_exists("id", $_SESSION)) {   
				        #print_r($_SESSION);
					}else{
				        #print_r($_POST);
						header("Location: counter_guy.php");
					}

					$link = mysqli_connect("localhost", $user, $pass, $db);

				    if (mysqli_connect_error()) {
				        die("Database Connection Error");
				    }

				    if(empty($_POST['kritarthID'])||($_POST['kritarthID'] == "")){
				    	$sql = "SELECT * FROM users";
				    }else{
				    	$sql = "SELECT * FROM users WHERE regid = '".mysqli_real_escape_string($link, $_POST['kritarthID'])."'";
				    }
					$result = $link->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	if($row['verified']==0){
					    		$verified = "No";
					    	}else{
					    		$verified = "Yes";
					    	}
				    	
		                	if($row['event1']&&$row['event2']){
		                		$noofevents = 2;
		                	}
		                	else{
		                		$noofevents = 1;
		                	}

					    	if($row['university'] == 'KIITian'){
							    $amount = '200';
							}else if($row['university'] == 'University'){
							    if($noofevents == 1){
							        $amount = '200';
							    }
							    else{
							        $amount = '250';
							    }
							}else if($row['university'] == 'School'){
							    if($noofevents == 1){
							        $amount = '100';
							    }else{
							        $amount = '150';
							    }
							}
							if($row['paid']==0){
								$dueamount = $amount;
							}else{
								$dueamount = '0';
							}
							if (($row['event1']!=""&&$row['event1']!=-1)&&($row['event2']!=""&&$row['event2']!=-1)) {
								$events = $row['event1'].", ".$row['event2'];
							}else if($row['event1']!=""&&$row['event1']!=-1){
								$events = $row['event1'];
							}else if($row['event2']!=""&&$row['event2']!=-1){
								$events = $row['event2'];
							}

							$regid = $row["regid"];
							$name = $row["name"];
							$age = $row['age'];
							$school = $row['school'];
							$email = $row['email'];
							$phone = $row['phone'];
							$event1 = $row['event1'];
							$event2 = $row['event2'];

							$query = "SELECT * FROM `counter_activity` WHERE regid = '".mysqli_real_escape_string($link, $regid)."'";
							$resultinner = $link->query($query);

							if($resultinner->num_rows > 0){
								while($rowinner = $resultinner->fetch_assoc()){
									$timestamp = strtotime($rowinner['timestamp']);
									$date = date('d-m-Y', $timestamp);
								}
							}
								
					    	echo "<tr>";
					        echo "<td>".$regid."</td><td>".$name."</td><td>".$age."</td><td>".$school."</td><td>".$email."</td><td>".$phone."</td><td>".$event1."</td><td>".$event2."</td><td>".$verified."</td><td>".$dueamount."</td>";
					        echo "<td><form method='post' action='paymentdone.php'><input type='text' name='name' value=".$name." style='display: none;'><input type='text' name='amount' value=".$amount." style='display: none;'><input type='text' name='regid' value=".$regid." style='display: none;'><input type='submit' name='pay' class='confirmation' value='Pay'></form></td>";
					        echo "<td><a target='_blank' href='receipt.php?kritarthID=".$regid."&name=".$name."&amount=".$amount."&events=".$events."&date=".$date."'>Download Receipt</a></td>";
					        echo "</tr>";

					    }
					} else {
					    echo "0 results";
					}

				?>
			</table>
			
		</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/ajax.js"></script>
<script type="text/javascript">
	$('.confirmation').on('click', function () {
        return confirm('Confirm this person has paid?');
    });
</script>