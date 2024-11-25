<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Timetable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .timetable-container {
            margin-top: 20px;
            text-align: center;
        }
        .timetable-container iframe {
            width: 100%;
            height: 800px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .message {
            text-align: center;
            color: #f00;
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
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Student Timetable</h1>
    
    <form action="#" method="post">
        <input type="hidden" name="division" value="a">
        <input type="submit" name="show_timetable_a" value="Show Timetable for Division A">
    </form>
    
    <form action="#" method="post">
        <input type="hidden" name="division" value="b">
        <input type="submit" name="show_timetable_b" value="Show Timetable for Division B">
    </form>

    <div class="timetable-container">
        <?php
            $timetableFileA = '../Teacher/timetables/timetable1.pdf';
            $timetableFileB = '../Teacher/timetables/timetable2.pdf';
            

            if (isset($_POST['division'])) {
                $division = $_POST['division'];

                if ($division === 'a' && file_exists($timetableFileA)) {
                    echo '<iframe src="' . $timetableFileA . '"></iframe>';
                } elseif ($division === 'b' && file_exists($timetableFileB)) {
                    echo '<iframe src="' . $timetableFileB . '"></iframe>';
                } else {
                    echo '<div class="message">Timetable not available for these division.</div>';
                }
            }
        ?>
    </div>
    <h2>
<a href="student_home.php">Home</a></h2>
</body>
</html>
