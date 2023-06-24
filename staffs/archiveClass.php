<?php 
session_start();
if(isset($_SESSION['Sloggedin'])&& $_SESSION['Sloggedin']==true){
?>
<?php
require'../sqlQueries.php';
$data = array(
    'status'=>'1'
);
updateData('class',$data,'class_id',$_GET['id']);
header('Location:class.php');
?>
<?php
}else{
    require'staffLogin.php';
}
?>