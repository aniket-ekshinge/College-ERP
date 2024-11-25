<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Timetable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1,h2 {
            text-align: center;
            margin-top: 50px;
            color: navy;
        }

        .form-container {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            margin-top: 20px;
        }

        .form-container form {
            display: inline-block;
            margin: 10px;
        }

        input[type="submit"] {
            background-color: navy;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #001f3f;
        }

        .timetable-container {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .timetable-container iframe {
            display: block;
            width: 100%;
            height: 600px;
            border: none;
        }

        .error-message {
            text-align: center;
            color: #ff0000;
            font-weight: bold;
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
    <h1>Teacher Timetable</h1>
    
    <div class="form-container">
        <form action="#" method="post">
            <input type="hidden" name="division" value="a">
            <input type="submit" name="show_timetable_a" value="Show Timetable for Division A">
        </form>
        
        <form action="#" method="post">
            <input type="hidden" name="division" value="b">
            <input type="submit" name="show_timetable_b" value="Show Timetable for Division B">
        </form>
    </div>

    <?php
        $timetableFileA = 'timetables/timetable1.pdf';
        $timetableFileB = 'timetables/timetable2.pdf';

        if (isset($_POST['division'])) {
            $division = $_POST['division'];
            if ($division === 'a' && file_exists($timetableFileA)) {
                echo '<div class="timetable-container"><iframe src="' . $timetableFileA . '"></iframe></div>';
            } elseif ($division === 'b' && file_exists($timetableFileB)) {
                echo '<div class="timetable-container"><iframe src="' . $timetableFileB . '"></iframe></div>';
            } else {
                echo '<div class="error-message">Timetable not available for these division.</div>';
            }
        }
    ?>
    <h2>
    <a href="teacher_home.html">Home</a></h2>
</body>
</html>
