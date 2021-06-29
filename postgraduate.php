<?php define("filepath", "../files/postgraduate.JSON");
	$firstName =$lastName = $phoneNum = $presentAddress = $permanentAddress =$SSC = $HSC = "";
	$isValid = true;

	$firstNameErr = $lastNameErr = $phoneNumErr = $presentAddressErr = $permanentAddressErr =$SSCErr = $HSCErr = "";

	$successfulMessage = $errorMessage = "";

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$firstName = $_POST['firstname'];
		$lastName = $_POST['lastname'];
        $phoneNum = $_POST['phonenum'];
        $presentAddress = $_POST['presentAddress'];
        $permanentAddress = $_POST['permanentAddress'];
        $SSC = $_POST['SSC'];
        $HSC = $_POST['HSC'];


		if(empty($firstName)) {
			$firstNameErr = "First name can not be empty!";
			$isValid = false;
		}
		if(empty($lastName)) {
			$lastNameErr = "Last name can not be empty!";
			$isValid = false;
		}
		if(empty($phoneNum)) {
			$phoneNumErr = "Phone Number can not be empty!";
			$isValid = false;
		}
		if(empty($presentAddress)) {
			$presentAddressErr = "Present Address can not be empty!";
			$isValid = false;
		}
		if(empty($permanentAddress)) {
			$permanentAddressErr = "Permanent Address can not be empty!";
			$isValid = false;
		}
		if(empty($SSC)) {
			$SSCErr = "SSC result can not be empty!";
			$isValid = false;
		}
		if(empty($HSC)) {
			$HSCErr = "HSC result can not be empty!";
			$isValid = false;
		}

		if($isValid) {
			$firstName = test_input($firstName);
            $lastName  = test_input($lastName);
            $phoneNum  = test_input($phoneNum);
            $presentAddress  = test_input($presentAddress);
            $permanentAddress  = test_input($permanentAddress);
            $SSC  = test_input($SSC);
            $HSC  = test_input($HSC);
     


			$data[] = array('firstname' => $firstName,'lastname' => $lastName,'phonenum' => $phoneNum, 'presentAddress' => $presentAddress, 'permanentAddress' => $permanentAddress, 'SSC' => $SSC, 'HSC' => $HSC,);
			 $data_encode = json_encode($data);
			$result1 = write($data_encode);
			if($result1) {
				$successfulMessage = "Registered successfully.";
			}
			else {
				$errorMessage = "Error while saving.";
			}
		}
	}
	function write($content) {
			$resource = fopen(filepath, "a");
			$fw = fwrite($resource, $content . "\n");
			fclose($resource);
			return $fw;
	}
	function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Graduate Apply Form</title>
</head>
<body style = "background-color: #A9CCE3">
<h1><p align="middle">Graduate Apply Form</h1></p><hr>
        <p align="middle";>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<br><br>
        	<marquee direction="right"  bgcolor="#2980B9">
<h1><a href="#" style="color:white";>American International University-Bangladesh</a></h1></marquee>
<br><br><br>
        	<fieldset>
        		<legend>Student details:</legend>
        	
        <label for="firstname">First Name:</label>
			<input type="text" name="firstname" id="firstname">
			<span style="color:red"><?php echo $firstNameErr; ?></span>

			<br><br>

			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" id="lastname">
			<span style="color:red"><?php echo $lastNameErr; ?></span>

			<br><br>

			<label for="phonenum">Phone:</label>
			<input type="tel" name="phonenum" id="phonenum">
			<span style="color:red"><?php echo $phoneNumErr; ?></span>
			<br><br>

			<label for="presentAddress">Present Address:</label>
			<input type="text" name="presentAddress" id="presentAddress">
			<span style="color:red"><?php echo $presentAddressErr; ?></span>

			<br><br>

			<label for="permanentAddress">Permanent Address:</label>
			<input type="text" name="permanentAddress" id="permanentAddress">
			<span style="color:red"><?php echo $permanentAddressErr; ?></span>

			<br><br>

			<label for="SSC">SSC:</label>
			<input type="text" name="SSC" id="SSC">
			<span style="color:red"><?php echo $SSCErr; ?></span>

			<br><br>

			<label for="HSC">HSC:</label>
			<input type="text" name="HSC" id="HSC">
			<span style="color:red"><?php echo $HSCErr; ?></span>

			<br><br>
     
            <input type="submit" name="submit" value="Register">
            <br><br>
        </fieldset>

        </form>
        <p style="color:green;"><?php echo $successfulMessage; ?></p>
	    <p style="color:red;"><?php echo $errorMessage; ?></p>

</body>
</html>