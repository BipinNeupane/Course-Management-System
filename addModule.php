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
    <title><?php echo empty($_GET['id']) ? 'Add Module' : 'Edit Module'; ?></title>
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
      <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Module' : 'Edit Module'; ?></h1>
      <div class="current-year" class="my-courses">2022/2023</div>
</header>
    <?php
    require 'connection.php';
    require 'sqlQueries.php';

    if (isset($_POST['submit'])) {
        try {
            if (empty($_POST['module_id'])) {
                $data = array(
                    'module_code' => $_POST['module_code'],
                    'module_name' => $_POST['moduleName'],
                    'moduleCredits' => $_POST['moduleCredits'],
                    'LearningYear' => $_POST['learningYear'],
                    'course_id' => $_POST['courseId'],
                    'staff_id' => $_POST['staffId'],
                    'personal_tutor_id' => $_POST['personalTutorId'],
                    'status'=>'1'
                );
                insertData('module', $data);
            } else {
                $data = array(
                    'module_code'=>$_POST['module_code'],
                    'module_name' => $_POST['moduleName'],
                    'moduleCredits' => $_POST['moduleCredits'],
                    'LearningYear' => $_POST['learningYear'],
                    'course_id' => $_POST['courseId'],
                    'staff_id' => $_POST['staffId'],
                    'personal_tutor_id' => $_POST['personalTutorId']
                );
                updateData('module', $data, 'module_id', $_POST['module_id']);
            }
            //header('Location: sidebar.php');
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        echo "updated successfully";
    }

    if (isset($_GET['id'])) {
        $module = selectDataById('module', $_GET['id'], 'module_id');
    } else {
        $module = array();
        $module['module_id']='';
        $module['module_code'] = '';
        $module['module_name'] = '';
        $module['moduleCredits'] = '';
        $module['LearningYear'] = '';
        $module['course_id'] = '';
        $module['staff_id'] = '';
        $module['personal_tutor_id'] = '';
    }

    ?>
    
    <form action="addModule.php" method="POST">
        <input type="hidden" name="module_id" value="<?php echo $module['module_id']; ?>">
        <label for="module_id">Module Code:</label>
        <input type="text" name="module_code" value="<?php echo $module['module_code']; ?>">
        <label for="moduleName">Module Name:</label>
        <input type="text" name="moduleName" id="moduleName" value="<?php echo $module['module_name']; ?>" required><br><br>
        <label for="moduleCredits">Module Credits:</label>
        <input type="number" name="moduleCredits" id="moduleCredits" value="<?php echo $module['moduleCredits']; ?>" required><br><br>
        <label for="learningYear">Learning Year:</label>
        <input type="number" name="learningYear" id="learningYear" value="<?php echo $module['LearningYear']; ?>" required><br><br>
        <label for="courseId">Course:</label>
        <select name="courseId" id="courseId">
            <option value=<?php echo $module['course_id']?>><?php $course = selectDataById('course',$module['course_id'],'course_id');
            if(!empty($course)){echo $course['course_name'];}?></option><br><br>
        <?php
        $course = selectData('course','*','status=1');
        foreach($course as $row){
        ?>
        <option value="<?php echo $row['course_id']?>"><?php echo $row['course_name'];?><option>
        <?php } ?>
        </select>

        <label for="staffId">Staff ID:</label>
        <select name="staffId" id="staffId">
            <option value=<?php echo $module['staff_id']?>><?php $staff = selectDataById('staff',$module['staff_id'],'staff_id');
            if(!empty($staff)){echo $staff['staffName'];}?></option>
        <?php
        $staff = selectData('staff','*','status=1');
        foreach($staff as $row){
        ?>
        <option value="<?php echo $row['staff_id']?>"><?php echo $row['staffName'];?><option>
        <?php } ?>
        </select><br><br>

        <label for="personalTutorId">Personal Tutor ID:</label>
        <select name="personalTutorId" id="personalTutorId">
            <option value=<?php echo $module['personal_tutor_id']?>><?php $personalTutor = selectDataById('personaltutor',$module['personal_tutor_id'],'personal_tutor_id');
            if(!empty($personalTutor)){echo $personalTutor['name'];}?></option>
        <?php
        $personalTutor = selectData('personaltutor','*');
        foreach($personalTutor as $row){
        ?>
        <option value="<?php echo $row['personal_tutor_id']?>"><?php echo $row['name'];?><option>
        <?php } ?>
        </select>
        <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Module' : 'Update Module'; ?>">
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