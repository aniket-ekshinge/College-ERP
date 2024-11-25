<?php
// change_password.php

session_start();
if (!isset($_SESSION['stud_id'])) {
    header("Location: Student.php");
    exit();
}

$adminServer = "localhost";
$adminUsername = "root";
$adminPassword = "";
$adminDatabase = "admin";

$adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);
if (!$adminConnection) {
    die("Connection to the admin database failed due to " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studID = $_SESSION['stud_id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Step 1: Check if current password is correct
    $stmt = $adminConnection->prepare("SELECT password FROM `student_idpass` WHERE `stud_id` = ?");
    $stmt->bind_param("s", $studID);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();

    // Step 2: Compare passwords
    if ($currentPassword == $storedPassword) {
        if ($newPassword == $confirmPassword) {
            // Step 3: Update the password in the database
            $stmt = $adminConnection->prepare("UPDATE `student_idpass` SET `password` = ? WHERE `stud_id` = ?");
            $stmt->bind_param("ss", $newPassword, $studID);
            if ($stmt->execute()) {
                echo "Password changed successfully!";
            } else {
                echo "Error updating password. Please try again.";
            }
            $stmt->close();
        } else {
            echo "New passwords do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}

mysqli_close($adminConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Add your styles here */
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <div class="login-container">
        <h2>Change Password</h2>
        <form action="change_password.php" method="post">
            <label for="current_password">Current Password:</label><br>
            <input type="password" name="current_password" id="current_password" required><br><br>

            <label for="new_password">New Password:</label><br>
            <input type="password" name="new_password" id="new_password" required><br><br>

            <label for="confirm_password">Confirm New Password:</label><br>
            <input type="password" name="confirm_password" id="confirm_password" required><br><br>

            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
