<?php
$adminServer = "localhost";
$adminUsername = "root";
$adminPassword = "";
$adminDatabase = "teacher";

$adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);

if (!$adminConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = $adminConnection->prepare("SELECT photo, teacher_first_name,teacher_middle_name, teacher_last_name, gender, job_title, blood_group, dob, email, teacher_id, joining_date, employee_category_id, mobile_no,  address FROM teacher_info");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<div class='teacher-info-container'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='teacher-info'>";
        echo "<img src='" . $row['photo'] . "' class='teacher-photo' alt='Teacher Photo'>";
        echo "<p>Teacher First Name: " . $row['teacher_first_name'] . "</p>";
        echo "<p>Teacher Middle Name: " . $row['teacher_middle_name'] . "</p>";
        echo "<p>Teacher Last Name: " . $row['teacher_last_name'] . "</p>";
        echo "<p>Gender: " . $row['gender'] . "</p>";
        echo "<p>Job Title: " . $row['job_title'] . "</p>";
        echo "<p>Blood Group: " . $row['blood_group'] . "</p>";
        echo "<p>Date of Birth: " . $row['dob'] . "</p>";
        echo "<p>Email: " . $row['email'] . "</p>";
        echo "<p>Teacher ID: " . $row['teacher_id'] . "</p>";
        echo "<p>Joining Date: " . $row['joining_date'] . "</p>";
        echo "<p>Employee Category ID: " . $row['employee_category_id'] . "</p>";
        echo "<p>Mobile Number: " . $row['mobile_no'] . "</p>";
        echo "<p>Address: " . $row['address'] . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No teachers found";
}

$stmt->close();
mysqli_close($adminConnection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Information</title>
  <style>
    .teacher-info-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .teacher-info {
        border: 1px solid #ccc;
        margin: 10px;
        padding: 10px;
        width: 300px;
        text-align: left;
    }

    .teacher-photo {
        max-width: 100%;
        height: auto;
    }
  </style>
</head>
<body>
</body>
</html>
