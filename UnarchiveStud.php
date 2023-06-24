<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'1'
);
updateData('student',$data,'student_id',$_GET['id']);
header('Location:archiveStudent.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>