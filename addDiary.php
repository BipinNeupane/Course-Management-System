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
    <title><?php echo empty($_GET['id']) ? 'Add Diary' : 'Edit Diary'; ?></title>
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
      <h1 class="my-courses"><?php echo empty($_GET['id']) ? 'Add Diary' : 'Edit Diary'; ?></h1>
      <div class="current-year" class="my-courses">2022/2023</div>
    </header>
    <?php
    require 'connection.php';
    require 'sqlQueries.php';
    $diary = array();
$diary['diary_id'] = '';
$diary['title'] = '';
$diary['description'] = '';
$diary['date'] = '';
$diary['staff_id']='';

if (isset($_GET['id'])) {
    $diary = selectDataById('diary', $_GET['id'], 'diary_id');
}

if (isset($_POST['submit'])) {
    try {
        $data = array(
            'title' => $_POST['title'],
            'description' => $_POST['content'],
            'date' => $_POST['date'],
			'staff_id'=>$_SESSION['staff_id'],
            'status'=>'0'
        );

        if (empty($_POST['diary_id'])) {
            insertData('diary', $data);
        } else {
            updateData('diary', $data, 'diary_id', $_POST['diary_id']);
        }
        
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<h1><?php echo empty($_GET['id']) ? 'Add Diary' : 'Edit Diary'; ?></h1>
<form action="addDiary.php" method="POST">
    <input type="hidden" name="diary_id" value="<?php echo $diary['diary_id']; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo $diary['title']; ?>" required><br><br>
    <label for="content">Content:</label>
    <textarea name="content" id="content" required><?php echo $diary['description']; ?></textarea><br><br>
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" value="<?php echo $diary['date']; ?>" required><br><br>
    <input type="submit" name="submit" value="<?php echo empty($_GET['id']) ? 'Add Diary' : 'Update Diary'; ?>">
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