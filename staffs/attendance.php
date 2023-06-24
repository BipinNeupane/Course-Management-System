<?php
session_start();
if(isset($_SESSION['Sloggedin']) && $_SESSION['Sloggedin']==true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Attendance</title>
</head>
<body>

  <div class="sectionDivision">  
<?php require'staffSidebar.php';?>
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
    </header>
<?php
require'../sqlQueries.php';
?>
  <div class="table-content">
    <table>
      <thead>
        <tr>
          <th>S.N</th>
          <th>Student Name</th>
          <th>Present</th>
          <th>Joined Date Time</th>
          <th></th>
          <th></th>
          <!-- Add more columns as needed -->
        </tr>
      </thead>
      <tbody>
        <?php
        $data = selectData("attendance", "*",'class_id='.$_GET['id']);
        $i =1;
          foreach ($data as $row) {
             ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <?php $names= selectData('student','studentName',"student_id='".$row['student_id']."'");
              $name = $names[0]['studentName'];?>
              <td><?php echo $name?></td>
              <td><?php  if($row['Present']==1){echo "Present";}else{echo "Absent";} ?></td>
              <td><?php echo $row['joinedTime'] ;?></td>
            </tr>
        <?php
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
    require'staffLogin.php';
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