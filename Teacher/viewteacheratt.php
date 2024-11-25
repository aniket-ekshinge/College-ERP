<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Division wise Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1,h2 {
            text-align: center;
            color: navy;
            margin-top: 50px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .no-records {
            text-align: center;
            color: #777;
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
    <h1>Division wise Attendance</h1>
    
    <form action="#" method="post">
        <input type="hidden" name="division" value="a">
        <input type="submit" name="show_attendance_a" value="Show Attendance for Division A">
    </form>
    
    <form action="#" method="post">
        <input type="hidden" name="division" value="b">
        <input type="submit" name="show_attendance_b" value="Show Attendance for Division B">
    </form>

    

    <?php
    $host = 'localhost';
    $dbname = 'teacher';
    $username = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    function getAttendance($pdo, $division)
    {
        $query = "SELECT * FROM attendance WHERE division = :division";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':division', $division);
        $stmt->execute();
        $attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $attendance;
    }

    $division = isset($_POST['division']) ? $_POST['division'] : null;

    $attendance = [];

    if ($division === 'a') {
        $attendance = getAttendance($pdo, 'A');
    } elseif ($division === 'b') {
        $attendance = getAttendance($pdo, 'B');
    }

    if (!empty($attendance)) {
        echo "<table>
                <tr>
                    <th>Student ID</th>
                    <th>Division</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Subject 1</th>
                    <th>Subject 2</th>
                    <th>Extra Lecture</th>
                    <th>Total</th>
                </tr>";

        foreach ($attendance as $record) {
            echo "<tr>
                    <td>{$record['stud_id']}</td>
                    <td>{$record['division']}</td>
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
        echo "<div class='no-records'>No attendance records found.</div>";
    }
    ?>

<h2>
<a href="teacher_home.html">Home</a></h2>
</body>
</html>
