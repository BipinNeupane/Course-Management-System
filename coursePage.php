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
    <title>Course Information</title>
    <style>
/* Center the main container */


/* Style the course details section */
#course-details {
  background-color: #f5f5f5;
  border: 1px solid #167e15;
  border-radius: 5px;
  padding: 20px;
}

#course-details h1 {
  margin-top: 0;
}

/* Style the table */
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #167e15;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f5f5f5;
}

/* Style the year heading */
h2 {
  margin-top: 30px;
}

/* Style the overall course information */
#course-info {
  background-color: #f5f5f5;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-top: 30px;
  padding: 20px;
}

#course-info h1 {
  margin-top: 0;
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
      <h1 class="my-courses">Course Information</h1>
      <div class="current-year" class="my-courses">2022/2023</div>
</header>
  <?php
    require 'connection.php';
    require 'sqlQueries.php';

    // Get the course data
    $course_id = $_GET['id'];
    $course = selectDataById('course', $course_id, 'course_id');
  ?>

<div id="course-details">
    <h1><?php echo $course['course_name']; ?></h1>
    <p><strong>Credits:</strong> <?php echo $course['courseCredits']; ?> years</p>
    <p><strong>Start Date:</strong> <?php echo $course['startDate']; ?></p>
    <p><strong>End Date:</strong> <?php echo $course['endDate']; ?></p>
</div>

<div id="structure">
<?php

// Get the course ID from the URL parameter
if (!isset($_GET['id'])) {
    exit('Course ID not specified');
}
$course_id = $_GET['id'];

// Get the course name and credits
$course = selectDataById('course', $course_id, 'course_id');
if (!$course) {
    exit('Invalid course ID');
}

$course_credits = $course['courseCredits'];

// Display the course name and credits

echo '<h1>' . 'Course Structure'. '</h1>';


// Loop through the years
for ($year = 1; $year <= $course_credits; $year++) {
    echo '<h2>Year ' . $year . '</h2>';
    echo '<table>';
    echo '<tr>
    <th>Code</th>
    <th>Title</th>
    <th>Credits</th>
    </tr>';

    // Fetch the modules for this year
    $modules = selectData('module', "*", "course_id = '$course_id' AND LearningYear = '$year' AND status=1");
    // Display the modules
    foreach ($modules as $module) {
        echo '<tr>';
        echo '<td>' . $module['module_id'] . '</td>';
        echo '<td>' . $module['module_name'] . '</td>';
        echo '<td>' . $module['moduleCredits'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<p>Student must take all modules.</p>';
}
?>
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