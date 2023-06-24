<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'0'
);
updateData('assignment',$data,'assignment_id',$_GET['id']);
header('Location:assignment.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>
