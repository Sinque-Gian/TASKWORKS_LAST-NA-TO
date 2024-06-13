<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskWorks | Teacher dashboard</title>

    <!-- JQUERY file -->
    <script src="../includes/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap file -->
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <script src="../bootstrap/bootstrap.min.js"></script>

    <!-- CSS file -->
    <link rel="stylesheet" href="../css/style.css">

    <style>
        #tasks {
            text-align: center;
            margin-top: 20px;
        }
        table {
            margin: auto;
            width: 50%;
            background-color: white;
        }
    </style>

    <script>
        $(document).ready(function(){
            $(".delete-btn").click(function(){
                var studentId = $(this).data("id");
                var row = $(this).closest("tr");

                $.ajax({
                    url: 'delete_student.php',
                    type: 'POST',
                    data: { id: studentId },
                    success: function(response) {
                        if(response == "success") {
                            row.remove();
                        } else {
                            console.error("Error response:", response);
                            alert("Error deleting student");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", status, error);
                        alert("An error occurred while trying to delete the student.");
                    }
                });
            });
        });
    </script>
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
                    <a href="admin_dashboard.php">Dashboard</a>
                    <a href="create_task.php">Create task</a>
                    <a href="manage_task.php">Manage task</a>
                    <a href="../index.php">Log out</a>
                </nav>
            </div>
        </div>
    </section>
    <!-- Header ends here -->
    <section id="dashbody">
        <h1 id="title">TaskWorks</h1>
        <h5 id="subhead">Student list</h5>

        <div id="tasks">
            <?php
            // PHP code to fetch tasks from the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "etmsko_db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to retrieve tasks
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<table class="table table-bordered">';
                echo '<thead><tr><th>Name</th><th>Email</th><th>Student ID</th><th>Mobile no.</th><th>Action</th></tr></thead>';
                echo '<tbody>';
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["name"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $row["sid"] . '</td>';
                    echo '<td>' . $row["mobile"] . '</td>';
                    echo '<td><button class="btn btn-danger delete-btn" data-id="' . $row["sid"] . '">Drop</button></td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "<h2>No Student found</h2>";
            }
            $conn->close();
            ?>
        </div>
    </section>
</body>
</html>
