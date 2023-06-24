<?php 
session_start();
ob_start();
if (isset($_SESSION['Sloggedin']) && $_SESSION['Sloggedin'] == true) {
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Course Detail</title>
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

      .container {
  display: flex;
  flex-direction:column;
}

.card {
  width: 100%;
  margin: 10px;
  border: 1px solid black;
}

.card-header {
  background-color: lightgray;
  cursor: pointer;
  padding: 10px;
}

.card-body {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
  padding: 10px;
}

      
    </style>
</head>
<body>
<div class="sectionDivision">  
<?php
require 'staffSidebar.php';
?>
<div id="main">
<?php
// require'header.php';
require '../connection.php';
require'../sqlQueries.php';
$course_data = selectData('module', '*', "module_id = '".$_GET['id']."'");
if (!empty($course_data)) {
  // Extract the course ID from the first row of the data
  $course_name = $course_data[0]['module_name'];
} else {
  echo "No course data found for the logged-in student.";
}
?>
    <header class="my-courses-header">
    <input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses"><?php echo $course_name; ?></h1>
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
    <div class="card">
    <div class="card-header" onclick="toggleCard(3)" style="font-size:2rem">Resources</div>
    <div class="card-body" id="card-body-3">
      <p style="color:green">ADD RESOURCE</p>
    <form action ="staffCourseDetail.php?id=<?php echo $_GET['id']?>" method="POST" enctype="multipart/form-data">
    <label> Resource Name </label>
    <input type="text" name="resourceName" required>
    <input type="file" name="assignment" id="assignment" required>
    <input type="submit" name="submit" value="Upload">
    </form><hr>
    <?php 
        $resource = selectData('resource','*','module_id='.$_GET['id']);
        foreach($resource as $row){
        ?>
      <p><a href="#"><?php echo $row['resourceName']; ?></a></p>
      <a href='../downloadAssignment.php?id=<?php echo $row['resource_id'];?>'><i class='fa-solid fa-download'></i></a>
      <hr>
      <?php } ?>
    </div>
  </div>

  <div class="card">
    <div class="card-header" onclick="toggleCard(2)" style="font-size:2rem">Assignment</div>
    <div class="card-body" id="card-body-2">
        <?php 
        $assignment = selectData('assignment','*','module_id='.$_GET['id']);
        foreach($assignment as $row){
        ?>
      <p><a href="#"><?php echo $row['assignment_name']; ?></a></p>
      <a href='../downloadAssignment.php?id=<?php echo $row['assignment_id'];?>'><i class='fa-solid fa-download'></i></a>
      <p>DUE DATE: <?php echo $row['dueDate']; ?></p><hr>
      <?php } ?>
    </div>
  </div>
  
</div>


    </div>
  </body>
</html>

<script>
  function toggleCard(cardNum) {
  var cardBody = document.getElementById('card-body-' + cardNum);
  if (cardBody.style.maxHeight) {
    cardBody.style.maxHeight = null;
  } else {
    cardBody.style.maxHeight = cardBody.scrollHeight + "px";
  }
}
  </script>
  <?php
 if (isset($_POST['submit'])) {
    try {
        $data = array(
            'resourceName' => $_POST['resourceName'],
            'module_id'=> $_GET['id']
        );

        
            $newFileName = $_FILES['assignment']['name'];
            $uploadDir = "resource/";
            $targetFilePath = $uploadDir . $newFileName;

            // Rename file to assignment name
            $data['resource'] = $targetFilePath;

            // Upload file to server
            //move_uploaded_file($_FILES["assignment"]["tmp_name"], $targetFilePath);

            insertData('resource', $data);
            header('Location:staffCourseDetail.php?id='.$_GET['id']);
                 
            
        
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<?php }
else{
  // Redirect the user to the login page if they're not already logged in
  header('Location: staffLogin.php');
  exit;
  ob_end_flush();
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
