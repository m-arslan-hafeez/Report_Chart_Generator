<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .dashboard-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body style="background-color:aliceblue">
    <h2>Employee Data</h2>
    <div class="button-container">
        <button class="dashboard-btn" onclick="window.location.href='dashboard.php'" style="padding: 5px; background-color:violet; margin-left: 5px">Report Graphs</button>
        <button onclick="window.location.href='department_data.php?department=Finance'" style="padding: 5px; background-color:violet; margin-left: 5px">Finance Data</button>
        <button onclick="window.location.href='department_data.php?department=HR'" style="padding: 5px; background-color:violet; margin-left: 5px">HR Data</button>
        <button onclick="window.location.href='department_data.php?department=Human Resources'" style="padding: 5px; background-color:violet; margin-left: 5px">Human Resource Data</button>
        <button onclick="window.location.href='department_data.php?department=IT'" style="padding: 5px; background-color:violet; margin-left: 5px">IT Data</button>
        <button onclick="window.location.href='department_data.php?department=Marketing'" style="padding: 5px; background-color:violet; margin-left: 5px">Marketing Data</button>
        <button onclick="window.location.href='department_data.php?department=Operations'" style="padding: 5px; background-color:violet; margin-left: 5px">Operations Data</button>
        <button onclick="window.location.href='department_data.php?department=Sales'" style="padding: 5px; background-color:violet; margin-left: 5px">Sales Data</button>
    </div>

    <div class="button-container">
    <button onclick="window.location.href='add_employee.php'" style="padding: 5px; background-color:yellowgreen; margin-bottom: 10px;">Add Employee Data</button>
    <button onclick="window.location.href='find_employee.php?employee=employee_name'" style="padding: 5px; background-color:violet; margin-left: 1300px; margin-right:10px;">Find Employee</button>
        
    </div>

    <table>
        <tr>
            <th style="background-color: aquamarine;">Employee Name</th>
            <th style="background-color: aquamarine;">Employee ID</th>
            <th style="background-color: aquamarine;">Department Name</th>
            <th style="background-color: aquamarine;">Role</th>
            <th style="background-color: aquamarine;">Joining Date</th>
            <th style="background-color: aquamarine;">Monthly Salary</th>
            <th style="background-color: aquamarine;">Projects Completed</th>
            <th style="background-color: aquamarine;">Team Lead Name</th>
            <th style="background-color: aquamarine;">Number of Leaves Per Month</th>
            <th style="background-color: aquamarine;">Number of Official Leaves</th>
            <th style="background-color: aquamarine;">Allowed Leaves</th>
            <th style="background-color: aquamarine;">Unpaid Leaves</th>
            <th style="background-color: aquamarine;">Overtime Hours</th>
            <th style="background-color: aquamarine;">Home Address</th>
            <th style="background-color: aquamarine;">ID Card Number</th>
            <th style="background-color: aquamarine;">Residential City</th>
        </tr>
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

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['employeeName']."</td>";
                echo "<td>".$row['employeeID']."</td>";
                echo "<td>".$row['departmentName']."</td>";
                echo "<td>".$row['role']."</td>";
                echo "<td>".$row['joiningDate']."</td>";
                echo "<td>".$row['monthlySalary']."</td>";
                echo "<td>".$row['projectsCompleted']."</td>";
                echo "<td>".$row['teamLeadName']."</td>";
                echo "<td>".$row['numLeavesPerMonth']."</td>";
                echo "<td>".$row['numOfficialLeaves']."</td>";
                echo "<td>".$row['allowedLeaves']."</td>";
                echo "<td>".$row['unpaidLeaves']."</td>";
                echo "<td>".$row['overtimeHours']."</td>";
                echo "<td>".$row['homeAddress']."</td>";
                echo "<td>".$row['idCardNumber']."</td>";
                echo "<td>".$row['residentialCity']."</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
