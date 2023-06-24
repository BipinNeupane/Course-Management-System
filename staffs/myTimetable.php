<?php
session_start();
if(isset($_SESSION['Sloggedin'])&& $_SESSION['Sloggedin']){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Timetable</title>
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
    </style>
</head>
<body>
<div class="sectionDivision">  
<?php
require 'staffSidebar.php';
?>
<div id="main">

    <header class="my-courses-header">
    <input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Timetable</h1>
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
    <?php
require '../connection.php';
require '../sqlQueries.php';
// Join the timetable table with the courses table to get the course name
// Join the timetable table with the modules table to get the module name
// Join the timetable table with the staff table to get the staff name
$query = "SELECT timetable.timetable_id,timetable.startDateTime, timetable.endDateTime, timetable.room, course.course_name, module.module_name, staff.staffName 
          FROM timetable 
          JOIN course ON timetable.course_id = course.course_id 
          JOIN module ON timetable.module_id = module.module_id 
          JOIN staff ON timetable.staff_id = staff.staff_id 
          WHERE timetable.status = 1 AND timetable.staff_id = ".$_SESSION['staff_id']."
          ORDER BY timetable.startDateTime ASC";
$timetableData = selectCustomData($query);
?>
<table>
  <thead>
    <tr>
      <th>Start Date Time</th>
      <th>End Date Time</th>
      <th>Room</th>
      <th>Module Name</th>
      <th>Tutor</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($timetableData as $data): ?>
      <tr>
        <td><?php echo $data['startDateTime']; ?></td>
        <td><?php echo $data['endDateTime']; ?></td>
        <td><?php echo $data['room']; ?></td>
        <td><?php echo $data['module_name']; ?></td>
        <td><?php echo $data['staffName']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


    </div>
  </body>
</html>
<?php }else{
	require'staffLogin.php';
}?>
<script>
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');

hamburger.addEventListener('click', () => {
  sidebar.classList.toggle('active');
  hamburger.classList.toggle('active');
});
</script>