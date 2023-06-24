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
    <script src="function.js"></script>
    <title>Student</title>
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

      <h1 class="my-courses">Student</h1>
      <div class="filter">
        <label for="filter" class="my-courses">Filter Courses:</label>
        <form action="Student.php" method="POST">
        <select name="filter" id="filter">
            <?php $course = selectData('course','*');
            foreach($course as $row){?>
            <option value="<?php echo $row['course_id']?>"><?php echo $row['course_name']?></option>
            <?php }?>
            
        </select>
        <button type="submit" name="submit">Search</button>
        </form>
      </div>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
<div class="search-container">
  <form action="Student.php" method="POST" style="margin-bottom:4px;">
    <input type="text" name="student_id" placeholder="Student ID" style="border:solid;">
    <button type="submit" name="search"><i class="fa fa-search"></i></button>
  </form>
</div>
<?php
if (!isset($_POST['search'])) {
?>
  <div class="table-content">
    <table>
      <thead>
        <tr>
          <th>S.N</th>
          <th>Student ID</th>
          <th>Student Name</th>
          <th>Course</th>
          <th></th>
          <th></th>
          <th></th>
          <!-- Add more columns as needed -->
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_POST['submit'])){
          $data = selectData("student", "*", "status = 1 AND course_id='".$_POST['filter']."'");
        }else{
        $data = selectData("student", "*", "status = 1");
        }
        if (!empty($data)) {
          $i = 1;
          foreach ($data as $row) {
            $course_info = selectData("course", "*", "course_id='" . $row['course_id'] . "'");
            if(isset($course_info[0])) {
              $course_name = $course_info[0]['course_name'];
          } else {
              $course_name = "Unknown";
          }
        ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><a href="studentPage.php?id=<?php echo $row['student_id'] ?>" style="color:black"><?php echo $row['student_id'] ?></a></td>
              <td><a href="studentPage.php?id=<?php echo $row['student_id'] ?>" style="color:black"><?php echo $row['studentName'] ?></a></td>
              <td><a href="studentPage.php?id=<?php echo $row['student_id'] ?>" style="color:black"><?php echo $course_name ?></a></td>
              <td><a href="deleteStudent.php?id=<?php echo $row['student_id'] ?>"><i class="fa fa-trash-o" style="font-size:20px;color:red"></a></td>
              <td><a href="addStudent.php<?php if(isset($row['student_id'])) { echo "?id=" . $row['student_id']; } ?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="archiveStud.php?id=<?php echo $row['student_id'] ?>"><i class="fa fa-archive"></i></a></td>
              <!-- Add more cells as needed -->
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
<?php
}
else{?>
<div class="table-content">
    <table>
  <thead>
    <tr>
      <th>S.N</th>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>course</th>
      <th></th>
      <th></th>
      <th></th>
      <!-- Add more columns as needed -->
    </tr>
  </thead>
  <tbody>
    <?php
  
  $data = selectData("student", "*", " status = 1 AND student_id = '" . $_POST['student_id'] . "'");
    
  if (!empty($data)) {
    $i = 1;
    foreach ($data as $row) {
      $course_info = selectData("course", "*", "course_id='" . $row['course_id'] . "'");
      if(isset($course_info[0])) {
        $course_name = $course_info[0]['course_name'];
    } else {
        $course_name = "Unknown";
    }
  ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><a href="studentPage.php?id=<?php echo $row['student_id'] ?>" style="color:black"><?php echo $row['student_id'] ?></a></td>
        <td><a href="studentPage.php?id=<?php echo $row['student_id'] ?>" style="color:black"><?php echo $row['studentName'] ?></a></td>
        <td><a href="studentPage.php?id=<?php echo $row['student_id'] ?>" style="color:black"><?php echo $course_name ?></a></td>
        <td><a href="deleteStudent.php?id=<?php echo $row['student_id'] ?>"><i class="fa fa-trash-o" style="font-size:20px;color:red"></a></td>
        <td><a href="addStudent.php<?php if(isset($row['student_id'])) { echo "?id=" . $row['student_id']; } ?>"><i class="fa fa-edit"></i></a></td>
        <td><a href="archiveStud.php?id=<?php echo $row['student_id'] ?>"><i class="fa fa-archive"></i></a></td>
        <!-- Add more cells as needed -->
      </tr>
  <?php
    }
  }
  ?>
</tbody>
</table>
</div>
<?php
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