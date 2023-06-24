<?php 
session_start();
if (isset($_SESSION['Sloggedin']) && $_SESSION['Sloggedin'] == true) {
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Staff</title>
    <style>
		.container {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-top: 50px;
		}

		.personimg {
			width: 200px;
			height: 200px;
			object-fit: cover;
			border-radius: 50%;
			margin-bottom: 20px;
		}

		table {
			border-collapse: collapse;
			margin-top: 20px;
			width: 80%;
			max-width: 600px;
		}

		th, td {
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #f2f2f2;
		}

		h1 {
			text-align: center;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>

  <div class="sectionDivision">  
<?php require'staffSidebar.php';?>
<div id="main">
<?php
require'../sqlQueries.php';
?>
<header class="my-courses-header">
<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
<h1 class="my-courses">Staff Information</h1>
<div class="filter">
  <label for="filter" class="my-courses">Filter Courses:</label>
  <select name="filter" id="filter">
	<option value="all">All</option>
	<option value="completed">Completed</option>
	<option value="in-progress">In Progress</option>
  </select>
</div>
<div class="current-year" class="my-courses">2022/2023</div>
</header>
<div class="container">
		<img class="personimg" src="../person.jpg" alt="Student Placeholder Image">
        <?php
        $data = selectData("staff", "*", " staff_id = '" . $_SESSION['staff_id'] . "'");
if (!empty($data)) {
     $i = 1;
    foreach ($data as $row) {?>

		<h1><?php echo $row['staffName'];?></h1>
		<table>
			<tr>
				<th>Staff ID:</th>
				<td><?php echo $row['staff_id'];?></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><?php echo $row['StaffEmail'];?></td>
			</tr>
		</table>
        <?php
    }
}?>
	</div>
</div>
</div>
</body>
</html>
<?php }
else{
  // Redirect the user to the login page if they're not already logged in
  header('Location:staffLogin.php');
  exit;
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