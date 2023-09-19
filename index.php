<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elvira Vargas Bermúdez</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1>Web application - Elvira Vargas Bermúdez</h1>
        <hr>
        <h2>Users</h2>
        <a class="btn btn-primary" href="/mysql-php/create.php" role="button">New User</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Userid</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "mytest"; 

                //Connection
                $connection = new mysqli($servername, $username, $password, $database);

                //Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                //Reads all row from database table
                $sql = "SELECT * FROM users";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                //reads data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>$row[userid]</td>
                            <td>$row[username]</td>
                            <td>$row[email]</td>
                            <td>$row[password]</td>
                            <td>
                                <a class='btn btn-warning btn-sm' href='/mysql-php/edit.php?userid=$row[userid]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/mysql-php/delete.php?userid=$row[userid]'>Delete</a>
                            </td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>