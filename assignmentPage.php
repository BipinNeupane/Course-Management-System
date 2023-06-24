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
    <title>Assignment Information</title>
    <style>
        label{
            color:#f70303;
        }
    .assignment-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px 0;
    }
    .assignment-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .assignment-type, .due-date, .total-marks, .module-id {
        font-size: 18px;
        margin-bottom: 10px;
    }
    .download-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 20px;
    }
    .download-btn:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

  <div class="sectionDivision">  
  <?php
require 'connection.php';
require 'sqlQueries.php';

$assignment = array();
$assignment['assignment_id'] = '';
$assignment['assignment_name'] = '';
$assignment['assignment_type'] = '';
$assignment['assignment_file'] = '';
$assignment['due_date'] = '';
$assignment['total_marks'] = '';
$assignment['module_id'] = '';

if (isset($_GET['id'])) {
    $assignment = selectDataById('assignment', $_GET['id'], 'assignment_id');
}

if (isset($_POST['submit'])) {
    // Handle file upload and database update
}

?>

<div id="main">
<header class="my-courses-header">
<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Assignment Information</h1>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
    <?php 
    require'sidebar.php';
    ?>
    <div class="assignment-info">
        <label for="assignment_name">Assignment Name:</label>
        <span id="assignment_name"><?php echo $assignment['assignment_name']; ?></span>
        <br>
        <label for="assignment_type">Assignment Type:</label>
        <span id="assignment_type"><?php echo $assignment['assignmentType']; ?></span>
        <br>
        <label for="due_date">Due Date:</label>
        <span id="due_date"><?php echo $assignment['dueDate']; ?></span>
        <br>
        <label for="total_marks">Total Marks:</label>
        <span id="total_marks"><?php echo $assignment['totalMarks']; ?></span>
        <br>
        <label for="module_id">Module Name:</label>
        <?php $module = selectDataById('module',$assignment['module_id'],'module_id');?>
        <span id="module_id"><?php echo $module['module_name']; ?></span>
        <br>
        <?php if ($assignment['assignmentToDo'] != null) { ?>
            <a href="downloadAssignment.php?id=<?php echo $assignment['assignment_id']; ?>" class="download-btn">Download Assignment</a>
        <?php } ?><br>
        <label for="student">Student Assignment Assigned To:</label>
        <?php
$sql = 'SELECT studentName
        FROM student
        WHERE course_id = (
          SELECT course_id
          FROM module
          WHERE module_id = (
            SELECT module_id
            FROM assignment
            WHERE assignment_id = '.$_GET['id'].'
          )
        )';

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo '<p>'.$row['studentName'].'</p>';
}
?>

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