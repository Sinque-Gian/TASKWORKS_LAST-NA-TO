<?php
    session_start();
    include('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskWorks | Task</title>
    <!-- JQUERY file -->
    <script src="includes/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap file -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.js">

    <!-- CSS file -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body style="background-color: #5f6366;">
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
    <center>
        <h3 style="color: white;">Your Tasks</h3>
    </center>
    <table class="table" style="background-color: whitesmoke;">
        <tr>
            <th>S. No</th>
            <th>Task ID</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php 
            $query = "select * from tasks where sid = $_SESSION[sid]";
            $sno = 1;
            $query_run = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($query_run)){
                ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $row['tid']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><a class="btn btn-primary" href="update_status.php?id=<?php echo $row['tid']; ?>">Update</a></td>
                </tr>
                <?php
                $sno = $sno + 1;
                     }
                     ?>
                
           
    </table>
</body>
</html>