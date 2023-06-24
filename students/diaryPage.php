<?php
session_start();
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Diary Page</title>
    <style>
		.diary-entry {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
}

.diary-title {
  font-size: 24px;
  font-weight: bold;
}

.diary-date {
  font-size: 14px;
  color: #999;
}

.diary-description {
  font-size: 16px;
}

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
	</style>
</head>
<body>

  <div class="sectionDivision">  
    <?php require'studentSidebar.php'?>
  <div id="main">
  <header class="my-courses-header">
  <input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Diary</h1>
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
    <div id="diary-content">
    <?php
    require '../connection.php';
    require '../sqlQueries.php';

    $diary = selectDataById('diary',$_GET['id'],'diary_id');

    
    echo '<div class="diary-entry">';
    echo '<h2 class="diary-title">' . $diary['title'] . '</h2>';
    echo '<p class="diary-date">' . $diary['date'] . '</p>';
    echo '<p class="diary-description">' . $diary['description'] . '</p>';
    echo '</div>';
    
    
    ?>

</div>

</div>
</div>
</body>
</html>
<?php }else{
	require'loginPage.php';
}?>
<script>
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');

hamburger.addEventListener('click', () => {
  sidebar.classList.toggle('active');
  hamburger.classList.toggle('active');
});
</script>