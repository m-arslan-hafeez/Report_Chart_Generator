<?php
// MySQL Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve department name from the query parameter
$department = $_GET['department'];

// Prepare SQL query to select data based on department
$sql = "SELECT * FROM employees_info WHERE departmentName = '$department'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data['error'] = "0 results";
}

// Close connection
$conn->close();

// Set headers to output JSON
header('Content-Type: application/json');

// Output JSON data
echo json_encode($data);
?>
