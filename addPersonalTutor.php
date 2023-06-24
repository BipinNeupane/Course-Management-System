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
    <title><?php echo empty($_GET['id']) ? 'Add Personal Tutor' : 'Edit Personal Tutor'; ?></title>
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
      <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Personal Tutor' : 'Edit Personal Tutor'; ?></h1>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
    <?php
    require 'connection.php';
    require 'sqlQueries.php';

    $pt = array();
    $pt['personal_tutor_id'] = '';
    $pt['name'] = '';
    $pt['staff_id'] = '';
    $pt['student_id'] = '';

    if (isset($_GET['id'])) {
        $pt = selectDataById('personaltutor', $_GET['id'], 'personal_tutor_id');
    }

    if (isset($_POST['submit'])) {
        try {
            $data = array(
                'name' => $_POST['name'],
                'staff_id' => $_POST['staff_id'],
                'student_id' => $_POST['student_id'],
            );

            if (empty($_POST['pt_id'])) {
                insertData('personaltutor', $data);
            } else {
                updateData('personaltutor', $data, 'personal_tutor_id', $_POST['pt_id']);
            }
            
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
    <form action="addPersonalTutor.php" method="POST">
        <input type="hidden" name="pt_id" value="<?php echo $pt['personal_tutor_id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $pt['name']; ?>" required><br><br>
        <label for="staff_id">Staff ID:</label>
        <select name="staff_id" id="staff_id">
            <option value=<?php echo $pt['staff_id']?>><?php $staff = selectDataById('staff',$pt['staff_id'],'staff_id');
            if(!empty($staff)){echo $staff['staffName'];}?></option>
        <?php
        $staff = selectData('staff','*','status=1');
        foreach($staff as $row){
        ?>
        <option value="<?php echo $row['staff_id']?>"><?php echo $row['staffName'];?><option>
        <?php } ?>
        </select><br><br>
        <label for="student_id">Student ID:</label>
        <select name="student_id" id="student_id">
            <option value=<?php echo $pt['student_id']?>><?php $student = selectDataById('student',$pt['student_id'],'student_id');
            if(!empty($student)){echo $student['studentName'];}?></option>
        <?php
        $student = selectData('student','*','status=1');
        foreach($student as $row){
        ?>
        <option value="<?php echo $row['student_id']?>"><?php echo $row['studentName'];?><option>
        <?php } ?>
        </select><br><br>
        <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Personal Tutor' : 'Update Personal Tutor'; ?>">
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