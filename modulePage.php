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
    <title>Module Information</title>
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
    .module-info {
  border: 1px solid #167e15;
  padding: 10px;
  margin: 10px;
  max-width: 1000px;
}

.module-info h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

.module-info p {
  font-size: 16px;
  margin-bottom: 5px;
}

.module-info strong {
  font-weight: bold;
  margin-right: 5px;
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
      <h1 class="my-courses">Module Information</h1>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
<div class="module-info">
  <?php
    require 'connection.php';
    require 'sqlQueries.php';
    

    // Get the module data
    $module_id = $_GET['id'];
    $module = selectDataById('module', $module_id, 'module_id');

    // Get the staff member data
    $staff_id = $module['staff_id'];
    $staff = selectDataById('staff', $staff_id, 'staff_id');

    // Get the personal tutor data
    $pt_id = $module['personal_tutor_id'];
    $pt = selectDataById('personaltutor', $pt_id, 'personal_tutor_id');
  ?>

  <h1 style="color:#79c907;"><?php echo $module['module_name']; ?></h1>
  <p><strong>Module Code:</strong> <?php echo $module['module_code']; ?></p>
  <p><strong>Credits:</strong> <?php echo $module['moduleCredits']; ?></p>
  <p><strong>Tutor:</strong> <?php echo $staff['staffName']; ?></p>
  <p><strong>Personal Tutor:</strong> <?php echo $pt['name']; ?></p>
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