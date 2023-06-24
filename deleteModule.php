<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require 'sqlQueries.php';

// Delete the timetable record
deleteData('timetable', $_GET['id'], 'module_id');
deleteData('resource', $_GET['id'], 'module_id');
// Delete all assignments for the module
$assignments = selectData('assignment', '*', 'module_id=' . $_GET['id']);
foreach ($assignments as $row) {
    // Delete all student_assignment records for the assignment
    deleteData('student_assignment', $row['assignment_id'], 'assignment_id');
    // Delete the assignment record
    deleteData('assignment', $row['assignment_id'], 'assignment_id');
}

// Delete the module record
deleteData('module', $_GET['id'], 'module_id');

// Redirect to the module page
header("Location: module.php");
?>
<?php
}else{
    require'loginPage.php';
}
?>
