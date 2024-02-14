<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Data</title>
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
<body style="background-color:aliceblue">
    <h2>Selected Department Data</h2>
    <button class="dashboard-btn" onclick="window.location.href='index.php'">Back</button>
    <table id="employee-table">
        <thead>
            <tr>
            <th style="background-color: aquamarine;">Employee Name</th>
            <th style="background-color: aquamarine;">Employee ID</th>
            <th style="background-color: yellow;">Department Name</th>
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
        </thead>
        <tbody id="employee-data">
            <!-- Data will be dynamically added here -->
        </tbody>
    </table>

    <script>
        // Function to fetch data from the API and populate the table
        function fetchDepartmentData() {
            var department = '<?php echo isset($_GET["department"]) ? $_GET["department"] : "" ?>';
            fetch('api_getDepart/api.php?department=' + department)
            .then(response => response.json())
            .then(data => {
                var employeeData = document.getElementById('employee-data');
                employeeData.innerHTML = ''; // Clear previous data
                if(data.error) {
                    employeeData.innerHTML = '<tr><td colspan="3">' + data.error + '</td></tr>';
                } else {
                    data.forEach(function(employee) {
                        var row = '<tr>';
                        row += '<td>' + employee.employeeName + '</td>';
                        row += '<td>' + employee.employeeID + '</td>';
                        row += '<td>' + employee.departmentName + '</td>';
                        row += '<td>' + employee.role + '</td>';
                        row += '<td>' + employee.joiningDate + '</td>';
                        row += '<td>' + employee.monthlySalary + '</td>';
                        row += '<td>' + employee.projectsCompleted + '</td>';
                        row += '<td>' + employee.teamLeadName + '</td>';
                        row += '<td>' + employee.numLeavesPerMonth + '</td>';
                        row += '<td>' + employee.numOfficialLeaves + '</td>';
                        row += '<td>' + employee.allowedLeaves + '</td>';
                        row += '<td>' + employee.unpaidLeaves + '</td>';
                        row += '<td>' + employee.overtimeHours + '</td>';
                        row += '<td>' + employee.homeAddress + '</td>';
                        row += '<td>' + employee.idCardNumber + '</td>';
                        row += '<td>' + employee.residentialCity + '</td>';
                        row += '</tr>';
                        employeeData.innerHTML += row;
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }
        // Call the function when the page loads
        fetchDepartmentData();
    </script>
</body>
</html>
