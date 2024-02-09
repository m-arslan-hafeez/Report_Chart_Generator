<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .search-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .employee-list {
            list-style-type: none;
            padding: 0;
        }

        .employee-list li {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .employee-list li:nth-child(even) {
            background-color: #e9e9e9;
        }

        .employee-list li:hover {
            background-color: #ddd;
        }

        .employee-list li h3 {
            margin-top: 0;
            margin-bottom: 5px;
        }

        .employee-list li p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Employee Search</h2>
        <div class="search-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <input type="text" name="search" placeholder="Enter employee name">
                <input type="submit" value="Search">
            </form>
        </div>
        
        <?php
        // PHP script for searching employees
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $servername = "localhost"; // Change this to your servername
            $username = "root"; // Change this to your username
            $password = ""; // Change this to your password
            $dbname = "employees"; // Change this to your database name

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $search = $_GET['search'];

            // Search query
            $sql = "SELECT * FROM employees_info WHERE employeeName LIKE '%$search%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul class='employee-list'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<h3>" . $row["employeeName"] . "</h3>";
                    echo "<p>Employee ID: " . $row["employeeID"] . "</p>";
                    echo "<p>Department: " . $row["departmentName"] . "</p>";
                    // Add more details as needed
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No results found.</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
