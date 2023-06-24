<?php
session_start();
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']){
?>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
session_start();
require'../sqlQueries.php';
// fetch diary entries from the database
$diary = selectData('diary', '*', "student_id = '".$_SESSION["student_id"]."'");

// convert the diary entries to a JSON object
echo json_encode($diary);
}
else{
  // Redirect the user to the login page if they're not already logged in
  header('Location: loginPage.php');
  exit;
}
?>
<?php }else{
	require'loginPage.php';
}
