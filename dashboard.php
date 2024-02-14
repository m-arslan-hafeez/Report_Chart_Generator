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
    <h2>Dashboard</h2>
    <button class="dashboard-btn" onclick="window.location.href='index.php'">Back</button>
    <!-- Render charts -->
    <div class="chart-container" id="charts-container">
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
    </div>

    <script>
        // Function to fetch data from the API and render charts
        function fetchDashboardData() {
            fetch('api_getGraph/api.php')
            .then(response => response.json())
            .then(data => {
                var container = document.getElementById('charts-container');
                Object.keys(data).forEach(function(key) {
                    var canvas = document.createElement('canvas');
                    canvas.id = key;
                    container.appendChild(canvas);
                    renderChart(key, data[key]);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }

        // Function to render individual chart
        function renderChart(id, data) {
            var ctx = document.getElementById(id).getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Number of Employees',
                        data: Object.values(data),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Call the function when the page loads
        fetchDashboardData();
    </script>
</body>
</html>
