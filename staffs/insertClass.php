<?php 
session_start();
if(isset($_SESSION['Sloggedin'])&& $_SESSION['Sloggedin']==true){
?>
<?php
require'../sqlQueries.php';
$table = "class";
$data = array(
    "classLink" => $_POST['link'],
"module_id"=>$_POST['module'],
"status"=>false);

insertData($table, $data);
header("Location:class.php");

?>
<?php
}else{
    require'staffLogin.php';
}
?>