<?php 
    include('config.php');

    if (isset($_POST['register'])) {
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $password = md5($_POST['password']);
        $check_email = $_POST['email'];

        $sql = "SELECT * FROM users WHERE email = '$check_email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>alert('this email is already in use please use another one'); document.location.href='../register.html';</script>";
        }  else {

            $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, dob, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $dob, $gender, $password);
            $var = $stmt->execute();

            if ($var === TRUE) {
                echo '<script>alert("successfully created your account"); document.location.href="../register.html";</script>';
            } else {
                echo 'something went wrong '. $conn->error;
                echo 'something went wrong '. $stmt->error;
            }
        }

    }

    $conn-close();
    $stmt->close();
    
?>