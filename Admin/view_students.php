<?php
session_start();

$adminServer = "localhost";
$adminUsername = "root";
$adminPassword = "";
$adminDatabase = "student";

$adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);

if (!$adminConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle division selection
$selectedDivision = isset($_GET['division']) ? $_GET['division'] : '';
$selectedStudentID = isset($_GET['stud_id']) ? $_GET['stud_id'] : '';

if ($selectedStudentID) {
    // Fetch student details based on student ID
    $stmt = $adminConnection->prepare("SELECT photo, student_first_name, middle_name, last_name, admission_no, roll_no, branch, dob, gender, blood_group, adhar_no, address, email, phone_no, immediate_contact FROM student_info WHERE stud_id = ?");
    $stmt->bind_param("s", $selectedStudentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Display student information
        echo "<div><h2>Student Details</h2>";
        
        // Check if the student has a photo
        $photoPath = '../Student/uploads/' . $row['photo'];
        if (!empty($row['photo']) && file_exists($photoPath)) {
            echo "<img src='" . htmlspecialchars($photoPath) . "' class='student-photo' alt='Student Photo'>";
        } else {
            echo "<img src='Student/uploads/default.png' class='student-photo' alt='Default Photo'>";
        }

        echo "<p><strong>First Name:</strong> " . htmlspecialchars($row['student_first_name']) . "</p>";
        echo "<p><strong>Middle Name:</strong> " . htmlspecialchars($row['middle_name']) . "</p>";
        echo "<p><strong>Last Name:</strong> " . htmlspecialchars($row['last_name']) . "</p>";
        echo "<p><strong>Admission No:</strong> " . htmlspecialchars($row['admission_no']) . "</p>";
        echo "<p><strong>Roll No:</strong> " . htmlspecialchars($row['roll_no']) . "</p>";
        echo "<p><strong>Branch:</strong> " . htmlspecialchars($row['branch']) . "</p>";
        echo "<p><strong>Date of Birth:</strong> " . htmlspecialchars($row['dob']) . "</p>";
        echo "<p><strong>Gender:</strong> " . htmlspecialchars($row['gender']) . "</p>";
        echo "<p><strong>Blood Group:</strong> " . htmlspecialchars($row['blood_group']) . "</p>";
        echo "<p><strong>Adhar Number:</strong> " . htmlspecialchars($row['adhar_no']) . "</p>";
        echo "<p><strong>Address:</strong> " . htmlspecialchars($row['address']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
        echo "<p><strong>Phone No:</strong> " . htmlspecialchars($row['phone_no']) . "</p>";
        echo "<p><strong>Immediate Contact:</strong> " . htmlspecialchars($row['immediate_contact']) . "</p></div>";

    } else {
        echo "Student not found";
    }
    $stmt->close();
} elseif ($selectedDivision) {
    // If division is selected, show the list of students for that division
    $stmt = $adminConnection->prepare("SELECT stud_id, student_first_name, middle_name, last_name FROM student_info WHERE division = ?");
    $stmt->bind_param("s", $selectedDivision);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Student List for Division: " . htmlspecialchars($selectedDivision) . "</h2>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<thead><tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Action</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['stud_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['student_first_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
            echo "<td><a href='?division=" . htmlspecialchars($selectedDivision) . "&stud_id=" . $row['stud_id'] . "'>View Details</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No students found in Division " . htmlspecialchars($selectedDivision);
    }
    $stmt->close();
} else {
    // Display division selection dropdown if no division is selected
    echo "<h2>Select a Division</h2>";
    echo "<form method='get' action=''>";
    echo "<select name='division' onchange='this.form.submit()'>";
    echo "<option value=''>--Select Division--</option>";
    echo "<option value='A' " . ($selectedDivision == 'A' ? 'selected' : '') . ">Division A</option>";
    echo "<option value='B' " . ($selectedDivision == 'B' ? 'selected' : '') . ">Division B</option>";
    echo "</select>";
    echo "</form>";
}

mysqli_close($adminConnection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Information</title>
  <style>
    div{
        width: 30%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    }
    .student-info-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .student-info {
        border: 1px solid #ccc;
        margin: 10px;
        padding: 10px;
        width: 300px;
        text-align: left;
    }

    .student-photo {
        max-width: 30%;
        height: auto;
        padding: 20px;
    }

    select {
        padding: 10px;
        font-size: 16px;
    }
  </style>
</head>
<body>
</body>
</html>

