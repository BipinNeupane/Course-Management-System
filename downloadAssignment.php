<?php
session_start();
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<?php
require 'connection.php';
// Fetch the file path from the database
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM assignment WHERE assignment_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$assignment = $result->fetch_assoc();
$filepath = $assignment['assignmentToDo'];

// Get the file extension
$extension = pathinfo($filepath, PATHINFO_EXTENSION);

// Set the appropriate headers
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));

// Read the file and output the content
readfile($filepath);
exit;
?>

<?php
}else{
    require'loginPage.php';
}
?>
