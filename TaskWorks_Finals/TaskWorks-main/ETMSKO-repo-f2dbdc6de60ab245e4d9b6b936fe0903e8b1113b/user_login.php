<?php
session_start();
    include('includes/connection.php');
    if(isset($_POST['userLogin'])){
        $query = "SELECT email,password,name,sid FROM users WHERE email = '$_POST[email]' AND password = '$_POST[password]'";

        $query_run = mysqli_query($connection, $query);

        if(mysqli_num_rows($query_run)){
            while($row = mysqli_fetch_assoc($query_run)){
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['sid'] = $row['sid'];
            }
            echo "<script type='text/javascript'>                    
                    window.location.href = 'user_dashboard.php';
                </script>";

        }else{
            echo "<script type='text/javascript'>
                    alert('Wrong Credentials!');
                    window.location.href = 'user_login.php';
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskWorks | User login page</title>

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
<body id="user_login">
<section>
    <h1 id="logintitle">TaskWorks</h1>
    <h5 id="loginsubhead">Where tasks works for you</h5>
</section>
<div class="row">
    <div class="col-md-3" id="login-home-page">
        <center><h3 style="margin-bottom: 20px;">Student login</h3></center>
        <hr>
        <form action="" method="post">
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
            <div class="form-group">
                <input type="submit" name="userLogin" value="Login" class="btn" style="background-color:#EDB5BF; font-weight: bold;" required>
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
</script>
</body>
</html>
