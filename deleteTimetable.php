<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$table = 'timetable'; // the name of the table you want to delete from
$id = $_GET['id']; // the ID of the row you want to delete
deleteData($table, $id,'timetable_id');
header('Location:timetable.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>