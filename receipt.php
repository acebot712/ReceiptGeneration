<?php

	include('dbcred.php');

	$error = "";

	if(array_key_exists("kritarthID",$_GET)){

		$link = mysqli_connect("localhost", $user, $pass, $db);

        if (mysqli_connect_error()) {
            die("Database Connection Error");
        }

        $query = "SELECT `paid` FROM `users` WHERE regid = '".mysqli_real_escape_string($link, $_GET['kritarthID'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);

        if($result === FALSE) { 
		    die("Sorry! Query was not executed successfully!"); // TODO: better error handling
		}

        if($row['paid']==0){
        	$error .= "<p>This person has not paid.<a href='loggedinpage.php'>Go back</a></p>";
        	echo $error;
        }

        $query = "SELECT `id` FROM `counter_activity` WHERE regid = '".mysqli_real_escape_string($link, $_GET['kritarthID'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);

        if(isset($row['id'])){

	        $receiptNo = sprintf("%05d",$row['id']);
	    }
        	
	}

	if($error==""){

?>

<html>
<head>
	<title>Receipt</title>
	  <!-- Normalize or reset CSS with your favorite library -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

	  <!-- Load paper.css for happy printing -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.2.3/paper.css">

	  <!-- Set page size here: A5, A4 or A3 -->
	  <!-- Set also "landscape" if you need -->
	  <style>@page { size: A5 landscape }</style>

	  <!-- Custom styles for this document -->
	  <link href='https://fonts.googleapis.com/css?family=Tangerine:700' rel='stylesheet' type='text/css'>
	  <style>
	    body   { font-family: serif }
	    h1     { font-family: 'Tangerine', cursive; font-size: 40pt; line-height: 18mm}
	    h2, h3 { font-family: 'Tangerine', cursive; font-size: 24pt; line-height: 7mm }
	    h4     { font-size: 32pt; line-height: 14mm }
	    h2 + p { font-size: 18pt; line-height: 7mm }
	    h3 + p { font-size: 14pt; line-height: 7mm }
	    li     { font-size: 11pt; line-height: 5mm }
	    h1      { margin: 0 }
	    h1 + ul { margin: 2mm 0 5mm }
	    h2, h3  { margin: 0 3mm 3mm 0; float: left }
	    h2 + p,
	    h3 + p  { margin: 0 0 3mm 50mm }
	    h4      { margin: 2mm 0 0 50mm; border-bottom: 2px solid black }
	    h4 + ul { margin: 5mm 0 0 50mm }
	    article { border: 4px double black; padding: 5mm 10mm; border-radius: 3mm }
	  </style>
	</head>
<body class="A5 landscape">
	<!-- 
	content of this area will be the content of your PDF file 
	-->
	<div id="HTMLtoPDF">

	  <section class="sheet padding-20mm">

	    <h1>KRITARTH 2017</h1>
	    <ul>
	      <li>KSAC, KIIT University, Bhubaneshwar,Odisha, 751024</li>
	      <li>TEL: +91 9937243019</li>
	      <li><a href="https://www.kritarth.org">https://www.kritarth.org/</a></li>
	      <li>Date: <?php echo $_GET['date'];?></li>
	    </ul>

	    <article>
	    	<?php 
	    	if (isset($receiptNo)) 
	    		echo "<h2>Receipt No: </h2>
	    			<p>".$receiptNo."</p>";
	    	?>

	      <h2>Received from:</h2>
	      <p><?php echo $_GET['name']; ?></p>
	      <h2>Kritarth ID:</h2>
	      <p><?php echo $_GET['kritarthID']; ?></p>

	      <h3>Events:</h3>
	      <p><?php echo $_GET['events']; ?></p>
	      <h3>For:</h3>
	      <p>Registration fee</p>

	      <h4>&#8377; <?php echo $_GET['amount']; ?></h4>
	      <ul>
	        <li>Paid by: cash</li>
	      </ul>
	    </article>

	  </section>

	</div>

	<!-- here we call the function that makes PDF -->
	<a href="#" onclick="HTMLtoPDF()">Download PDF</a>

	<!-- these js files are used for making PDF -->
	<script src="js/jspdf.js"></script>
	<script src="js/jquery-2.1.3.js"></script>
	<script src="js/pdfFromHTML.js"></script>
</body>
</html>

<?php
}
?>