<?php
include('../includes/connection.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}




if (isset($_POST['create_task'])) {
    $sid = $_POST['sid'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Debug: Print the values being inserted
    echo "User ID (SID): $sid, Description: $description, Start Date: $start_date, End Date: $end_date<br>";

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("INSERT INTO tasks (sid, description, start_date, end_date, status) VALUES (?, ?, ?, ?, 'Not started')");
    $stmt->bind_param("isss", $sid, $description, $start_date, $end_date);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>            
                alert('Task created successfully!');        
                window.location.href = 'admin_dashboard.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>            
                alert('Error. Please try again!');        
                window.location.href = 'admin_dashboard.php';
              </script>";
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskWorks | User dashboard</title>

    <!-- JQUERY file -->
    <script src="../includes/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap file -->
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.js">

    <!-- CSS file -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body id="user_dashboard">
    <!-- Header  -->
    <section>
        <div class="row" id="header">
            <div class="col-md-12">
                <div class="col-md-4" style="display: inline-block;">
                    <h3 class="text-white">TaskWorks</h3>
                </div>
                <div class="col-md-6" style="display: inline-block; text-align: right;">
                    <b>Email: </b> <?php echo $_SESSION['admin_email']; ?>
                    <span style="margin-left: 25px;"><b>Name: </b><?php echo $_SESSION['admin_name']; ?></span>
                </div>
            </div>
        </div>
    </section>
    <section id="header2">
        <div class="container">
            <div class="row justify-content-between">
                <nav class="col-12">
                    <a href="../admin/admin_dashboard.php">Dashboard</a>
                    <a href="create_task.php">Create Task</a>
                    <a href="manage_task.php">Manage task</a>
                    <a href="../index.php">Log out</a>
                </nav>
            </div>
        </div>
    </section>
    <!-- Header ends here -->
    <section id="dashbody">
        <h1 id="title">Create Task</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Select User</label>
                        <select name="sid" id="sid" class="form-control" required>
                            <option value="">-Select-</option>
                            <?php
                                $query = "SELECT sid, name FROM users";
                                $query_run = mysqli_query($connection, $query);
                                if (mysqli_num_rows($query_run)) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                                    <option value="<?php echo $row['sid']; ?>"><?php echo $row["name"]; ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Description: </label>
                        <textarea name="description" id="description" class="form-control" rows="3" cols="50" placeholder="Mention the task" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Start date: </label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">End date: </label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <input type="submit" class="mt-4 btn btn-warning" name="create_task" value="Create">
                </form>
            </div>
        </div>
    </section>
</body>
</html>

