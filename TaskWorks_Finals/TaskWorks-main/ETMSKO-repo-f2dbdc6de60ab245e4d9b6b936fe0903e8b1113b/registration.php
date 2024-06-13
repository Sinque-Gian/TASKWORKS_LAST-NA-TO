<?php
    include('includes/connection.php');
    if(isset($_POST['userRegistration'])){
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        // Check if email or mobile already exists
        $check_query = "SELECT * FROM users WHERE email='$email' OR mobile='$mobile'";
        $check_result = mysqli_query($connection, $check_query);

        if(mysqli_num_rows($check_result) > 0){
            echo "<script type='text/javascript'>
                    alert('Error! Email or Mobile number already exists!');
                    window.location.href = 'registration.php';
                </script>";
        } elseif(strlen($mobile) != 11) {
            echo "<script type='text/javascript'>
                    alert('Error! Mobile number must be exactly 11 digits!');
                    window.location.href = 'registration.php';
                </script>";
        } elseif ($_POST['password'] != $_POST['confirm_password']) {
            echo "<script type='text/javascript'>
                    alert('Error! Password and Confirm Password do not match!');
                    window.location.href = 'registration.php';
                </script>";
        } else {
            $query = "INSERT INTO users VALUES(null, '$_POST[name]', '$email', '$_POST[password]', '$mobile' )";
            $query_run = mysqli_query($connection, $query);

            if($query_run){
                echo "<script type='text/javascript'>
                        alert('User Registered Successfully!');
                        window.location.href = 'index.php';
                    </script>";
            }else{
                echo "<script type='text/javascript'>
                        alert('Error! Please try again!');
                        window.location.href = 'registration.php';
                    </script>";
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskWorks | Student Registration page</title>

    <!-- JQUERY file -->
    <script src="includes/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap file -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.js">

    <!-- CSS file -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</head>
<body id="registration">
    <section>
        <h1 id="logintitle">TaskWorks</h1>
        <h5 id="loginsubhead">Where tasks works for you</h5>
    </section>
    <div class="row">
        <div class="col-md-3" id="register-home-page">
            <center><h3 style="margin-bottom: 20px;">Student registration</h3></center>
            <hr>
            <form action="" method="post">
                <div class="form-group">
                    <input type="name" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <br>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <br>
                <div class="form-group position-relative">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y pe-3" onclick="togglePasswordVisibility('password')">
                        <i class="bi bi-eye" id="password-icon"></i>
                    </span>
                </div>
                <br>
                <div class="form-group position-relative">
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y pe-3" onclick="togglePasswordVisibility('confirm_password')">
                        <i class="bi bi-eye" id="confirm-password-icon"></i>
                    </span>
                </div>
                <br>
                <div class="form-group">
                    <input type="number" name="mobile" class="form-control" placeholder="Enter Mobile No." maxlength="11" id="mobile" required>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" name="userRegistration" value="Register" class="btn" style="margin-left:20px; background-color:#EDB5BF; font-weight: bold;" required>
                    <a href="./index.php" class="btn" style="margin-left:20px; background-color:#EDB5BF; font-weight: bold;">Go back</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = document.getElementById(fieldId + '-icon');
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                field.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }

        document.getElementById('confirm_password').addEventListener('input', function() {
            var password = document.getElementById('password').value;
            var confirmPassword = this.value;
            if (password !== confirmPassword) {
                this.style.borderColor = 'red';
            } else {
                this.style.borderColor = '';
            }
        });

        document.getElementById('mobile').addEventListener('input', function() {
            var mobileField = this;
            var mobileValue = mobileField.value;
            if (mobileValue.length > 11) {
                mobileField.value = mobileValue.slice(0, 11);
            }
        });
    </script>
</body>
</html>


