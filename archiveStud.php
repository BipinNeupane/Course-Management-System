<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'0'
);
updateData('student',$data,'student_id',$_GET['id']);
header('Location:Student.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>