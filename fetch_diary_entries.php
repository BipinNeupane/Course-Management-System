<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
// fetch diary entries from the database
$diary = selectData('diary','*','staff_id='.$_SESSION['staff_id']);

// convert the diary entries to a JSON object
echo json_encode($diary);
?>
<?php
}else{
    require'loginPage.php';
}
?>
