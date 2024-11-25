
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $enteredPassword = $_POST['password'] ?? ''; 
        $enteredAdminId = $_POST['admin_id'] ?? '';

        if ($enteredPassword === "admin" && $enteredAdminId === "admin") {
            header("Location: admin_home_page.html");
            exit(); 
        } else {
            $errorMessage = "Invalid credentials. Please try again.";
        }
    }
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
            width: calc(100% - 16px);
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        button {
            background-color: navy;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
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
    <title>Admin Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="img/ICEMLogo.png" alt="ICEM Logo">
            <h2>Admin</h2>
            <h3>Sign Into Your Account</h3>
        </div>
        <?php if (isset($errorMessage)) : ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form action="#" method="post" class="container">
            <label for="admin_id">Username:</label><br>
            <input type="text" name="admin_id" id="admin_id" placeholder="Enter your name"><br><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" placeholder="Enter your password"><br><br>
            <button type="submit" class="btn">Submit</button> 
        </form>
        <h2><a href="../index.html">Dashboard</a></h2>  

    </div>
</body>
</html>
