<?php
session_start();
if (!$_SESSION['email']) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>JULIUS BERGER</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>
<style>
    .cl_white {
        color: rgb(255, 255, 255);
    }

    section {
        width: 100vw;
        height: 100vh;
        padding: 50px;
    }
</style>
<!-- Body STARTS from here -->

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Profile</a>
            </div>
            <div class="container">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">Home</a></li>
                    <a class="btn btn-danger active navbar-btn" href="./logout.php" target="_self"
                        role="button">Logout</a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Section Goes Here -->
    <section id="home" style="background: url(images/staffbg.jpg); background-size: 100% 100%;" class="cl_white text-center">
        <h1> Staff Attendance </h1>
		<p> Welcome
            <?php
            if (isset($_SESSION["username"])) {
                echo $_SESSION["username"];
            }
            ?>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="page-header">
                        <h4> Details </h4>
                    </div>
                    <form class="col-md-8 col-md-offset-2" role="form" action="" method="post">
                        <div class="form-group"> Employee Fullname:
                            <input class="form-control" type="text" id="employee" name="employee">
                        </div>
                        <div class="form-group"> Unique ID:
                            <input class="form-control" type="number" id="unique_id" name="unique_id">
                        </div>
                        <div class="form-group"> Position:
                            <input class="form-control" type="text" id="position" name="position">
                        </div>
                        <div class="form-group"> Date:
                            <input class="form-control" type="date" id="date" name="date">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success btn-block" name="submit" type="submit">
                        </div>
                    </form>
                    <!-- End of the first form -->
                </div>
                
        </div>
    </section>

    <footer class="navbar navbar-default navbar-fixed-button">
        <div class="container">
            <p class="text-center" style="padding: 12px">
                Copyright - Bamidele Victor 2024 
            </p>
        </div>
    </footer>
</body>

</html>
<?php
// Create a connection
include("connect-db.php");

if (isset($_POST['submit'])) {
    $employee= htmlspecialchars($_POST["employee"]);
    $unique_id = htmlspecialchars($_POST["unique_id"]);
    $position = htmlspecialchars($_POST["position"]);
    $date= htmlspecialchars($_POST["date"]);

    if ($employee == '' || $date == '') {
        $server = "Error: please enter a value";
    } else {
        $stmt = $pdo->prepare("INSERT INTO record (employee, unique_id, position, date) VALUES (?, ?, ?, ?)");

        try {
            $stmt->execute([$employee, $unique_id, $position, $date]);
            echo "<script>alert('record stored')</script>";
        } catch (PDOException $e) {
            echo "Error inserting data: " . $e->getMessage();
        }
    }
    // } else {
//     renderForm('', '', '');
// 
}
?>