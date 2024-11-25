<?php
session_start();

$adminServer = "localhost";
$adminUsername = "root";
$adminPassword = "";
$adminDatabase = "student";

$adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);

if (isset($_SESSION['stud_id'])) {
    $studID = $_SESSION['stud_id'];
    $stmt = $adminConnection->prepare("SELECT photo, student_first_name, middle_name, last_name,division, admission_no, roll_no, branch, dob, gender, blood_group, adhar_no, address, email, phone_no, immediate_contact FROM student_info WHERE stud_id = ?");
    $stmt->bind_param("s", $studID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();


        if (!empty($row['photo'])) {
            $filePath = 'uploads/' . $row['photo']; // Construct the full file path
        
            if (file_exists($filePath)) { // Check if the file exists
                echo '<div class="photo-container">';
                echo '<img src="' . htmlspecialchars($filePath) . '" alt="Student Photo" />';
                echo '</div>';
            } else {
                echo "Image file not found in the specified path.";
            }
        } else {
            echo "Image not found in the database.";
        }
        
        
        

        echo "<div class='student-info'>";
        echo "Student First Name: " . $row['student_first_name'] . "<br>";
        echo "Student Middle Name: " . $row['middle_name'] . "<br>";
        echo "Student Last Name: " . $row['last_name'] . "<br>";
        echo "Student Division: " . $row['division'] . "<br>";
        echo "Admission no: " . $row['admission_no'] . "<br>";
        echo "Roll No: " . $row['roll_no'] . "<br>";
        echo "Branch: " . $row['branch'] . "<br>";
        echo "Date of Birth: " . $row['dob'] . "<br>";
        echo "Gender: " . $row['gender'] . "<br>";
        echo "Blood Group: " . $row['blood_group'] . "<br>";
        echo "Adhar Number: " . $row['adhar_no'] . "<br>";
        echo "Address: " . $row['address'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        echo "Phone no: " . $row['phone_no'] . "<br>";
        echo "Immediate Contact: " . $row['immediate_contact'] . "<br>";
        echo "</div>";
    } else {
        echo "No student found";
    }

    $stmt->close();
} else {
    header("Location: Student.php");
    exit();
}

mysqli_close($adminConnection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My photo</title>


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
    .student-info {
        width: 30%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .student-info h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .student-info p {
        margin-bottom: 10px;
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
<h2>
<a href="student_home.php">Home</a></h2>
<body>
</body>
</html>
