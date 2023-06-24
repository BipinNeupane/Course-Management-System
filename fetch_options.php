<?php

// Retrieve the selected filter values from the query string
$filter = $_GET['filter'];
$prevFilterValue = $_GET['prevFilterValue'] ?? '';

$dsn = 'mysql:host=localhost;dbname=courses';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
  $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
  echo $e->getMessage();
}

// Retrieve the data from the database based on the selected filter category and value
switch ($filter) {
  case 'course':
    $query = 'SELECT module_id AS value, module_name AS label FROM module WHERE course_id = :course_id';
    $params = array(':course_id' => $prevFilterValue);
    break;
  case 'module':
    $query = 'SELECT class_id AS value, class_name AS label FROM class WHERE module_id = :module_id';
    $params = array(':module_id' => $prevFilterValue);
    break;
  case 'class':
    $query = 'SELECT student_id AS value, student_name AS label FROM student WHERE class_id = :class_id';
    $params = array(':class_id' => $prevFilterValue);
    break;
  default:
    $query = '';
    $params = array();
    break;
}

if ($query) {
  $stmt = $db->prepare($query);
  $stmt->execute($params);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($data);
} else {
  echo json_encode([]);
}
