<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Student</title>
    <style>
        		body{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
		}
		.my-grades-header {
        text-align: center;
        background-color: black;
        padding: 20px;
        margin-bottom: 30px;
      }
      .my-grades{
        color: white;
      }
		.container{
			width: 80%;
			margin: 0 auto;
			text-align: center;
		}
		.title{
			font-size: 36px;
			font-weight: bold;
			text-align: center;
			margin-top: 50px;
			margin-bottom: 30px;
		}
		hr{
			margin-bottom: 30px;
			border: none;
			border-top: 3px solid #333;
		}
		.card{
			width: 80%;
			background-color: #fff;
			margin: 10px auto;
			padding: 20px;
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
			border-top: 4px solid;
			border-top-color: #<?php echo sprintf('%06X', mt_rand(0, 0xFFFFFF)); ?>;
			transition: all 0.3s ease-in-out;
		}
		.card:hover{
			transform: scale(1.05);
			box-shadow: 0 8px 16px rgba(0,0,0,0.3);
		}
		.card h2{
			font-weight: bold;
			font-size: 24px;
			margin-bottom: 10px;
		}
		.card p{
			margin: 0;
			padding: 0;
		}
		.card a{
			font-weight: bold;
			float: right;
			margin-top: 10px;
			color: #333;
			text-decoration: none;
		}
	</style>
</head>
<div class="sectionDivision">  
<?php
require 'StudentSidebar.php';
?>
<div id="main">
<?php
// require'header.php';
require'../sqlQueries.php';
?>
<body>
<header class="my-grades-header">
<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-grades">Grades</h1>
      <div class="my-grades">2022/2023</div>
    </header>
	<?php
$course_data = selectData('student', 'course_id', "student_id = '".$_SESSION["student_id"]."'");
if (!empty($course_data)) {
  // Extract the course ID from the first row of the data
  $course_id = $course_data[0]['course_id'];
} else {
  echo "No course data found for the logged-in student.";
}
$module = selectData('module','*','course_id='.$course_id);
foreach($module as $row){
?>
		<div class="card">
			<h2><?php echo $row['module_id']."- ".$row['module_name'];?></h2>
			<a href="findGrade.php?id=<?php echo $row['module_id']?>">View Grades</a>
		</div>
		<?php } ?>
	</div>
</body>

</html>
<?php
}else {
    // Redirect the user to the login page if they're not already logged in
    header('Location: loginPage.php');
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