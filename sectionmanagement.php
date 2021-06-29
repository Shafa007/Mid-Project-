<?php define("filepath", "../files/sectionmanagement.JSON");
	$courseA =$courseB = $courseC = $courseD = "";
	$isValid = true;

	$courseAErr = $courseBErr = $courseCErr = $courseDErr =  "";

	$successfulMessage = $errorMessage = "";

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$courseA = $_POST['coursea'];
		$courseB = $_POST['courseb'];
		$courseC = $_POST['coursec'];
        $courseD = $_POST['coursed'];

		if(empty($courseA)) {
			$courseAErr = "Course section can not be empty!";
			$isValid = false;
		}
		if(empty($courseB)) {
			$courseBErr = "Course section can not be empty!";
			$isValid = false;
		}
		if(empty($courseC)) {
			$courseCErr = "Course section can not be empty!";
			$isValid = false;
		}
		if(empty($courseD)) {
			$courseDErr = "Course section can not be empty!";
			$isValid = false;
		}
		
		if($isValid) {
			$courseA = test_input($courseA);
            $courseB  = test_input($courseB);
            $courseC      = test_input($courseC);
            $courseD  = test_input($courseD);

			$data[] = array('coursea' => $courseA,'courseb' => $courseB, 'coursec' => $courseC ,'coursed' => $courseD);
			 $data_encode = json_encode($data);
			$result1 = write($data_encode);
			if($result1) {
				$successfulMessage = "Section given successfully.";
			}
			else {
				$errorMessage = "Error while giving section.";
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
	<title>Section Selection</title>
</head>
<body style="background-color: #EDBB99">
<h1><p align="left">Available Courses:</p></h1>
	<h2><p align="right">Duration: 13-17April 2021</p></h2><hr>
	<marquee direction="right"  bgcolor="#F7DC6F  ">
<h1><a href="#" style="color:black";>Course sections are given below</a></h1></marquee>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<br><br><br>
        	
        	
            <h3>Web-technology:</h3><br>
			<input type="checkbox" name="coursea"  value="Section A">
			<label for="coursea">Section A</label><br>
			<input type="checkbox" name="coursea"  value="Section C">
			<label for="coursea">Section C</label><br>
			<input type="checkbox" name="coursea"  value="Section G">
			<label for="coursea">Section G</label><br>
			<span style="color:red"><?php echo $courseAErr; ?></span><hr>

			<br>

			<h3>Compiler Design:</h3><br>
			<input type="checkbox" name="courseb"  value="Section B">
			<label for="courseb">Section B</label><br>
			<input type="checkbox" name="courseb"  value="Section C">
			<label for="courseb">Section C</label><br>
			<input type="checkbox" name="courseb"  value="Section F">
			<label for="courseb">Section F</label><br>
			<input type="checkbox" name="courseb"  value="Section H">
			<label for="courseb">Section H</label><br>
			<span style="color:red"><?php echo $courseBErr; ?></span><hr>

			<br>

			<h3>Theory of Computation:</h3><br>
			<input type="checkbox" name="coursec"  value="Section B">
			<label for="coursec">Section B</label><br>
			<input type="checkbox" name="coursec"  value="Section D">
			<label for="coursec">Section D</label><br>
			<input type="checkbox" name="coursec"  value="Section G">
			<label for="coursec">Section G</label><br>
			<input type="checkbox" name="coursec"  value="Section L">
			<label for="coursec">Section L</label><br>
			<span style="color:red"><?php echo $courseCErr; ?></span><hr>

			<br>

			<h3>Artificial Intelligency:</h3><br>
			<input type="checkbox" name="coursed"  value="Section D">
			<label for="coursed">Section D</label><br>
			<input type="checkbox" name="coursed"  value="Section G">
			<label for="coursed">Section G</label><br>
			<input type="checkbox" name="coursed"  value="Section I">
			<label for="coursed">Section I</label><br>
			<input type="checkbox" name="coursed"  value="Section L">
			<label for="coursed">Section L</label><br>
			<span style="color:red"><?php echo $courseDErr; ?></span><hr>
			<br><br>
     
            <input type="submit" name="submit" value="Register">
            <br>
       

        </form>
        <p style="color:green;"><?php echo $successfulMessage; ?></p>
	    <p style="color:red;"><?php echo $errorMessage; ?></p>

</body>
</html>