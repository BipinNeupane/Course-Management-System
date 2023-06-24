<?php

if (!function_exists('insertData')) {
function insertData($table, $data) {
    $conn = mysqli_connect("localhost", "root", "", "courses");
    // Escape the table name
    $table = $conn->real_escape_string($table);
    // Build the SQL statement
    $fields = array_keys($data);
    $values = array_map(array($conn, 'real_escape_string'), array_values($data));
    $fields = implode(", ", $fields);
    $values = "'" . implode("', '", $values) . "'";
    $sql = "INSERT INTO $table ($fields) VALUES ($values)";
    
    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
}
if (!function_exists('selectDataById')) {
function selectDataById($table, $id,$column) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $table WHERE $column = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
  }
}
if (!function_exists('updateData')) {
function updateData($table, $data, $idColumn, $idValue) {
    // Connect to database
    include 'connection.php';

    // Create the SQL query
    $sql = "UPDATE " . $table . " SET ";

    // Add each column to the query
    $firstColumn = true;
    foreach ($data as $columnName => $columnValue) {
        if (!$firstColumn) {
            $sql .= ", ";
        }
        $sql .= $columnName . "='" . $columnValue . "'";
        $firstColumn = false;
    }

    // Add the WHERE clause to the query
    $sql .= " WHERE " . $idColumn . "='" . $idValue . "'";

    // Execute the query and return true or false depending on success
    if ($conn->query($sql) === TRUE) {
        echo "updated sucessfully";
    } else {
        return false;
    }
}
}

if (!function_exists('selectData')) {
function selectData($table, $columns = "*", $condition = "") {
    // Connect to the database
    include 'connection.php';

    // Build the SELECT query
    $query = "SELECT $columns FROM $table";
    if (!empty($condition)) {
        $query .= " WHERE $condition";
    }

    // Execute the query and fetch the results
    $result = mysqli_query($conn, $query);
    $data = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    // Close the database connection and return the data
    mysqli_close($conn);
    return $data;
}
}

function deleteData($table, $id, $column) {
    $conn = mysqli_connect("localhost", "root", "", "courses");
    $stmt = $conn->prepare("DELETE FROM $table WHERE $column = ?");
    if (!$stmt) {
        die('Error: ' . mysqli_error($conn));
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
}
// Define a function to retrieve data from a table in ascending order of a specified column
function selectDataByOrder($table, $orderBy, $orderDirection = 'ASC') {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'courses');
  
    // Check if the connection was successful
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
  
    // Construct the SQL query
    $sql = "SELECT * FROM $table ORDER BY $orderBy $orderDirection";
  
    // Execute the query and retrieve the data
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    // Close the database connection
    mysqli_close($conn);
  
    // Return the data
    return $data;
  }
  
  function selectCustomData($query) {
    global $conn;

    $result = $conn->query($query);

    if (!$result) {
        die("Error: " . $conn->error); // Output the error message
    }

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}



?>