<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .photo-container {
      width: 200px; 
      height: auto;
      margin: 0 auto; 
    }

    .photo-container img {
      max-width: 100%;
      height: auto;
    }

    .teacher-info {
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
    }

    .teacher-info div {
      margin-bottom: 10px;
    }

    .teacher-info div:last-child {
      margin-bottom: 0;
    }

    .teacher-info div label {
      font-weight: bold;
    }
  </style>
</head>
<body>
<?php
  session_start();

  $adminServer = "localhost";
  $adminUsername = "root";
  $adminPassword = "";
  $adminDatabase = "teacher";

  $adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);

  if (isset($_SESSION['Teacher_Id'])) {
    $teacherID = $_SESSION['Teacher_Id'];
    $stmt = $adminConnection->prepare("SELECT photo, teacher_first_name, teacher_middle_name, teacher_last_name, gender, job_title, blood_group, dob, email, teacher_id, joining_date, employee_category_id, mobile_no, address FROM teacher_info WHERE teacher_id = ?");
    $stmt->bind_param("s", $teacherID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();

      if (!empty($row['photo'])) {
        $filePath = 'uploads/' . $row['photo']; // Construct the full file path
    
        if (file_exists($filePath)) { // Check if the file exists
            echo '<div class="photo-container">';
            echo '<img src="' . htmlspecialchars($filePath) . '" alt="Teacher Photo" />';
            echo '</div>';
        } else {
            echo "Image file not found in the specified path.";
        }
    } else {
        echo "Image not found in the database.";
    }
    

      echo "<div class='teacher-info'>";
      echo "<div><label>Teacher First Name:</label> " . $row['teacher_first_name'] . "</div>";
      echo "<div><label>Teacher Middle Name:</label> " . $row['teacher_middle_name'] . "</div>";
      echo "<div><label>Teacher Last Name:</label> " . $row['teacher_last_name'] . "</div>";
      echo "<div><label>Teacher ID:</label> " . $row['teacher_id'] . "</div>";
      echo "<div><label>Employee Category ID:</label> " . $row['employee_category_id'] . "</div>";
      echo "<div><label>Job Title:</label> " . $row['job_title'] . "</div>";
      echo "<div><label>Date of Birth:</label> " . $row['dob'] . "</div>";
      echo "<div><label>Gender:</label> " . $row['gender'] . "</div>";
      echo "<div><label>Joining Date:</label> " . $row['joining_date'] . "</div>";
      echo "<div><label>Address:</label> " . $row['address'] . "</div>";
      echo "<div><label>Blood Group:</label> " . $row['blood_group'] . "</div>";
      echo "<div><label>Email:</label> " . $row['email'] . "</div>";
      echo "<div><label>Phone no:</label> " . $row['mobile_no'] . "</div>";
      echo "</div>";
    } else {
      echo "No Teacher found";
    }

    $stmt->close();
  } else {
    header("Location: Teacher.php");
    exit();
  }

  mysqli_close($adminConnection);
?>
</body>
</html>
