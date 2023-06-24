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
    <title>Add Timetable Tutor</title>
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
          <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Timetable' : 'Edit Timetable'; ?></h1>
          <div class="current-year" class="my-courses">2022/2023</div>
        </header>
        <?php
    require 'connection.php';
    require 'sqlQueries.php';

    $timetable = array();
    $timetable['timetable_id']='';
    $timetable['staff_id'] = '';
    $timetable['module_id'] = '';
    $timetable['course_id'] = '';
    $timetable['room'] = '';
    $timetable['startDateTime'] = '';
    $timetable['endDateTime'] = '';

    if (isset($_GET['id'])) {
        $timetable = selectDataById('timetable', $_GET['id'], 'timetable_id');
    }

    if (isset($_POST['submit'])) {
        try {
            $data = array(
                'staff_id' => $_POST['staff_id'],
                'module_id' => $_POST['module_id'],
                'course_id' => $_POST['course_id'],
                'room' => $_POST['room'],
                'startDateTime' => $_POST['startDateTime'],
                'endDateTime' => $_POST['endDateTime'],
                'status'=>1
            );

            if (empty($_POST['timetable_id'])) {
                insertData('timetable', $data);
            } else {
                updateData('timetable', $data, 'timetable_id', $_POST['timetable_id']);
            }
            
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
    <h1><?php echo empty($_GET['id']) ? 'Add Timetable' : 'Edit Timetable'; ?></h1>
    <form action="addTimetable.php" method="POST">
        <input type="hidden" name="timetable_id" value="<?php echo $timetable['timetable_id']; ?>">
        <label for="staff_id">Staff ID:</label>
        <select name="staff_id" id="staff_id">
            <option value=<?php echo $timetable['staff_id']?>><?php $staff = selectDataById('staff',$timetable['staff_id'],'staff_id');
            if(!empty($staff)){echo $staff['staffName'];}?></option>
        <?php
        $staff = selectData('staff','*','status=1');
        foreach($staff as $row){
        ?>
        <option value="<?php echo $row['staff_id']?>"><?php echo $row['staffName'];?><option>
        <?php } ?>
        </select><br><br>
        
        <label for="module_id">Module ID:</label>
        <select name="module_id" id="module_id">
        <option value=<?php echo $timetable['module_id']?>><?php $assignment = selectDataById('module',$timetable['module_id'],'module_id');
            if(!empty($assignment)){echo $assignment['module_name'];}?></option>
        <?php
        $module = selectData('module','*','status=1');
        foreach($module as $row){
        ?>
        <option value="<?php echo $row['module_id']?>"><?php echo $row['module_name'];?><option>
        <?php } ?>
        </select><br><br>
        <label for="course_id">Course ID:</label>
        <select name="course_id" id="course_id">
            <option value=<?php echo $timetable['course_id']?>><?php $course = selectDataById('course',$timetable['course_id'],'course_id');
            if(!empty($course)){echo $course['course_name'];}?></option><br><br>
        <?php
        $course = selectData('course','*','status=1');
        foreach($course as $row){
        ?>
        <option value="<?php echo $row['course_id']?>"><?php echo $row['course_name'];?><option>
        <?php } ?>
        </select><br><br>
        <label for="room">Room:</label>
        <input type="text" name="room" id="room" value="<?php echo $timetable['room']; ?>" required><br><br>
        <label for="startDateTime">Start Date/Time:</label>
        <input type="datetime-local" name="startDateTime" id="startDateTime" value="<?php echo $timetable['startDateTime']; ?>" required><br><br>
        <label for="endDateTime">End Date/Time:</label>
        <input type="datetime-local" name="endDateTime" id="endDateTime" value="<?php echo $timetable['endDateTime']; ?>" required><br><br>
        <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Timetable' : 'Update Timetable'; ?>">
    </form>
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