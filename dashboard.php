<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 800px;
            margin: 20px auto;
        }
    </style>
</head>
<body style="background-color:aliceblue">
    <h2>Dashboard</h2>
    <button onclick="window.location.href='index.php'" style="padding: 5px; background-color:yellow; margin-left: 5px; margin-bottom: 10px;"><= Back</button>
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

    $conn->close();
    ?>

    <!-- Render charts -->
    <div class="chart-container">
        <h3>Number of Employees by City</h3>
        <canvas id="employeesByCity"></canvas>
    </div>
    <div class="chart-container">
        <h3>Number of Employees by Salary</h3>
        <canvas id="employeesBySalary"></canvas>
    </div>
    <div class="chart-container">
        <h3>Number of Employees by Joining Date</h3>
        <canvas id="employeesByJoiningDate"></canvas>
    </div>
    <div class="chart-container">
        <h3>Number of Employees by Department</h3>
        <canvas id="employeesByDepartment"></canvas>
    </div>
    <div class="chart-container">
        <h3>Number of Employees by Role</h3>
        <canvas id="employeesByRole"></canvas>
    </div>
    <div class="chart-container">
        <h3>Number of Employees by Team Lead</h3>
        <canvas id="employeesByTeamLead"></canvas>
    </div>
    <div class="chart-container">
        <h3>Number of Employees by Overtime</h3>
        <canvas id="employeesByOvertime"></canvas>
    </div>
    <div class="chart-container">
        <h3>Number of Employees by Allowed Leaves</h3>
        <canvas id="employeesByAllowedLeaves"></canvas>
    </div>

    <script>
        // Render charts using data from PHP
        var employeesByCityData = <?php echo json_encode($employeesByCityData); ?>;
        var employeesBySalaryData = <?php echo json_encode($employeesBySalaryData); ?>;
        var employeesByJoiningDateData = <?php echo json_encode($employeesByJoiningDateData); ?>;
        var employeesByDepartmentData = <?php echo json_encode($employeesByDepartmentData); ?>;
        var employeesByRoleData = <?php echo json_encode($employeesByRoleData); ?>;
        var employeesByTeamLeadData = <?php echo json_encode($employeesByTeamLeadData); ?>;
        var employeesByOvertimeData = <?php echo json_encode($employeesByOvertimeData); ?>;
        var employeesByAllowedLeavesData = <?php echo json_encode($employeesByAllowedLeavesData); ?>;

        // Function to create datasets from the fetched data
        function createDataset(data) {
            var labels = Object.keys(data);
            var values = Object.values(data);
            var dataset = {
                labels: labels,
                datasets: [{
                    label: 'Number of Employees',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };
            return dataset;
        }

        // Create charts
        var ctx1 = document.getElementById('employeesByCity').getContext('2d');
        var chart1 = new Chart(ctx1, {
            type: 'bar',
            data: createDataset(employeesByCityData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('employeesBySalary').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'bar',
            data: createDataset(employeesBySalaryData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx3 = document.getElementById('employeesByJoiningDate').getContext('2d');
        var chart3 = new Chart(ctx3, {
            type: 'line',
            data: createDataset(employeesByJoiningDateData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx4 = document.getElementById('employeesByDepartment').getContext('2d');
        var chart4 = new Chart(ctx4, {
            type: 'bar',
            data: createDataset(employeesByDepartmentData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx5 = document.getElementById('employeesByRole').getContext('2d');
        var chart5 = new Chart(ctx5, {
            type: 'bar',
            data: createDataset(employeesByRoleData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx6 = document.getElementById('employeesByTeamLead').getContext('2d');
        var chart6 = new Chart(ctx6, {
            type: 'bar',
            data: createDataset(employeesByTeamLeadData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx7 = document.getElementById('employeesByOvertime').getContext('2d');
        var chart7 = new Chart(ctx7, {
            type: 'bar',
            data: createDataset(employeesByOvertimeData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx8 = document.getElementById('employeesByAllowedLeaves').getContext('2d');
        var chart8 = new Chart(ctx8, {
            type: 'bar',
            data: createDataset(employeesByAllowedLeavesData),
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
