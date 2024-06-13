<?php 
include('includes/connection.php');

// Handle form submission to update the task status
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $status = $_POST['status']; // Correctly retrieve the status

    $update_query = "UPDATE tasks SET status='$status' WHERE tid='$id'";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        echo "<script>alert('Task status updated successfully!'); window.location.href = 'task.php?id=$id';</script>";
    } else {
        echo "<script>alert('Failed to update task status.'); window.location.href = 'update_status.php?id=$id';</script>";
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
    <title>ETMSKO | Update task</title>

    <!-- JQUERY file -->
    <script src="includes/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap file -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>

    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">
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
            <h3 style="color: white;">Update the task</h3><br>
            <form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $row['tid']; ?>">
    <div class="form-group">
        <label for="status">Select status:</label>
        <select name="status" id="status" class="form-control" required>
            <option value="">-Select-</option>
            <option value="In-Progress" <?php if ($row['status'] == 'In-Progress') echo 'selected'; ?>>In-Progress</option>
            <option value="Complete" <?php if ($row['status'] == 'Complete') echo 'selected'; ?>>Complete</option>
        </select>
    </div>
    
    <input type="submit" class="mt-4 btn btn-warning" name="update" value="Update">
    
</form>

        </div>
    </div>
</body>
</html>
