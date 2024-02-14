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

// Query to select all data from the employee_data table
$sql = "SELECT * FROM employees_info";
$result = $conn->query($sql);

$employees = array();

if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Close connection
$conn->close();

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($employees);
?>
