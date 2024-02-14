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
<body style="background-color: aliceblue">
    <h2>Employee Data</h2>

    <div class="button-container">
        <button class="dashboard-btn" onclick="window.location.href='dashboard.php'">Report Graphs</button>
        <button class="dashboard-btn" onclick="window.location.href='department_data.php?department=Finance'">Finance Data</button>
        <button class="dashboard-btn" onclick="window.location.href='department_data.php?department=HR'">HR Data</button>
        <button class="dashboard-btn" onclick="window.location.href='department_data.php?department=Human Resources'" >Human Resource Data</button>
        <button class="dashboard-btn" onclick="window.location.href='department_data.php?department=IT'">IT Data</button>
        <button class="dashboard-btn" onclick="window.location.href='department_data.php?department=Marketing'">Marketing Data</button>
        <button class="dashboard-btn" onclick="window.location.href='department_data.php?department=Operations'">Operations Data</button>
        <button class="dashboard-btn" onclick="window.location.href='department_data.php?department=Sales'">Sales Data</button>
    </div>

    <div class="button-container">
    <button class="dashboard-btn" onclick="window.location.href='add_employee.php'">Add Employee Data</button>
    <button class="dashboard-btn" onclick="window.location.href='find_employee.php?employee=employee_name'">Find Employee</button>
        
    </div>

    <table id="employeeTable">
        <!-- Table headers here -->
        <tr>
            <th style="background-color: aquamarine;">Sr. No.</th>
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
    </table>

    <script>
        // Fetch data from API and update table
        fetch('api_getEmployee/api.php')
            .then(response => response.json())
            .then(data => {
                const table = document.getElementById('employeeTable');
                // Add table headers
                const headers = Object.keys(data[0]);
                const headerRow = table.insertRow();
                // Add table rows with data
                data.forEach(employee => {
                    const row = table.insertRow();
                    headers.forEach(header => {
                        const cell = row.insertCell();
                        cell.textContent = employee[header];
                    });
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>
