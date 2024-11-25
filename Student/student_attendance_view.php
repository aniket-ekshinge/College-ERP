<?php
$host = 'localhost';
$dbname = 'teacher';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

function getAttendance($pdo, $stud_id)
{
    $query = "SELECT * FROM attendance WHERE stud_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$stud_id]);
    $attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $attendance;
}

if(isset($_GET['stud_id'])) {
    $stud_id = $_GET['stud_id'];
    
    $attendance = getAttendance($pdo, $stud_id);

    if(!empty($attendance)) {
        echo "<h2>Attendance for Student ID: $stud_id</h2>";
        echo "<table class='attendance-table'>
                <tr>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Subject 1</th>
                    <th>Subject 2</th>
                    <th>Extra Lecture</th>
                    <th>Total</th>
                </tr>";
        foreach ($attendance as $record) {
            echo "<tr>
                    <td>{$record['from_date']}</td>
                    <td>{$record['to_date']}</td>
                    <td>{$record['subject1']}</td>
                    <td>{$record['subject2']}</td>
                    <td>{$record['extra']}</td>
                    <td>{$record['total']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-record'>No attendance records found for Student ID: $stud_id</p>";
    }
} else {
    echo "<p class='no-record'>Please provide the Student ID.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .attendance-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .attendance-table th,
        .attendance-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .attendance-table th {
            background-color: #f2f2f2;
        }

        .attendance-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .attendance-table tr:hover {
            background-color: #f2f2f2;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .no-record {
            text-align: center;
            color: #FF5733;
            margin-top: 20px;
        }
        a{
            background-color: navy;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h2>View Attendance</h2>
    <form action="#" method="get">
        <label for="stud_id">Student ID:</label>
        <input type="text" name="stud_id" id="stud_id">
        <button type="submit">View Attendance</button>
    </form>
    <h2>
<a href="student_home.php">Home</a></h2>
</body>
</html>
