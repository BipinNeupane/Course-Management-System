<?php 
session_start();
if(isset($_SESSION['Sloggedin'])&& $_SESSION['Sloggedin']==true){
?>
<?php
require'../sqlQueries.php';
// Set the table name and data to update
$table = "student_assignment";
$data = array("grade" => $_POST['grade']);

// Set the ID column and value for the WHERE clause
$idColumn = "id";
$idValue = $_GET['id']; // replace with the actual ID value

// Call the updateData() function to update the grade
updateData($table, $data, $idColumn, $idValue);
header("Location:Graded.php")

?>
<?php
}else{
    require'staffLogin.php';
}
?>