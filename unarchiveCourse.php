<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'1'
);
updateData('course',$data,'course_id',$_GET['id']);
header('Location:courseArchive.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>