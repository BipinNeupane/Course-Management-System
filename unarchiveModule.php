<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require'sqlQueries.php';
$data = array(
    'status'=>'1'
);
updateData('module',$data,'module_id',$_GET['id']);
header('Location:moduleArchive.php');
?>
<?php
}else{
    require'loginPage.php';
}
?>