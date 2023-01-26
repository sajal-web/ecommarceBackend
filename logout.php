<?php
if (!empty($_POST['email']) && !empty($_POST['apikey'])) {
    $email = $_POST['email'];
    $apikey = $_POST['apikey'];
    $conn = mysqli_connect("localhost", "root", "", "ecomdb");
    if ($conn) {
        $sql = "select * from users where email = '" . $email . "' and apikey = '" . $apikey . "'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $sqlUpdate = "update users set apikey = '' where email = '" . $email . "'";
            if (mysqli_query($conn, $sqlUpdate)) {
                echo "success";
            } else
                echo "logout failed";
        } else
            echo "unauthorized to access";
    } else
        echo "Database connection failed";
} else
    echo "all fields are required";
?>