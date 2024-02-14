<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                width: 80%;
            }
        }
        .dashboard-btn {
        padding: 10px 20px;
        background-color: #8e44ad;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 20px;
    }

    .dashboard-btn:hover {
        background-color: #9b59b6;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2>Employee Data Form</h2>
        <button class="dashboard-btn" onclick="window.location.href='index.php'">Back</button>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="employeeName">Employee Name:</label>
                <input type="text" id="employeeName" name="employeeName" required>
            </div>
            <div class="form-group">
                <label for="employeeID">Employee ID:</label>
                <input type="text" id="employeeID" name="employeeID" required>
            </div>
            <div class="form-group">
                <label for="departmentName">Department Name:</label>
                <input type="text" id="departmentName" name="departmentName" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" id="role" name="role" required>
            </div>
            <div class="form-group">
                <label for="joiningDate">Joining Date:</label>
                <input type="date" id="joiningDate" name="joiningDate" required>
            </div>
            <div class="form-group">
                <label for="monthlySalary">Monthly Salary:</label>
                <input type="text" id="monthlySalary" name="monthlySalary" required>
            </div>
            <div class="form-group">
                <label for="projectsCompleted">Projects Completed:</label>
                <input type="text" id="projectsCompleted" name="projectsCompleted" required>
            </div>
            <div class="form-group">
                <label for="teamLeadName">Team Lead Name:</label>
                <input type="text" id="teamLeadName" name="teamLeadName" required>
            </div>
            <div class="form-group">
                <label for="numLeavesPerMonth">Number of Leaves Per Month:</label>
                <input type="text" id="numLeavesPerMonth" name="numLeavesPerMonth" required>
            </div>
            <div class="form-group">
                <label for="numOfficialLeaves">Number of Official Leaves:</label>
                <input type="text" id="numOfficialLeaves" name="numOfficialLeaves" required>
            </div>
            <div class="form-group">
                <label for="allowedLeaves">Allowed Leaves:</label>
                <input type="text" id="allowedLeaves" name="allowedLeaves" required>
            </div>
            <div class="form-group">
                <label for="unpaidLeaves">Unpaid Leaves:</label>
                <input type="text" id="unpaidLeaves" name="unpaidLeaves" required>
            </div>
            <div class="form-group">
                <label for="overtimeHours">Overtime Hours:</label>
                <input type="text" id="overtimeHours" name="overtimeHours" required>
            </div>
            <div class="form-group">
                <label for="homeAddress">Home Address:</label>
                <input type="text" id="homeAddress" name="homeAddress" required>
            </div>
            <div class="form-group">
                <label for="idCardNumber">ID Card Number:</label>
                <input type="text" id="idCardNumber" name="idCardNumber" required>
            </div>
            <div class="form-group">
                <label for="residentialCity">Residential City:</label>
                <input type="text" id="residentialCity" name="residentialCity" required>
            </div>
            <input class="dashboard-btn" type="submit" value="Submit">
        </form>
    </div>

    <?php
    // PHP script goes here
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
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
