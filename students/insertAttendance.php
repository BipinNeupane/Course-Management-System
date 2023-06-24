<?php
session_start();
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']){
?>
<?php
require "../sqlQueries.php";

if (isset($_SESSION['student_id'])) {
   
    $date_time = date('Y-m-d H:i:s');
    
    $data = array(
        'student_id' => $_SESSION['student_id'],
        'date' => date('Y-m-d'),
        'class_id'=>$_GET['id'],
        'Present' => true ,
        'joinedTime'=>$date_time
    );
    insertData('attendance', $data);
}
    

?>
<?php }else{
	require'loginPage.php';
}