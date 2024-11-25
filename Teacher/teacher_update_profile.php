<?php
session_start();

$adminServer = "localhost";
$adminUsername = "root";
$adminPassword = "";
$adminDatabase = "teacher";

$adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);

if (!$adminConnection) {
    die("Connection to the admin database failed due to" . mysqli_connect_error());
}

if (isset($_SESSION['Teacher_Id'])) {

    $Teacher_Id = $_SESSION['Teacher_Id'];

    $selectQuery = "SELECT email, mobile_no, address, job_title FROM teacher_info WHERE Teacher_Id = ?";
    $stmt = $adminConnection->prepare($selectQuery);
    $stmt->bind_param("s", $Teacher_Id);
    $stmt->execute();
    $stmt->bind_result($email, $mobile_no, $address, $job_title);
    $stmt->fetch();
    $stmt->close();
}

mysqli_close($adminConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Update Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form method="post" action="teacher_update_profile.php">
    <label for="phone_no">Mobile:</label>
    <input type="text" id="phone_no" name="mobile_no" value="<?php echo isset($mobile_no) ? $mobile_no : ''; ?>">

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">

    <label for="jobtitle">Job Title:</label>
    <input type="text" id="jobtitle" name="job_title" value="<?php echo isset($job_title) ? $job_title : ''; ?>">
    
    <input type="submit" value="Update">
</form>

</body>
</html>
