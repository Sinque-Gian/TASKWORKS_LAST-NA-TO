<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskWorks | User dashboard</title>

    <!-- JQUERY file -->
    <script src="includes/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap file -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.js">

    <!-- CSS file -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body id="user_dashboard">
    <!-- Header  -->
    <section>
    <div class="row" id="header">
        <div class="col-md-12" >
            <div class="col-md-4" style="display: inline-block;">
                <h3 class="text-white">TaskWorks</h3>
                </div>
                <div class="col-md-6" style="display: inline-block;text-align: right;">
                    <b>Email: </b> <?php echo $_SESSION['email']; ?>
                    <span style="margin-left: 25px;"><b>Name: </b><?php echo $_SESSION['name']; ?></span>
                </div>            
        </div>
    </div>
    </section>
    <section id="header2">
        <div class="container">
            <div class="row justify-content-between">
                <nav class="col-12">
                    <a href="user_dashboard.php">Dashboard</a>
                    <a href="task.php">Task</a>
                    <a href="index.php">Log out</a>
                </nav>
            </div>
        </div>
    </section>
    <!-- Header ends here -->
    <section id="dashbody">
        <h1 id="title">TaskWorks</h1>
        <h5 id="subhead">Where tasks works for you</h5>
    </section>
    </div>
</body>
</html>
