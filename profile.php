<?php
if (!empty($_POST['email']) && !empty($_POST['apikey'])) {
    $email = $_POST['email'];
    $apikey = $_POST['apikey'];
    $result = array();
    $conn = mysqli_connect("localhost", "root", "", "ecomdb");
    if ($conn) {
        $sql = "select * from users where email = '" . $email . "' and apikey = '" . $apikey . "'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $result = array(
                "status" => "success",
                "message" => "data fetched successfully",
                "name" => $row['name'],
                "email" => $row['email'],
                "apikey" => $row['apikey'],
                "mobile" => $row['mobile']
            );
        }
        $result = array("status" => "faild", "message" => "Unauthorized access");
    } else
        $result = array("status" => "faild", "message" => "Database connection faild");
} else
    $result = array("status" => "faild", "message" => "all field are required");
echo json_encode($result, JSON_PRETTY_PRINT);
?>