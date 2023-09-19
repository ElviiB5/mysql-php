<?php 
    if ( isset($_GET["userid"]) ) {
        $userid = $_GET["userid"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mytest";
    
        //Connection
        $connection = new mysqli($servername, $username, $password, $database);
    
        $sql = "DELETE FROM users WHERE userid=$userid";
        $connection->query($sql);
    }

    header("location: /mysql-php/index.php");
    exit;
?>