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
    <title><?php echo empty($_GET['id']) ? 'Add Assignment' : 'Edit Assignment'; ?></title>
    <style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0 0 10px #ccc;
			width: 500px;
			margin: 50px auto;
		}

		input[type="text"], select {
			padding: 10px;
			margin: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 80%;
			font-size: 1.2em;
			outline: none;
		}

		label {
			font-size: 1.2em;
			margin-bottom: 5px;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 1.2em;
			margin-top: 20px;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		h1 {
			text-align: center;
			margin-top: 50px;
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
      <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Assignment' : 'Edit Assignment'; ?></h1>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
    <?php
    require 'connection.php';
    require 'sqlQueries.php';

    $assignment = array();
    $assignment['assignment_id'] = '';
    $assignment['assignment_name'] = '';
    $assignment['assignmentType'] = '';
    $assignment['assignmentToDo'] = '';
    $assignment['dueDate'] = '';
    $assignment['totalMarks'] = '';
    $assignment['module_id'] = '';

    if (isset($_GET['id'])) {
        $assignment = selectDataById('assignment', $_GET['id'], 'assignment_id');
    }

    if (isset($_POST['submit'])) {
        try {
            $data = array(
                'assignment_name' => $_POST['assignment_name'],
                'assignmentType' => $_POST['assignmentType'],
                'dueDate' => $_POST['dueDate'],
                'totalMarks' => $_POST['totalMarks'],
                'module_id' => $_POST['module_id'],
                'status'=>1
            );
    
            if (empty($_POST['assignment_id'])) {
                $newFileName = $_FILES['assignmentToDo']['name'];
                $uploadDir = "uploads/";
                $targetFilePath = $uploadDir . $newFileName;
    
                // Rename file to assignment name
                $data['assignmentToDo'] = $targetFilePath;
    
                // Upload file to server
                move_uploaded_file($_FILES["assignmentToDo"]["tmp_name"], $targetFilePath);
    
                insertData('assignment', $data);
            } else {
                updateData('assignment', $data, 'assignment_id', $_POST['assignment_id']);
            }
            
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    ?>
    
    <form action="addAssignment.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="assignment_id" value="<?php echo $assignment['assignment_id']; ?>">
        <label for="assignment_name">Assignment Name:</label>
        <input type="text" name="assignment_name" id="assignment_name" value="<?php echo $assignment['assignment_name']; ?>" required><br><br>
        <label for="assignmentType">Assignment Type:</label>
        <input type="text" name="assignmentType" id="assignmentType" value="<?php echo $assignment['assignmentType']; ?>" required><br><br>
        <label for="assignmentToDo">Assignment To Do:</label>
        <?php if(isset($_GET['id'])){
    ?>
    <input type="file" name="assignmentToDo" id="assignmentToDo"><br><br>
<?php } else { ?>
    <input type="file" name="assignmentToDo" id="assignmentToDo" required><br><br>
<?php } ?>
        <label for="dueDate">Due Date:</label>
        <input type="date" name="dueDate" id="dueDate" value="<?php echo $assignment['dueDate']; ?>" required><br><br>
        <label for="totalMarks">Total Marks:</label>
        <input type="number" name="totalMarks" id="totalMarks" value="<?php echo $assignment['totalMarks']; ?>" required><br><br>
        <label for="module_id">Module ID:</label>
        <select name="module_id" id="module_id">
            <option value=<?php echo $assignment['module_id']?>><?php $assignment = selectDataById('module',$assignment['module_id'],'module_id');
            if(!empty($assignment)){echo $assignment['module_name'];}?></option>
        <?php
        $module = selectData('module','*','status=1');
        foreach($module as $row){
        ?>
        <option value="<?php echo $row['module_id']?>"><?php echo $row['module_name'];?><option>
        <?php } ?>
        </select>
        <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Assignment' : 'Update Assignment'; ?>">
    </form>
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