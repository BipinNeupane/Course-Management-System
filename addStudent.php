<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo empty($_GET['id']) ? 'Add Student' : 'Edit Student'; ?></title>
    <style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0 0 10px #ccc;
			width: 500px;
			margin: 50px auto;
		}

		input[type="text"], select {
			padding: 10px;
			margin: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 80%;
			font-size: 1.2em;
			outline: none;
		}

		label {
			font-size: 1.2em;
			margin-bottom: 5px;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 1.2em;
			margin-top: 20px;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		h1 {
			text-align: center;
			margin-top: 50px;
		}
	</style>
</head>
<body>

  <div class="sectionDivision">  
<?php require'sidebar.php';?>
<div id="main">
<header class="my-courses-header">
<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Student' : 'Edit Student'; ?></h1>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
<?php
require 'connection.php';
require 'sqlQueries.php';

if (isset($_POST['submit'])) {
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = 4;
    $random_string = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    try {
        if (empty($_POST['student_id'])) {
            $random_string = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 1, 3);
            $random = date("Y") . $random_string . rand(100, 10000);
            $data = array(
                'student_id' => $random,
                'studentName' => $_POST['name'],
                'email' => $_POST['email'],
                'studentContact' => $_POST['phone'],
                'status'=>1,
                'course_id'=>$_POST['course'],
                'password'=>$_POST['password']
            );
            insertData('student', $data);
        } else {
            $data = array(
                'studentName' => $_POST['name'],
                'email' => $_POST['email'],
                'studentContact' => $_POST['phone'],
                'course_id'=>$_POST['course'],
                'password'=>$_POST['password']
            );
            updateData('student', $data, 'student_id', $_POST['student_id']);
        }
        //header('Location: sidebar.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "updated sucessfully";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $student = selectData('student', '*', "student_id='$id'");
    //var_dump($student);
} else {
    $student = array();
    $student[0]['student_id'] = '';
    $student[0]['studentName'] = '';
    $student[0]['email'] = '';
    $student[0]['studentContact'] = '';
    $student[0]['course_id']='';
    $student[0]['password']='';
}


?>
<h1><?php echo empty($_GET['id']) ? 'Add Student' : 'Edit Student'; ?></h1>
    <form action="addStudent.php" method="POST">
        <input type="hidden" name="student_id" value="<?php echo $student[0]['student_id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $student[0]['studentName']; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $student[0]['email']; ?>" required><br><br>
        <label for="pasword">password:</label>
        <input type="password" name="password" id="password" value="<?php echo $student[0]['password']; ?>" required><br><br>
        <label for="course">Course:</label>
        <select name="course">
            <?php $course = selectData('course','*');
            foreach($course as $row){?>
            <option value="<?php echo $row['course_id']?>"><?php echo $row['course_name']?></option>
            <?php }?>
        </select>
        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" id="phone" value="<?php echo $student[0]['studentContact']; ?>" required><br><br>
        <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Student' : 'Update Student'; ?>">
    </form> 
</div>
</div>
</body>
</html>
<?php
}else{
    require'loginPage.php';
}
?>
<script>
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');

hamburger.addEventListener('click', () => {
  sidebar.classList.toggle('active');
  hamburger.classList.toggle('active');
});
</script>