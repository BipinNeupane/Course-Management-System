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
    <title>Course</title>
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
        justify-content: left;
        
      }

      /* Style for the course cards */
      .card {
        width: 27.5%;
        padding: 20px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        margin-left: 5px;
        margin-right: 5px;
        transition: all 0.3s ease;
        background:skyblue;
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
        color: black;
        font-size: 16px;
      }
    </style>
</head>
<body>
<div class="sectionDivision">  
<?php
require 'sidebar.php';
?>
<div id="main">
<?php
// require'header.php';
require'sqlQueries.php';
?>
    <header class="my-courses-header">
    <input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Courses</h1>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>

    
    
    <!-- Course card container -->
    <div class="card-container">
      <!-- Course card 1 -->
      <?php 
     $data = selectData("course", "*","status=1");
         foreach ($data as $row) {
            ?>
     <a href="coursePage.php?id=<?php echo $row['course_id']?>"> <div class="card">
        <div class="course-title"><?php echo $row['course_name'];?></div></br>
        <div style="display:flex; flex-direction=row;">
         <a href="deleteCourse.php?id=<?php echo $row['course_id']?>" style="color:red; margin-left:12px;"><div><i class="fa fa-trash-o"></i></div></a>
         <a href="addCourse.php?id=<?php echo $row['course_id']?>" style="color:blue; margin-left:12px;"><div><i class="fa fa-edit"></i></div></a>
         <a href="archiveCourse.php?id=<?php echo $row['course_id']?>" style="color:green; margin-left:12px;"><div><i class="fa fa-archive"></i></div></a>
      </div>
         </div></a>
      <?php 
} 
?>
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