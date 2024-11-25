<?php

require 'C:\xampp\htdocs\ERP-MAIN\phpspreadsheet\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

function excelToDate($serial)
{
    $unixBase = 25569; 
    $unixDate = ($serial - $unixBase) * 86400; 

    return gmdate("Y-m-d", $unixDate);
}

function uploadAttendance($file)
{
    $spreadsheet = IOFactory::load($file['tmp_name']);
    $sheet = $spreadsheet->getActiveSheet();

    // Database connection
    $host = 'localhost';
    $dbname = 'teacher';
    $username = 'root';
    $password = '';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    foreach ($sheet->getRowIterator(2) as $row) {
        $data = $row->getCellIterator();
        $record = [];
        foreach ($data as $cell) {
            // Read calculated value instead of formula
            $record[] = $cell->getCalculatedValue();
        }

        // Assigning values
        $stud_id = $record[0];
        $division = $record[1];
        $from_date = excelToDate($record[2]);
        $to_date = excelToDate($record[3]);
        $subject1 = $record[4];
        $subject2 = $record[5];
        $extra = $record[6];
        $total = is_numeric($record[7]) ? (int)$record[7] : 0; // Default to 0 if total is invalid

        // Check if attendance already exists for the student and division
        $query = "SELECT id FROM attendance WHERE stud_id = ? AND division = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$stud_id, $division]);
        $existingRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRecord) {
            // Update existing attendance record
            $query = "UPDATE attendance 
                      SET from_date = ?, to_date = ?, subject1 = ?, subject2 = ?, extra = ?, total = ?
                      WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$from_date, $to_date, $subject1, $subject2, $extra, $total, $existingRecord['id']]);
        } else {
            // Insert new attendance record
            $query = "INSERT INTO attendance (stud_id, division, from_date, to_date, subject1, subject2, extra, total)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$stud_id, $division, $from_date, $to_date, $subject1, $subject2, $extra, $total]);
        }
    }

    echo "<script>alert('Attendance uploaded successfully.');</script>";
}


if (isset($_POST['submit1']) && isset($_FILES["file1"]) && $_FILES["file1"]["error"] == UPLOAD_ERR_OK) {
    $file = $_FILES["file1"];
    $file_info = pathinfo($file["name"]);
    if ($file_info["extension"] != "xlsx") {
        echo "<script>alert('Only .xlsx files are allowed.');</script>";
        exit;
    }
    uploadAttendance($file);
}

if (isset($_POST['submit2']) && isset($_FILES["file2"]) && $_FILES["file2"]["error"] == UPLOAD_ERR_OK) {
    $file = $_FILES["file2"];
    $file_info = pathinfo($file["name"]);
    if ($file_info["extension"] != "xlsx") {
        echo "<script>alert('Only .xlsx files are allowed.');</script>";
        exit;
    }
    uploadAttendance($file);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: navy;
            margin-top: 50px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        button[type="submit"] {
            background-color: navy;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
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
    <h2>Upload Attendance</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="file1">Select Attendance A xlxs:</label>
        <input type="file" name="file1" id="file1" accept=".xlsx">
        <button type="submit" name="submit1" value="Upload">Upload</button>
    </form> 

    <form action="#" method="post" enctype="multipart/form-data">
        <label for="file2">Select Attendance B xlxs:</label>
        <input type="file" name="file2" id="file2" accept=".xlsx">
        <button type="submit" name="submit2" value="Upload">Upload</button>
    </form>
    <h2>
    <a href="teacher_home.html">Home</a></h2>
</body>
</html>
