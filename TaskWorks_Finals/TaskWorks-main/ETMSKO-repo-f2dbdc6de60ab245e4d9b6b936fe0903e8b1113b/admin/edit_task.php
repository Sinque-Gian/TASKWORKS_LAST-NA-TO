<?php 
include('../includes/connection.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

// Handle form submission to update the task
// Handle form submission to update the task
if (isset($_POST['edit_task'])) {
    $id = $_POST['id'];
    $user_id = $_POST['user_id']; // Use $user_id instead of $sid
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $update_query = "UPDATE tasks SET sid='$user_id', description='$description', start_date='$start_date', end_date='$end_date' WHERE tid='$id'";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        echo "<script>alert('Task updated successfully!'); window.location.href = 'manage_task.php';</script>";
    } else {
        echo "<script>alert('Failed to update task.'); window.location.href = 'edit_task.php?id=$id';</script>";
    }
}


// Check if ID is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tasks WHERE tid = $id";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
    } else {
        echo "<h3 style='color: white; text-align: center;'>No task found with ID $id</h3>";
        exit();
    }
} else {
    echo "<h3 style='color: white; text-align: center;'>No task ID specified</h3>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETMSKO | Edit task</title>

    <!-- JQUERY file -->
    <script src="../includes/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap file -->
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <script src="../bootstrap/bootstrap.min.js"></script>

    <!-- CSS file -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background-color: #5f6366;">
    <!-- Header  -->
    <section>
    <div class="row" id="header">
        <div class="col-md-12" >
            <div class="col-md-4" style="display: inline-block;">
                <h3 class="text-white">TaskWorks</h3>
            </div>                    
        </div>
    </div>
    </section>
    <div class="row">
        <div class="col-md-4 m-auto" style="color: white;">
            <h3 style="color: white;">Edit the task</h3><br>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $row['tid']; ?>">
                <div class="form-group">
                    <label for="">Select user:</label>
                    <select name="user_id" class="form-control" required>
                    <option value="">-Select-</option>  
                            <?php
                                $query1 = "SELECT sid, name FROM users";
                                $query_run1 = mysqli_query($connection, $query1);
                                if (mysqli_num_rows($query_run1)) {
                                    while ($row1 = mysqli_fetch_assoc($query_run1)) {
                                        ?>
                                        <option value="<?php echo $row1['sid']; ?>" <?php if ($row['sid'] == $row1['sid']) echo 'selected'; ?>><?php echo $row1["name"]; ?></option>
                                        <?php
                                    }
                                }                       
                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Description: </label>
                    <textarea name="description" class="form-control" rows="3" cols="50" required><?php echo $row['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Start date: </label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo $row['start_date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">End date: </label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo $row['end_date']; ?>" required>
                </div>
                <input type="submit" class="mt-4 btn btn-warning" name="edit_task" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
