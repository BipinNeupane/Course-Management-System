<?php
session_start();
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']){
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
</head>
<body>

  <div class="sectionDivision">  
<?php require'studentSidebar.php';
require'../connection.php';?>
<div id="main">
<?php
require'../sqlQueries.php';
?>
<header class="my-courses-header">
<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Grades</h1>
      <div class="filter">
        <label for="filter" class="my-courses">Filter Courses:</label>
        <form action="Graded.php" method="POST">
        <select name="filter" id="filter">
        <?php 
         $data = selectData("module", "*", "staff_id='".$_SESSION['staff_id']."'");
         foreach($data as $row){
        ?>
          <option value="<?php echo $row['module_id']?>"><?php echo $row['module_name']?></option>
          <?php } ?>
        </select>
        <button>submit</button>
         </form>
      </div>
      <div class="current-year" class="my-courses">2022/2023</div>
</header>
  <div class="table-content">
    <table>
      <thead>
        <tr>
          <th>S.N</th>
          <th>Assignment Name</th>
          <th>Grade</th>
          <!-- Add more columns as needed -->
        </tr>
      </thead>
      <tbody>
      <?php
$sql = "SELECT sa.id, sa.grade, a.assignment_name 
FROM student_assignment sa 
INNER JOIN assignment a ON sa.assignment_id = a.assignment_id 
WHERE a.module_id = ".$_GET['id']." AND sa.isGraded = 0 AND sa.student_id ='".$_SESSION['student_id']."'";

  // Execute the query and get the result set
  $data = mysqli_query($conn, $sql);
  
  if ($data !== false) { // Check if $data is not false
    $i = 1;
    foreach ($data as $row) {
?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['assignment_name'] ?></td>
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
<?php }else{
	require'loginPage.php';
}?>
<script>
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');

hamburger.addEventListener('click', () => {
  sidebar.classList.toggle('active');
  hamburger.classList.toggle('active');
});
</script>