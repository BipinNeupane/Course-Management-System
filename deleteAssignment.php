<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
deleteData('student_assignment',$_GET['id'],'assignment_id');
deleteData('assignment',$_GET['id'],'assignment_id');
header("Location:assignment.php");
?>
<?php
}else{
    require'loginPage.php';
}
?>