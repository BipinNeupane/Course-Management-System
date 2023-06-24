<?php 
session_start();
if(isset($_SESSION['Aloggedin'])&& $_SESSION['Aloggedin']==true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student</title>
</head>
<body>

  <div class="sectionDivision">  
<?php require'Sidebar.php';
require'connection.php';?>
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
      <h1 class="my-courses">Grades</h1>
      <div class="current-year" class="my-courses">2022/2023</div>
      <div class="filtersA">
  <form action="grade.php" method="POST">
    <div class="filter">
      <label for="filter" style="color:white">Course: </label>
      <select name="filter" id="filter" onchange="this.form.submit()">
        <option value="">Select Course</option>
        <?php 
        $data = selectData('course', '*');
        foreach ($data as $row) {
          $selected = '';
          if (isset($_POST['filter']) && $_POST['filter'] == $row['course_id']) {
            $selected = 'selected';
          }
          ?>
          <option value="<?php echo $row['course_id']; ?>" <?php echo $selected; ?>><?php echo $row['course_name']; ?></option>
        <?php 
        } 
        ?>
      </select>
    </div>
    
    <?php 
    if (isset($_POST['filter'])) {
      $selectedCourse = $_POST['filter'];
      ?>
      <div class="filter">
        <label for="filter1" style="color:white">Module: </label>
        <select name="filter1" id="filter1" onchange="this.form.submit()">
          <option value="">Select Module</option>
          <?php 
          $data = selectData('module', '*', "course_id = $selectedCourse");
          foreach ($data as $row) {
            $selected = '';
            if (isset($_POST['filter1']) && $_POST['filter1'] == $row['module_id']) {
              $selected = 'selected';
            }
            ?>
            <option value="<?php echo $row['module_id']; ?>" <?php echo $selected; ?>><?php echo $row['module_name']; ?></option>
          <?php 
          } 
          ?>
        </select>
      </div>
    <?php 
    } 
    ?>
    <?php 
    if (isset($_POST['filter'])) {
      $selectedCourse = $_POST['filter'];
      ?>
      <div class="filter">
        <label for="filter3" style="color:white">Student: </label>
        <select name="filter3" id="filter3" onchange="this.form.submit()">
          <option value="">Select Student</option>
          <?php 
          $data = selectData('student', '*', "course_id = $selectedCourse");
          foreach ($data as $row) {
            $selected = '';
            if (isset($_POST['filter3']) && $_POST['filter3'] == $row['student_id']){
              $selected ='selected';}
              ?>
              <option value="<?php echo $row['student_id']; ?>" <?php echo $selected; ?>><?php echo $row['studentName']; ?></option>
          <?php 
          } 
          ?>
        </select>
      </div>
    <?php 
  }
    ?>
</form>
</header>
  <div class="table-content">
    <table>
      <thead>
        <tr>
          <th>S.N</th>
          <th>Student ID</th>
          <th>Assignment Name</th>
          <th>Submission</th>
          <th>Grade</th>
          <!-- Add more columns as needed -->
        </tr>
      </thead>
      <tbody>
      <?php
 if (!empty($_POST['filter']) && empty($_POST['filter1']) && empty($_POST['filter2']) && empty($_POST['filter3'])) {
    $selectedCourse = $_POST['filter'];
    $sql = "SELECT sa.student_id, sa.id, sa.grade, a.assignment_name, m.module_name
    FROM student_assignment sa
    INNER JOIN assignment a ON sa.assignment_id = a.assignment_id
    INNER JOIN module m ON a.module_id = m.module_id
    WHERE m.course_id = $selectedCourse
    ";    
   $data = $conn->query($sql);
 }
 
 elseif (!empty($_POST['filter']) && !empty($_POST['filter1']) && empty($_POST['filter2']) && empty($_POST['filter3'])) {
   $selectedCourse = $_POST['filter'];
   $selectedModule = $_POST['filter1'];
   $sql = "SELECT sa.student_id,sa.id,sa.grade, a.assignment_name,m.module_name
   FROM student_assignment sa
   JOIN assignment a ON sa.assignment_id = a.assignment_id
   JOIN module m ON a.module_id = m.module_id
   WHERE m.module_id = $selectedModule ";
   $data = $conn->query($sql);
 }
 
 elseif (!empty($_POST['filter']) && empty($_POST['filter1']) && empty($_POST['filter2']) && !empty($_POST['filter3'])) {
   $selectedCourse = $_POST['filter'];
   $selectedStudent = $_POST['filter3'];
   $sql = "SELECT sa.*, a.assignment_name
           FROM student_assignment sa
           INNER JOIN assignment a ON sa.assignment_id = a.assignment_id
           WHERE sa.student_id = '" . $selectedStudent . "'";   
   $data = $conn->query($sql);
 }
 
 elseif (!empty($_POST['filter']) && !empty($_POST['filter1']) && empty($_POST['filter2']) && !empty($_POST['filter3'])) {
   $selectedCourse = $_POST['filter'];
   $selectedModule = $_POST['filter1'];
   $selectedStudent = $_POST['filter3'];
   $sql = "SELECT sa.*, a.assignment_name
   FROM student_assignment sa
   INNER JOIN assignment a ON sa.assignment_id = a.assignment_id
   INNER JOIN module m ON a.module_id = m.module_id
   WHERE sa.student_id = '" . $selectedStudent . "' AND m.module_id = $selectedModule";
   $data = $conn->query($sql);
 }
 else{
    $sql = "SELECT sa.student_id, sa.id, sa.grade, a.assignment_name 
    FROM student_assignment sa 
    INNER JOIN assignment a ON sa.assignment_id = a.assignment_id";
    $data = $conn->query($sql);
 }
  
  if ($data !== false) { // Check if $data is not false
    $i = 1;
    foreach ($data as $row) {
?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['student_id']; ?></td>
        <td><?php echo $row['assignment_name'] ?></td>
        <td><a href="downloadSubmission.php?id=<?php echo $row['id'] ?>" style="color:black"><i class="fa-solid fa-download" ></i></a></td>
        <td><?php echo $row['grade']?></td>
        <!-- Add more cells as needed -->
      </tr>
<?php
    }
  } else {
    echo "Failed to execute query: " . mysqli_error($conn);
  }
?>

      </tbody>
    </table>
  </div>
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