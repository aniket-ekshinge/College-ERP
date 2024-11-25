<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Teacher</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }

    .wrapper {
      max-width: 400px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .title {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .form {
      margin-bottom: 20px;
    }

    .inputfield {
      margin-bottom: 15px;
    }

    .inputfield label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .inputfield input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .btns {
      text-align: center;
    }

    .btns .btn {
      background-color: navy;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    #message {
      color: red;
      margin-top: 5px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="add_teacher.php" method="POST" enctype="multipart/form-data">
      <div class="title">My Profile</div>
      <div class="form">
        <div class="inputfield">
          <label>Teacher ID</label>
          <input type="text" class="input" id="Teacher_id" name="Teacher_id" placeholder="Enter Teacher ID" maxlength="30" title="Enter only alphabets" required>
        </div>
        <div class="inputfield">
          <label>Password </label>
          <input type="text" class="input" id="password" name="password" placeholder="Enter password name" maxlength="30" title="Enter only alphabets" required>
        </div>
        <p id="message"></p>
      </div>
      <div class="inputfield btns" id="btn">
        <button type="submit" value="Register" class="btn">Register</button>
      </div>
    </form>
  </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Teacher_id = $_POST['Teacher_id'];
    $password = $_POST['password'];


    $conn = new mysqli('localhost', 'root', '', 'admin');
    if ($conn->connect_error) {
        die('Connection Failed :' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO teacher_idpass (Teacher_id,password) VALUES (?, ?)");
        $stmt->bind_param("ss", $Teacher_id,$password);

        if ($stmt->execute()) {
            echo "Registration successful";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
