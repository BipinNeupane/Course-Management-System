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
      /* Style for the header */
      .my-courses-header {
        text-align: center;
        background-color: black;
        padding: 20px;
        margin-bottom: 30px;
      }
      .my-courses{
        color: white;
      }

      /* Style for the filter dropdown */
      .filter {
        float: right;
      }

      /* Style for the card container */
      .card-container {
        display: flex;
        flex-wrap: wrap;
        float:left;
      }

      /* Style for the course cards */
      .card {
        width: 250px;
        padding: 20px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        transition: all 0.3s ease;
      }

      .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
      }

      /* Style for the course code and title */
      .course-code {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
      }

      .course-title {
        color: #888;
        font-size: 16px;
      }
    </style>
</head>
<body>
<div class="sectionDivision">  
<?php
require 'studentSidebar.php';
?>
<div id="main">
<?php
// require'header.php';
require '../connection.php';
require'../sqlQueries.php';
?>
    <header class="my-courses-header">
    <input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">My Courses</h1>
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

    <!-- Course card container -->
    <div class="card-container">
      <!-- Course card 1 -->
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
  <a href="myCourseDetail.php?id=<?php echo $row['module_id']; ?>">
    <div class="course-code"><?php echo $row['module_id'];?></div>
    <div class="course-title"><?php echo $row['module_name'];?></div>
    </a>
  </div>
<?php } ?>
    </div>
  </body>
</html>
<?php }
else{
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