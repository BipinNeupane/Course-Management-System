<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'1'
);
updateData('timetable',$data,'timetable_id',$_GET['id']);
header('Location:timetableArchive.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>