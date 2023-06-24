
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
require'../sqlQueries.php';
// fetch diary entries from the database
$diary = selectData('diary', '*', 'student_id = '.$_SESSION['staff_id']);

// convert the diary entries to a JSON object
echo json_encode($diary);
}
else{
  // Redirect the user to the login page if they're not already logged in
  header('Location: staffLogin.php');
  exit;
}
?>
