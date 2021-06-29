<?php 
     define("filepath", "../files/pohelaboishakh.JSON");
	$firstName =$lastName = $ID = $phoneNum = "";
	$isValid = true;

	$firstNameErr = $lastNameErr = $IDErr = $phoneNumErr =  "";

	$successfulMessage = $errorMessage = "";

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$firstName = $_POST['firstname'];
		$lastName = $_POST['lastname'];
		$ID = $_POST['ID'];
        $phoneNum = $_POST['phonenum'];

		if(empty($firstName)) {
			$firstNameErr = "First name can not be empty!";
			$isValid = false;
		}
		if(empty($lastName)) {
			$lastNameErr = "Last name can not be empty!";
			$isValid = false;
		}
		if(empty($ID)) {
			$IDErr = "ID can not be empty!";
			$isValid = false;
		}
		if(empty($phoneNum)) {
			$phoneNumErr = "Phone Number can not be empty!";
			$isValid = false;
		}
		
		if($isValid) {
			$firstName = test_input($firstName);
            $lastName  = test_input($lastName);
            $ID      = test_input($ID);
            $phoneNum  = test_input($phoneNum);

			$data[] = array('firstname' => $firstName,'lastname' => $lastName, 'ID' => $ID ,'phonenum' => $phoneNum);
			 $data_encode = json_encode($data);
			$result1 = write($data_encode);
			if($result1) {
				$successfulMessage = "Registered successfully. Please take your entrance pass from Annex 2.";
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
	<title>Pohela Boishakh</title>
</head>
<body style="background-color:#B2BABB ">
<h1><p align="middle"><i>Pohela Boishakh(15th April 2021)</i></h1><hr>
	<h2><br><br>What's inside in our program?<br></h2>
		<h3>1.Pitha & sweet stalls.<br>
			2.Dance performance.<br>
			3.Concert by AIUB students.<br>
			4.Classical Bangla song program.<br></h3></p>

			<marquee direction="right"  bgcolor="#C0392B">
<h2><a href="#" style="color:white";>Want to attend? Please Register Below.</a></h2></marquee>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<br><br><br>
        	<fieldset>
        		<legend>Register for pass:</legend>
        	
        <label for="firstname">First Name:</label>
			<input type="text" name="firstname" id="firstname">
			<span style="color:red"><?php echo $firstNameErr; ?></span>

			<br><br>

			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" id="lastname">
			<span style="color:red"><?php echo $lastNameErr; ?></span>

			<br><br>

			<label for="ID">Id Number:</label>
			<input type="text" name="ID" id="ID">
			<span style="color:red"><?php echo $IDErr; ?></span>

			<br><br>

			<label for="phonenum">Phone:</label>
			<input type="tel" name="phonenum" id="phonenum">
			<span style="color:red"><?php echo $phoneNumErr; ?></span>
			<br><br>
     
            <input type="submit" name="submit" value="Register">
            <br>
        </fieldset>

        </form>
        <p style="color:green;"><?php echo $successfulMessage; ?></p>
	    <p style="color:red;"><?php echo $errorMessage; ?></p>



</body>
</html>