<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'1'
);
updateData('assignment',$data,'assignment_id',$_GET['id']);
header('Location:assignmentArchive.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>