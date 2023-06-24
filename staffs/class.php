<?php 
error_reporting(0);?>
<?php 
session_start();
if(isset($_SESSION['Sloggedin'])&& $_SESSION['Sloggedin']==true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Class</title>
</head>
<body>

  <div class="sectionDivision">  
<?php require'staffSidebar.php';
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
      <h1 class="my-courses">My Courses</h1>
      <div class="filter">
        <label for="filter" class="my-courses">Filter Courses:</label>
        <form action="class.php" method="POST">
   <select name="filter">
      <option value="0" <?php if ($_SESSION['selected_option'] == '1') echo 'selected'; ?>>On going</option>
      <option value="1" <?php if ($_SESSION['selected_option'] == '0') echo 'selected'; ?>>Completed</option>
   </select>
        <button> Search </button>
</form>
      </div>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
  <div class="table-content">
    <form action ="insertClass.php" method="POST">
        <label  style="color:green;">Class Link:</label>
        <input type = "text" name="link">
        <label style="color:green;">Module:</label>
        <select name="module">
        <?php $course = selectData('module','*','staff_id='.$_SESSION['staff_id']);
        foreach($course as $row){?>
        <option value="<?php echo $row['module_id']?>"><?php echo $row['module_name']?></option>
        <?php }?>
        </select>
        <button>ADD</button>
    </form>
    <table>
      <thead>
        <tr>
          <th>S.N</th>
          <th>Class Link</th>
          <th><th>
          <th></th>
          <!-- Add more columns as needed -->
        </tr>
      </thead>
      <tbody>
      <?php
$_SESSION['selected_option']= $_POST['filter'];
  // Execute the query and get the result set
  if(isset($_POST['filter'])){
    $data = selectData('class','*','status='.$_POST['filter']);
  }else{
  $data = selectData('class','*','status=0');
  }
  if ($data !== false) { // Check if $data is not false
    $i = 1;
    foreach ($data as $row) {
?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><a href="<?php echo $row['classLink'] ?>"><?php echo $row['classLink'] ?></a></td>
        <td><a href="attendance.php?id=<?php echo $row['class_id'];?>" style="color:green">View attendance</a></td>
        <td><form action="archiveClass.php?id=<?php echo $row['class_id'];?>" method="POST">
            <button style="background:red;">Finish</button>
        </form>
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
