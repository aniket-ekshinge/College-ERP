<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Upload Timetable</title>
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
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="file"] {
            margin-bottom: 20px;
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
    <h1>Upload Timetable</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="timetable1">Select Timetable1 PDF:</label>
        <input type="file" name="timetable1" id="timetable1">
        <br><br>
        <input type="submit" name="submit1" value="Upload">
    </form>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="timetable2">Select Timetable2 PDF:</label>
        <input type="file" name="timetable2" id="timetable2">
        <br><br>
        <input type="submit" name="submit2" value="Upload">
    </form>
    <h2>
    <a href="teacher_home.html">Home</a></h2>
</body>
</html>


<?php

if (isset($_POST['submit1'])) {
    uploadTimetable('timetable1');
}

if (isset($_POST['submit2'])) {
    uploadTimetable('timetable2');
}

function uploadTimetable($inputName) {
    $uploadDir = 'timetables/';
    $uploadedFile = $uploadDir . basename($_FILES[$inputName]['name']);
    $fileType = pathinfo($uploadedFile, PATHINFO_EXTENSION);

    if ($fileType != 'pdf') {
        echo "Only PDF files are allowed.";
        exit;
    }

    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $uploadedFile)) {
        echo "Timetable uploaded successfully.";
    } else {
        echo "Failed to upload timetable.";
    }
}

?>
