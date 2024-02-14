<?php
// Database connection details
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

// Function to fetch data from the database and generate a dataset
function generateDataset($conn, $query, $label) {
    $result = $conn->query($query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[$row[$label]] = $row['count'];
    }
    return $data;
}

// Generate datasets for different metrics
$employeesByCityQuery = "SELECT residentialCity, COUNT(*) as count FROM employees_info GROUP BY residentialCity";
$employeesBySalaryQuery = "SELECT monthlySalary, COUNT(*) as count FROM employees_info GROUP BY monthlySalary";
$employeesByJoiningDateQuery = "SELECT YEAR(joiningDate) as year, COUNT(*) as count FROM employees_info GROUP BY YEAR(joiningDate)";
$employeesByDepartmentQuery = "SELECT departmentName, COUNT(*) as count FROM employees_info GROUP BY departmentName";
$employeesByRoleQuery = "SELECT role, COUNT(*) as count FROM employees_info GROUP BY role";
$employeesByTeamLeadQuery = "SELECT teamLeadName, COUNT(*) as count FROM employees_info GROUP BY teamLeadName";
$employeesByOvertimeQuery = "SELECT overtimeHours, COUNT(*) as count FROM employees_info GROUP BY overtimeHours";
$employeesByAllowedLeavesQuery = "SELECT allowedLeaves, COUNT(*) as count FROM employees_info GROUP BY allowedLeaves";

$employeesByCityData = generateDataset($conn, $employeesByCityQuery, 'residentialCity');
$employeesBySalaryData = generateDataset($conn, $employeesBySalaryQuery, 'monthlySalary');
$employeesByJoiningDateData = generateDataset($conn, $employeesByJoiningDateQuery, 'year');
$employeesByDepartmentData = generateDataset($conn, $employeesByDepartmentQuery, 'departmentName');
$employeesByRoleData = generateDataset($conn, $employeesByRoleQuery, 'role');
$employeesByTeamLeadData = generateDataset($conn, $employeesByTeamLeadQuery, 'teamLeadName');
$employeesByOvertimeData = generateDataset($conn, $employeesByOvertimeQuery, 'overtimeHours');
$employeesByAllowedLeavesData = generateDataset($conn, $employeesByAllowedLeavesQuery, 'allowedLeaves');

// Close connection
$conn->close();

// Combine all data into an array
$dashboardData = array(
    'employeesByCity' => $employeesByCityData,
    'employeesBySalary' => $employeesBySalaryData,
    'employeesByJoiningDate' => $employeesByJoiningDateData,
    'employeesByDepartment' => $employeesByDepartmentData,
    'employeesByRole' => $employeesByRoleData,
    'employeesByTeamLead' => $employeesByTeamLeadData,
    'employeesByOvertime' => $employeesByOvertimeData,
    'employeesByAllowedLeaves' => $employeesByAllowedLeavesData
);

// Set headers to output JSON
header('Content-Type: application/json');

// Output JSON data
echo json_encode($dashboardData);
?>
