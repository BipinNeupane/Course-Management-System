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
      <h1 class="my-courses">Class</h1>
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

    <div id="class-info">
      
  <h2>Ongoing Class:</h2>
  <?php 
      $course_data = selectData('student', 'course_id', "student_id = '".$_SESSION["student_id"]."'");
      $course_id = $course_data[0]['course_id'];
      $module = selectData('module','*','course_id='.$course_id);
      foreach($module as $row){
        $data = selectData('class','*',"status=0 AND module_id=".$row['module_id']);
        foreach($data as $row){
      ?>
          <input type="hidden" value="<?php echo $row['module_id'];?>"></input>
          <p>Class link: <a href="<?php echo $row['classLink'];?>" onclick="setAttendance(<?php echo $row['class_id'];?>)"><?php echo $row['classLink'];?></a> </p>
    <?php  }
    }?>
</div>

      
 

    </div>
  </body>
</html>

<script>
    function setAttendance(id) {
  // Make an AJAX request to the server
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Response from server
      console.log(this.responseText);
    }
  };
  xhttp.open("GET", "insertAttendance.php?id="+id,true);
  xhttp.send();
}
</script>
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