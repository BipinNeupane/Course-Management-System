
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    body {
	margin: 0;
	padding: 0;
	font-family: Arial, sans-serif;
}

.login-container {
	display: flex;
	flex-direction: row;
    
}

.background-image {
	background-image: url(students/uni.png);
	background-size: cover;
	background-position: center;
	height: 100vh;
	width: 60%;
}

.login-box {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	width: 40%;
	height: 100vh;
	background-color: #f1f1f1;
}

.login-box img {
	max-width: 50%;
	margin-bottom: 20px;
}

.login-box h2 {
	margin: 0;
	margin-bottom: 20px;
}

form {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}

.input-container {
	display: flex;
	align-items: center;
	width: 200%;
	/* background-color: gray; */
	margin-bottom: 20px;
}

input[type="text"], input[type="password"] {
	padding: 10px;
	border-radius: 5px;
	border: none;
	background-color: lightgray;
	width: 100%;
}

.submit-button {
	background-color: green;
	color: white;
	border: none;
	border-radius: 5px;
	padding: 10px;
	width: 100%;
	cursor: pointer;
	transition: background-color 0.3s ease;
}

.submit-button:hover {
	background-color: darkgreen;
}

@media screen and (max-width: 768px) {
	.login-container {
		flex-direction: column;
	}
	
	.background-image {
		width: 100%;
		height: auto;
	}
	
	.login-box {
		width: 100%;
		height: auto;
	}
}

</style>
<?php
if (isset($_POST['submit'])) {
    require 'connection.php';
    require 'sqlQueries.php';
    // Get the values of the student ID and password from the form
    $student_id = $_POST["university-id"];
    $password = $_POST["password"];

    // Build the SELECT query with a WHERE condition
    $data = selectData('staff', '*', "staff_id = '$student_id' AND password = '$password' AND type = 'admin'");
    if (!empty($data)) {
        // The student ID and password match, so log in the user
        session_start();
        $_SESSION['Aloggedin'] = true;
        $_SESSION["staff_id"] = $student_id;
        header("Location:Student.php");
        exit();
    } else {
        $error_message = "Invalid student ID or password.";
    }
}

?>

<body>
	<div class="login-container">
		<div class="background-image"></div>
		<div class="login-box">
			<img src="wuclogo.png" alt="University Logo">
			<h2>WUC Login</h2>
			<form action="loginPage.php" method="POST">
				<div class="input-container">
					<input type="text" id="university-id" name="university-id" placeholder="University ID" required>
				</div>
				<div class="input-container">
					<input type="password" id="password" name="password" placeholder="Password" required>
				</div>
				<?php
				if (!empty($error_message)) {
					echo $error_message;
				}				
				?>
				<button type="submit" name="submit" class="submit-button">Login</button>
			</form>
		</div>
	</div>
</body>
</html>
