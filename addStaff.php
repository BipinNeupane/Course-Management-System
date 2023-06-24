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
    <title><?php echo empty($_GET['id']) ? 'Add Staff' : 'Edit Staff'; ?></title>
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
      <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Staff' : 'Edit Staff'; ?></h1>
      <div class="current-year" class="my-courses">2022/2023</div>
</header>
<?php
require 'connection.php';
require 'sqlQueries.php';

if (isset($_POST['submit'])) {
    try {
        if (empty($_POST['staff_id'])) {
            $data = array(
                'staffName' => $_POST['name'],
                'staffEmail' => $_POST['email'],
                'staffContact' => $_POST['phone'],
                'status'=>'1',
                'password'=>$_POST['password'],
                'type'=>$_POST['type']
            );
            insertData('staff', $data);
        } else {
            $data = array(
                'staffName' => $_POST['name'],
                'staffEmail' => $_POST['email'],
                'staffContact' => $_POST['phone'],
                'status'=>'1',
                'password'=>$_POST['password'],
                'type'=>$_POST['type']
            );
            updateData('staff', $data, 'staff_id', $_POST['staff_id']);
        }
        //header('Location: sidebar.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "updated sucessfully";
}

if (isset($_GET['id'])) {
    $staff = selectDataById('staff', $_GET['id'],'staff_id');
} else {
    $staff = array();
    $staff['staff_id'] = '';
    $staff['staffName'] = '';
    $staff['StaffEmail'] = '';
    $staff['staffContact'] = '';
    $staff['password']='';
    $staff['type']='';
}


?>
<h1><?php echo empty($_GET['id']) ? 'Add Staff' : 'Edit Staff'; ?></h1>
    <form action="addStaff.php" method="POST">
        <input type="hidden" name="staff_id" value="<?php echo $staff['staff_id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $staff['staffName']; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $staff['StaffEmail']; ?>" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $staff['password']; ?>" required><br><br>
        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" id="phone" value="<?php echo $staff['staffContact']; ?>" required><br><br>
        <label for="type">Position:</label>
        <select name="type" id="type" value="<?php echo $staff['type']; ?>" required><br><br>
        <option value = "<?php echo $staff['type']; ?>" selected><?php echo $staff['type']; ?></option>
        <option value = "admin">Admin</option>
        <option value = "staff">Staff</option>
        <option value = "Course Leader">Course Leader</option>
</select>
        <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Staff' : 'Update Staff'; ?>">
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