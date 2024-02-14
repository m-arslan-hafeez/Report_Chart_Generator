<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; // Change this to your servername
    $username = "root"; // Change this to your username
    $password = ""; // Change this to your password
    $dbname = "employees"; // Change this to your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO employees_info (employeeName, employeeID, departmentName, role, joiningDate, monthlySalary, projectsCompleted, teamLeadName, numLeavesPerMonth, numOfficialLeaves, allowedLeaves, unpaidLeaves, overtimeHours, homeAddress, idCardNumber, residentialCity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssss", $employeeName, $employeeID, $departmentName, $role, $joiningDate, $monthlySalary, $projectsCompleted, $teamLeadName, $numLeavesPerMonth, $numOfficialLeaves, $allowedLeaves, $unpaidLeaves, $overtimeHours, $homeAddress, $idCardNumber, $residentialCity);

    // Set parameters from POST data
    $employeeName = $_POST['employeeName'];
    $employeeID = $_POST['employeeID'];
    $departmentName = $_POST['departmentName'];
    $role = $_POST['role'];
    $joiningDate = $_POST['joiningDate'];
    $monthlySalary = $_POST['monthlySalary'];
    $projectsCompleted = $_POST['projectsCompleted'];
    $teamLeadName = $_POST['teamLeadName'];
    $numLeavesPerMonth = $_POST['numLeavesPerMonth'];
    $numOfficialLeaves = $_POST['numOfficialLeaves'];
    $allowedLeaves = $_POST['allowedLeaves'];
    $unpaidLeaves = $_POST['unpaidLeaves'];
    $overtimeHours = $_POST['overtimeHours'];
    $homeAddress = $_POST['homeAddress'];
    $idCardNumber = $_POST['idCardNumber'];
    $residentialCity = $_POST['residentialCity'];

    // Execute statement and handle success/error
    if ($stmt->execute() === TRUE) {
        echo json_encode(array("status" => "success", "message" => "New record created successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, return an error
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>
