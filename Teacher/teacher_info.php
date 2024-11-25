<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .wrapper {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .title {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }
    .inputfield {
      margin-bottom: 15px;
    }
    .inputfield label {
      display: block;
      margin-bottom: 5px;
    }
    .inputfield input[type="text"],
    .inputfield input[type="email"],
    .inputfield input[type="date"],
    .inputfield input[type="file"],
    .inputfield textarea {
      width: calc(100% - 10px);
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }
    .inputfield textarea {
      resize: vertical;
    }
    .inputfield input[type="radio"] {
      margin-right: 5px;
    }
    .btns {
      text-align: center;
    }
    .btns .btn {
      padding: 10px 20px;
      background-color: navy;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .btns .btn:hover {
      background-color: #334;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="teacher_info.php" method="POST" enctype="multipart/form-data">
      <div class="title">My Profile</div>
      <div class="form">
        <div class="inputfield">
          <label>Upload Photo</label>
          <input type="file" name="photo" accept=".jpeg, .jpg, .png" id="myfile" placeholder="Upload your photo" rows="7" required />
        </div>
        <div class="inputfield">
          <label for="first_name">First Name</label>
          <input type="text" class="input" id="first_name" name="teacher_first_name" placeholder="Enter first name" maxlength="30" title="Enter only alphabets" required>
        </div>
        <div class="inputfield">
          <label for="middle_name">Middle Name</label>
          <input type="text" class="input" id="middle_name" name="teacher_middle_name" placeholder="Enter middle name" maxlength="30" title="Enter only alphabets" required>
        </div>
        <div class="inputfield">
          <label for="last_name">Last Name</label>
          <input type="text" class="input" id="last_name" name="teacher_last_name" placeholder="Enter last name" maxlength="30" title="Enter only alphabets" required>
        </div>
        <div class="inputfield" id="gender">
          <label>Gender</label><br>
          <input type="radio" name="gender" id="male" value="Male" required>
          <label for="male">Male</label>
          <input type="radio" name="gender" id="female" value="Female" required>
          <label for="female">Female</label>
          <input type="radio" name="gender" id="other" value="Other" required>
          <label for="other">Other</label>
        </div>
        <div class="inputfield">
          <label for="">Job Title</label>
          <input type="text" class="input" name="job_title" placeholder="Enter your job title" maxlength="10000" 
            required placeholder="Enter your job title" title="Enter your job title">
        </div>

        <div class="inputfield">
            <label for="">Blood group</label>
            <input type="text" class="input" name="blood_group" placeholder="Enter your blood group" maxlength="5" 
              required placeholder="Enter your blood group" title="Enter String and characters">
          </div>

        <div class="inputfield">
          <label for="">Date of Birth</label>
          <input type="date" class="input" name="dob" required>
        </div>

        <div class="inputfield">
          <label>Email Address</label>
          <input type="email" class="input" name="email" placeholder="Enter your email"
             required>
        </div>

        <div class="inputfield">
            <label for="">Teacher ID</label>
            <input type="text" class="input" name="teacher_id" placeholder="Enter your Teacher ID" maxlength="10000" 
              required placeholder="Enter your Teacher id" title="Enter numbers only">
          </div>

          <div class="inputfield">
            <label for="">Joining Date</label>
            <input type="date" class="input" name="joining_date" required>
          </div>

        <p id="message"></p>

        <div class="inputfield">
          <label for="">Phone Number</label>
          <div class="custom-select" name="mobile_no" id="phone-codes">
            <select id="phone-code">
              <option value="+91">+91</option>
            </select>
          </div>

          <input type="tel" class="input" name="mobile_no" maxlength="10" id="phone-number"
            placeholder="Enter your phone number"  title="Please enter valid phone number">
        </div>

        <div class="inputfield">
            <label for="">Enter your employee category id </label>
            <input type="text" class="input" name="employee_category_id" placeholder="Enter your category id" maxlength="10000" 
              required placeholder="Enter category id" title="Enter category id">
          </div>

        <div class="inputfield">
          <label>Address</label>
          <textarea class="textarea" name="address"  cols="30" rows="5" placeholder="Enter your address"
             maxlength="100" required></textarea>
        </div>

        <div class="inputfield terms">
          <label class="check">
            <input type="checkbox" name="check" value="Declared" required>
            <span class="checkmark"></span>
          </label>
          <p>I hereby declare that the above information provided is true and correct.</p>
        </div>

        <div class="inputfield" required>
          <div data-netlify-recaptcha="true"></div>
        </div>
      
        <div class="btns">
          <button type="submit" class="btn">Register</button>
          <button type="reset" class="btn">Reset</button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $photo = $_FILES['photo']['name'];
  $temp_name = $_FILES['photo']['tmp_name']; // Temporary file path

  // Set the target directory and file path for the uploaded photo
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($photo);

  // Move the uploaded file to the target directory
  if (move_uploaded_file($temp_name, $target_file)) {
      echo "The file " . htmlspecialchars(basename($photo)) . " has been uploaded successfully.";
  } else {
      echo "Sorry, there was an error uploading your file.";
      exit; // Stop further processing if the upload fails
  }
      $teacher_first_name = $_POST['teacher_first_name'];
      $teacher_middle_name = $_POST['teacher_middle_name'];
      $teacher_last_name = $_POST['teacher_last_name'];
      $gender = $_POST['gender'];
      $job_title = $_POST['job_title'];
      $blood_group = $_POST['blood_group'];
      $dob = $_POST['dob'];
      $email = $_POST['email'];
      $teacher_id = $_POST['teacher_id'];
      $joining_date = $_POST['joining_date'];
      $employee_category_id = $_POST['employee_category_id'];
      $mobile_no = $_POST['mobile_no'];
      $address = $_POST['address'];

      // Database connection
      $conn = new mysqli('localhost', 'root', '', 'teacher');
      if ($conn->connect_error) {
          die('Connection Failed :' . $conn->connect_error);
      } else {
          // Check if teacher with the same teacher_id already exists
          $check_sql = "SELECT * FROM teacher_info WHERE teacher_id = ?";
          $stmt_check = $conn->prepare($check_sql);
          $stmt_check->bind_param("s", $teacher_id);
          $stmt_check->execute();
          $result = $stmt_check->get_result();

          if ($result->num_rows > 0) {
              // If teacher already exists, show a message
              echo "This teacher has already filled out the form.";
          } else {
              // Proceed with form submission if teacher does not exist
              $stmt = $conn->prepare("INSERT INTO teacher_info (photo, teacher_first_name, teacher_middle_name, teacher_last_name, gender, job_title, blood_group, dob, email, teacher_id, joining_date, employee_category_id, mobile_no, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              $stmt->bind_param("ssssssssssssss", $target_file, $teacher_first_name, $teacher_middle_name, $teacher_last_name, $gender, $job_title, $blood_group, $dob, $email, $teacher_id, $joining_date, $employee_category_id, $mobile_no, $address);

              if ($stmt->execute()) {
                  echo "Registration successful";
              } else {
                  echo "Error: " . $conn->error;
              }

              $stmt->close();
          }

          $stmt_check->close();
          $conn->close();
      }
  } else {
      echo "Sorry, there was an error uploading your file.";
  }

?>