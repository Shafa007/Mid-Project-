<?php define("filepath", "../files/support.JSON");
$firstName = $lastName = $userName = $password = $comment = "";
$isValid=true;

$firstNameErr = $lastNameErr = $userNameErr = $passwordErr = $commentErr = "";

$successfulMessage = $errorMessage = "";

if($_SERVER['REQUEST_METHOD']==="POST"){

	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$userName = $_POST['username'];
	$password = $_POST['password'];
	$comment = $_POST['comment'];

    if(empty($firstName)){
    	$firstNameErr = "Firstname can not be empty!";
    	$isValid = false;
    }
    if(empty($lastName)){
    	$lastNameErr = "Lastname can not be empty!";
    	$isValid = false;
    }
    if(empty($userName)){
    	$userNameErr = "Username can not be empty!";
    	$isValid = false;
    }
    if(empty($password)){
    	$passwordErr = "Password can not be empty!";
    	$isValid = false;
    }
    if(empty($comment)){
    	$commentErr = "Please write your problem briefly!";
    	$isValid = false;
    }
    
    if($isValid){
    	$firstName = test_input($firstName);
    	$lastName = test_input($lastName);
    	$userName = test_input($userName);
    	$password = test_input($password);
    	$comment = test_input($comment);

    	$data[] = array('firstname'=>$firstName, 'lastname'=>$lastName, 'username'=>$userName, 'password'=>$password, 'comment'=>$comment);
    	$data_encode = json_encode($data);
    	$result1 = write($data_encode);
    	if($result1){
    		$successfulMessage = "You will get feedback within 24hours.  Thank you for your patience.";
    	}
    	else{
    		$errorMessage = "Error while saving.";
    	}
    }
}

function write($content){
	$resource = fopen(filepath, "a");
	$fw = fwrite($resource, $content . "\n");
	fclose($resource);
	return $fw;
}
function test_input($data){
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
	<title>Help & Support</title>
</head>
<body style="background-color: #CCD1D1">
	<h1>Help & Support from Moderator:</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<fieldset>
			<legend>Fillup the form:</legend>
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" id="firstname">
			<span style="color:red"><?php echo $firstNameErr; ?></span>

			<br><br>
			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" id="lastname">
			<span style="color:red"><?php echo $lastNameErr; ?></span>

			<br><br>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username">
			<span style="color:red"><?php echo $userNameErr; ?></span>

			<br><br>

			<label for="password">Password:</label>
			<input type="password" name="password" id="password">
			<span style="color:red"><?php echo $passwordErr; ?></span>

			<br><br>

			<label for="comment">Write your problem here:</label>
			<input type="textarea" name="comment" id="comment">
			<span style="color:red"><?php echo $commentErr; ?></span>
			<br><br>
        <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
    <p style="color:green;"><?php echo $successfulMessage; ?></p>
	<p style="color:red;"><?php echo $errorMessage; ?></p>
</body>
</html>
