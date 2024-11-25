<?php
session_start();

// Check if the teacher is logged in
if (!isset($_SESSION['Teacher_Id'])) {
    header("Location: Teacher.php"); // Redirect to login if not logged in
    exit();
}

// Database connection
$adminServer = "localhost";
$adminUsername = "root";
$adminPassword = "";
$adminDatabase = "admin";

$adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);
if (!$adminConnection) {
    die("Connection to the admin database failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Teacher_Id = $_SESSION['Teacher_Id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        echo "New password and confirm password do not match.";
    } else {
        // Fetch the current password from the database
        $stmt = $adminConnection->prepare("SELECT password FROM `teacher_idpass` WHERE `Teacher_Id` = ?");
        $stmt->bind_param("s", $Teacher_Id);
        $stmt->execute();
        $stmt->bind_result($storedPassword);
        $stmt->fetch();
        $stmt->close();

        // Verify current password
        if ($currentPassword == $storedPassword) {
            // Update the password
            $stmt = $adminConnection->prepare("UPDATE `teacher_idpass` SET password = ? WHERE `Teacher_Id` = ?");
            $stmt->bind_param("ss", $newPassword, $Teacher_Id);
            if ($stmt->execute()) {
                echo "Password updated successfully.";
            } else {
                echo "Failed to update password. Please try again.";
            }
            $stmt->close();
        } else {
            echo "Current password is incorrect.";
        }
    }
}

mysqli_close($adminConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    <form action="change_password_teacher.php" method="post">
        <label for="current_password">Current Password:</label><br>
        <input type="password" name="current_password" required><br><br>
        <label for="new_password">New Password:</label><br>
        <input type="password" name="new_password" required><br><br>
        <label for="confirm_password">Confirm New Password:</label><br>
        <input type="password" name="confirm_password" required><br><br>
        <button type="submit">Change Password</button>
    </form>
</body>
</html>
