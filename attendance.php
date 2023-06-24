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
    <title>Attendance</title>
    <style>
      .filtersA{
        display:flex;
      }
    </style>
</head>
<body>

  <div class="sectionDivision"> 
  <?php
require'sqlQueries.php';
?> 
<?php require'sidebar.php';?>
<div id="main">
<header class="my-courses-header">
<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Attendance</h1>
      <div class="current-year" class="my-courses">2022/2023</div>
      <div class="filtersA">
  <form action="attendance.php" method="POST">
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
    if (isset($_POST['filter1'])) {
      $selectedModule = $_POST['filter1'];
      ?>
      <div class="filter">
        <label for="filter2" style="color:white">Class: </label>
        <select name="filter2" id="filter2" onchange="this.form.submit()">
          <option value="">Select Class</option>
          <?php 
          $data = selectData('class', '*', "module_id = $selectedModule");
          foreach ($data as $row) {
            $selected = '';
            if (isset($_POST['filter2']) && $_POST['filter2'] == $row['class_id']) {
              $selected = 'selected';
            }
            ?>
            <option value="<?php echo $row['class_id']; ?>" <?php echo $selected; ?>><?php echo $row['class_id']; ?></option>
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
</div>
    </header>
  <div class="table-content">
    <table>
      <thead>
        <tr>
          <th>S.N</th>
          <th>Attendance ID</th>
          <th>Student ID</th>
          <th>Present</th>
          <th></th>
          <th></th>
          <th></th>
          <!-- Add more columns as needed -->
        </tr>
      </thead>
      <tbody>
        <?php
        require'connection.php';
        if (!empty($_POST['filter']) && empty($_POST['filter1']) && empty($_POST['filter2']) && empty($_POST['filter3'])) {
          // Only course is selected
          $selectedCourse = $_POST['filter'];
          $sql = "SELECT a.*
          FROM attendance a
          JOIN class c ON a.class_id = c.class_id
          JOIN module m ON c.module_id = m.module_id
          WHERE m.course_id = $selectedCourse
          ";
          $attendanceData = $conn->query($sql);
        } elseif (!empty($_POST['filter']) && !empty($_POST['filter1']) && empty($_POST['filter2']) && empty($_POST['filter3'])) {
          // Course and module are selected
          $selectedModule = $_POST['filter1'];
          $sql="SELECT attendance.*
          FROM attendance
          JOIN class ON attendance.class_id = class.class_id
          WHERE class.module_id = $selectedModule";
          $attendanceData = $conn->query($sql);
        } elseif (!empty($_POST['filter']) && !empty($_POST['filter1']) && !empty($_POST['filter2']) && empty($_POST['filter3'])) {
          // Course, module, and class are selected
          $selectedClass = $_POST['filter2'];
          $attendanceData = selectData('attendance', '*', 'class_id ='. $selectedClass);
        } elseif (!empty($_POST['filter']) && empty($_POST['filter1']) && empty($_POST['filter2']) && !empty($_POST['filter3'])) {
          // Course and student are selected
          $selectedStudent = $_POST['filter3'];
          $attendanceData = selectData('attendance', '*', "student_id='".$selectedStudent."'");
        } elseif (!empty($_POST['filter']) && !empty($_POST['filter1']) && empty($_POST['filter2']) && !empty($_POST['filter3'])) {
          // Course, module, and student are selected
          $selectedModule = $_POST['filter1'];
          $selectedStudent = $_POST['filter3'];
          $attendanceData = selectData('attendance', '*', "class_id IN (SELECT class_id FROM class WHERE module_id = $selectedModule) AND student_id = '$selectedStudent'");
        } elseif (!empty($_POST['filter']) && !empty($_POST['filter1']) && !empty($_POST['filter2']) && !empty($_POST['filter3'])) {
          // Course, module, class, and student are selected
          $selectedClass = $_POST['filter2'];
          $selectedStudent =$_POST['filter3'];
          $attendanceData = selectData('attendance', '*', "class_id=$selectedClass AND student_id='$selectedStudent'");
        }else{
          $attendanceData = selectData('attendance','*');
        }
        ?>
        <?php
        foreach ($attendanceData as $row) {
          $i = 1;
             ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $row['id'] ?></td>
              <td><?php echo $row['student_id'] ?></td>
              <td><?php  if($row['Present']==1){echo "Present";}else{echo "Absent";} ?></td>
            </tr>
        <?php
          }?>
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
<script>
  const filter = document.getElementById('filter');
  const filterOption = document.getElementById('filter-option');
  filter.addEventListener('change', function() {
    const selectedValue = filter.value;
    fetch(`fetch_options.php?filter=${selectedValue}`)
      .then(response => response.json())
      .then(data => {
        filterOption.innerHTML = '';
        data.forEach(option => {
          const optionElem = document.createElement('option');
          optionElem.value = option.value;
          optionElem.innerText = option.label;
          filterOption.appendChild(optionElem);
        });
      })
      .catch(error => console.error(error));
  });
</script>
<script>
  const filter = document.getElementById('filter');
  const filterOption = document.getElementById('filter-option');
  filter.addEventListener('change', function() {
    const selectedValue = filter.value;
    fetch(`fetch_options.php?filter=${selectedValue}`)
      .then(response => response.json())
      .then(data => {
        filterOption.innerHTML = '';
        data.forEach(option => {
          const optionElem = document.createElement('option');
          optionElem.value = option.value;
          optionElem.innerText = option.label;
          filterOption.appendChild(optionElem);
        });
      })
      .catch(error => console.error(error));
  });
</script>