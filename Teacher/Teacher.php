<?php
session_start();

$adminServer = "localhost";
$adminUsername = "root";
$adminPassword = "";
$adminDatabase = "admin";

$adminConnection = mysqli_connect($adminServer, $adminUsername, $adminPassword, $adminDatabase);

if (!$adminConnection) {
    die("Connection to the admin database failed due to" . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Teacher_Id = $_POST['username'];
    $enteredPassword = $_POST['password'];

    $stmt = $adminConnection->prepare("SELECT password FROM `teacher_idpass` WHERE `Teacher_Id` = ?");
    $stmt->bind_param("s", $Teacher_Id);

    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();

    if ($enteredPassword == $storedPassword) {
        $_SESSION['Teacher_Id'] = $Teacher_Id;
        header("Location: teacher_home.html");
        exit();
    } else {
        $_SESSION['invalid_login'] = true; // Set the session variable for invalid login
    }

    $stmt->close();
}

mysqli_close($adminConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            text-align: left;
            padding: 20px;
        }

        .login-header {
            color: rgb(85, 84, 84);
            padding: 15px;
            text-align: center;
        }

        form {
            padding: 20px;
            box-sizing: border-box;
            text-align: left;
        }

        input {
            width: calc(100% - 11px);
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
        }

        button {
            background-color: navy;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            z-index: 1000;
        }

        .popup button {
            margin-top: 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #e53935;
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="img/ICEMLogo.png" alt="ICEM Logo">
            <h2>Teacher</h2>
            <h3>Sign Into Your Account</h3>
        </div>
        <form action="Teacher.php" method="post" class="container">
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="name" placeholder="Enter your name" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="pwd" placeholder="Enter your password" required><br><br>
            <button class="btn" type="submit">Submit</button>
        </form>
        <h2><a href="../index.html">Dashboard</a></h2>  
    </div>

    <!-- Popup for invalid credentials -->
    <div class="popup" id="popup">
        <p>Invalid credentials. Please try again.</p>
        <button onclick="closePopup()">Close</button>
    </div>

    <script>
        // Check if the session variable 'invalid_login' is set and show the popup
        <?php
        if (isset($_SESSION['invalid_login']) && $_SESSION['invalid_login'] == true) {
            echo "document.getElementById('popup').style.display = 'block';";
            unset($_SESSION['invalid_login']); // Unset the session variable after displaying the popup
        }
        ?>

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>
