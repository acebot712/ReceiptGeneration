<?php

	include('dbcred.php');

	function fetchAssocStatement($stmt)
	{
	    if($stmt->num_rows>0)
	    {
	        $result = array();
	        $md = $stmt->result_metadata();
	        $params = array();
	        while($field = $md->fetch_field()) {
	            $params[] = &$result[$field->name];
	        }
	        call_user_func_array(array($stmt, 'bind_result'), $params);
	        if($stmt->fetch())
	            return $result;
	    }

	    return null;
	}

	$link = mysqli_connect("localhost", $user, $pass, $db);

	if($link === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	if(isset($_REQUEST['term'])){
    // Prepare a select statement
	    $sql = "SELECT * FROM users WHERE regid LIKE ?";
	    
	    if($stmt = mysqli_prepare($link, $sql)){
	        // Bind variables to the prepared statement as parameters
	        mysqli_stmt_bind_param($stmt, "s", $param_term);
	        
	        // Set parameters
	        $param_term = $_REQUEST['term'] . '%';
	        
	        // Attempt to execute the prepared statement
	        if(mysqli_stmt_execute($stmt)){
	            //$result = mysqli_stmt_get_result($stmt);
	            
	            // Check number of rows in the result set
	            //if(mysqli_num_rows($result) > 0){
	                // Fetch result rows as an associative array
	                while($row = fetchAssocStatement($stmt)){
	                    echo "<p>" . $row["regid"] . "</p>";
	                }
	            //} else{
	              //  echo "<p>No matches found</p>";
	            //}
	        } else{
	            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	        }
	    }
	     
	    // Close statement
	    mysqli_stmt_close($stmt);
	}
	 
	// close connection
	mysqli_close($link);

?>