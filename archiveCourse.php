<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'0'
);
updateData('course',$data,'course_id',$_GET['id']);
header('Location:course.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>