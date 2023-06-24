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
    <title><?php echo empty($_GET['id']) ? 'Add Course' : 'Edit Course'; ?></title>
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
      <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Course' : 'Edit Course'; ?></h1>
      <div class="current-year" class="my-courses">2022/2023</div>
</header>
    <?php
    require 'connection.php';
    require 'sqlQueries.php';

    if (isset($_POST['submit'])) {
        try {
            if (empty($_POST['course_id'])) {
                $data = array(
                    'course_name' => $_POST['courseName'],
                    'courseCredits' => $_POST['courseCredits'],
                    'startDate' => $_POST['courseSDate'],
                    'endDate' => $_POST['courseEDate'],
                    'status'=>'1',
                    'courseLeader'=>$_POST['courseLeader']
                );
                insertData('course', $data);
            } else {
                $data = array(
                    'course_name' => $_POST['courseName'],
                    'courseCredits' => $_POST['courseCredits'],
                    'startDate' => $_POST['courseSDate'],
                    'endDate' => $_POST['courseEDate'],
                    'courseLeader'=>$_POST['courseLeader']
                );
                updateData('course', $data, 'course_id', $_POST['course_id']);
            }
            //header('Location: sidebar.php');
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        echo "updated successfully";
    }

    if (isset($_GET['id'])) {
        $course = selectDataById('course', $_GET['id'], 'course_id');
    } else {
        $course = array();
        $course['course_id'] = '';
        $course['course_name'] = '';
        $course['courseCredits'] = '';
        $course['startDate'] = '';
        $course['endDate'] = '';
        $course['courseLeader']='';
    }

    ?>
    <h1><?php echo empty($_GET['id']) ? 'Add Course' : 'Edit Course'; ?></h1>
    <form action="addCourse.php" method="POST">
        <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
        <label for="courseName">Course Name:</label>
        <input type="text" name="courseName" id="courseName" value="<?php echo $course['course_name']; ?>" required><br><br>
        <label for="courseCredits">Course Credits:</label>
        <select name="courseCredits" id="courseCredits">
            <?php if(!empty($_GET['id'])){?>
            <option value ='<?php echo $course['courseCredits']; ?>' selected><?php echo $course['courseCredits']; ?> years</option>
            <option value="1"> 1 year</option>
            <option value="2"> 2 years</option>
            <option value="3"> 3 years</option>
            <option value="4"> 4 year</option>
        <?php }else{?>
            <option value="1"> 1 year</option>
            <option value="2"> 2 years</option>
            <option value="3"> 3 years</option>
            <option value="4"> 4 year</option>
        <?php } ?>
        </select><br><br>
        <label for="courseLeader">Course Leader:</label>
        <select name ="courseLeader">
            <?php
            if(!empty($_GET['id'])){
                $data = selectData('staff','staffName','staff_id='.$course['courseLeader']);?>
            <option value =<?php echo $course['courseLeader']?> selected><?php echo $data[0]['staffName'];?></option>
            <?php $res = selectData('staff','*','type="Course Leader"');
            foreach($res as $row){?>
           <option value="<?php echo $row['staff_id'];?>"><?php echo $row['staffName']; ?></option>
            <?php } 
        }else{
            $res = selectData('staff','*','type="Course Leader"');
            foreach($res as $row){?>
            <option value="<?php echo $row['staff_id'];?>"><?php echo $row['staffName']; ?></option>
            <?php
        }
    }?>
        </select><br><br>
        <label for="courseSDate">Course Start Date:</label>
        <input type="date" name="courseSDate" id="courseSDate" value="<?php echo $course['startDate']; ?>" required><br><br>
        <label for="courseEDate">Course End Date:</label>
        <input type="date" name="courseEDate" id="courseEDate" value="<?php echo $course['endDate']; ?>" required><br><br>
        <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Course' : 'Update Course'; ?>">
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