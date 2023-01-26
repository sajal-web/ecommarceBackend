<?php
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = array();
    $conn = mysqli_connect("localhost", "root", "", "ecomdb");
    if ($conn) {
        $sql = "select * from user where email  = '" . $email . "'  ";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            if ($email == $row['email'] && password_verify($password, $row['password'])) {
                try {
                    $apikey = bin2hex(random_bytes(23));
                } catch (Exception $e) {
                    $apikey = bin2hex(uniqid($email, true));
                }
                $sqlUpdate = "update users set apikey = '" . $apiKey . "' where email = '" . $email . "'";
                if (mysqli_query($conn, $sqlUpdate)) {
                    $result = array(
                        "status" => "success",
                        "message" => "login successful",
                        "name" => $row['name'],
                        "email" => $row['email'],
                        "apikey" => $row['apikey']
                    );
                } else
                    $result = array("status" => "faild", "message" => "login faild try again");
            }else
            $result = array("status" => "faild", "message" => "retry with currect email and password");
        }else
        $result = array("status" => "faild", "message" => "Database connection faild");
    }else
    $result = array("status" => "faild", "message" => "all field are required");
}
echo json_encode($result, JSON_PRETTY_PRINT);
?>