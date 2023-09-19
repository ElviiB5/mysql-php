<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mytest";

    //Connection
    $connection = new mysqli($servername, $username, $password, $database);

    $userid = "";
    $username = "";
    $email = "";
    $password = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // GET method: Show the user data
        if (!isset($_GET["userid"])) {
            header("location: /mysql-php/index.php");
            exit;
        }

        $userid = $_GET["userid"];

        $sql = "SELECT * FROM users WHERE userid=$userid";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location /mysql-php/index.php");
            exit;
        }

        $username = $row["username"];
        $email = $row["email"];
        $password = $row["password"];
    } else {
        // POST method: Update user data

        $userid = $_GET["userid"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        do {
            if ( empty($userid) || empty($username) || empty($email) || empty($password) ) {
                $errorMessage = "All fields are required";
                break;
            }

            $sql = "UPDATE users " . 
                   "SET username = '$username', email = '$email', password = '$password' " . 
                   "WHERE userid = $userid";
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            $successMessage = "User updated successfully";

            header("location: /mysql-php/index.php");
            exit;
        } while (false);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elvira Vargas Bermúdez</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New User</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-warning alert-dissmissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" value="<?php echo $userid; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                </div>
            </div>
            
            <?php
            if (!empty($successMessage)) {
                echo "
                    <div class='row mb-3'>
                        <div class='alert alert-success alert-dissmissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary" href="/mysql-php/index.php">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>