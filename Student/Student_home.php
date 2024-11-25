<?php
session_start();

// Check if the student is logged in by verifying the session variable
if (!isset($_SESSION['stud_id'])) {
    // If no session is set, redirect to the login page
    header("Location: Student.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-image: url(https://media.istockphoto.com/id/1419766496/photo/abstract-concepts-of-cybersecurity-technology-and-digital-data-protection-protect-internet.jpg?s=2048x2048&w=is&k=20&c=XH5iPaadYeYCyMoKtts6_heqTcSzCcHgUhe-lqaogZQ=);
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        header>img {
            width: 100px;
        }

        .student-name {
            font-size: 24px;
            color: white;
            font-weight: bold;
        }

        main {
            padding: 40px;
            text-align: center;
        }

        .button-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            grid-gap: 20px;
            margin-top: 20px;
        }

        .button {
            padding: 10px;
            background-color: navy;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .button img {
            width: 30px;
            margin-right: 10px;
        }

        .button:hover {
            background-color: rgb(80, 76, 191);
        }

        .profile-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 18px;
            color: #fff;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .profile-dropdown a {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
            width: 150px;
            text-align: left;
        }

        .profile-dropdown a:hover {
            background-color: #ddd;
        }

        .profile-icon:hover .profile-dropdown {
            display: block;
        }

    </style>
</head>

<body>
    <header>
        <img src="img/ICEMLogo.png" alt="ICEM Logo">
        <h1>Welcome <span class="student-name"></h1>

        <div class="profile-icon">
            <img src="img/profile_logo.png" alt="Profile" width="30px">
            <div class="profile-dropdown">
                <a href="change_password.php">Change Password</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <main>
        <div class="button-container">
            <a href="student_registration_php.php" class="button"><img src="img/profile_logo.png" alt="Profile">Fill Profile</a>
            <a href="student_view_info.php" class="button"><img src="img/profile_logo.png" alt="Profile">Show Profile</a>
            <a href="student_view_timetable.php" class="button"><img src="img/view_tt.png" alt="View Timetable">View Timetable</a>
            <a href="student_attendance_view.php" class="button"><img src="img/roll-call.png" alt="Attendance">View Attendance</a>
        </div>
    </main>
</body>

</html>
