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
    <title>Student Information</title>
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
<?php require'sidebar.php';?>
<div id="main">
<?php
require'sqlQueries.php';
?>
<header class="my-courses-header">
<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Student Information</h1>
      <div class="filter">
        <label for="filter" class="my-courses">Filter Courses:</label>
        <select name="filter" id="filter">
          <option value="all">All</option>
        </select>
      </div>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
<div class="container">
		<img class="personimg" src="person.jpg" alt="Student Placeholder Image">
        <?php
        $data = selectData("student", "*", " student_id = '" . $_GET['id'] . "'");
if (!empty($data)) {
     $i = 1;
    foreach ($data as $row) {?>

		<h1><?php echo $row['studentName'];?></h1>
		<table>
			<tr>
				<th>Student ID:</th>
				<td><?php echo $row['student_id'];?></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><?php echo $row['email'];?></td>
			</tr>
			<tr>
				<th>Contact:</th>
				<td><?php echo $row['studentContact'];?></td>
			</tr>
			<tr>
				<th>Password:</th>
				<td><?php echo $row['password'];?></td>
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