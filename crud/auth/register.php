<?php


require_once "../init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    
    $sql = "
        SELECT COUNT(*)
        FROM user
        WHERE username = '$username'
    ";
    
    $result = $conn->query($sql);
    
    if ($result->fetch_array()[0] > 0) {
    
        $output["status"] = "failed";
        $output["errorMessage"] = "Username already exists.";

    } else {

        $sql = "
            INSERT INTO
            user (username, password, first_name, last_name, display_picture, city, province)
            VALUES ('$username', '$password', '$firstName', '$lastName', '', '$city', '$province')
        ";

        if ($conn->query($sql) === FALSE) {
    
            $output["status"] = "failed";
            $output["errorMessage"] = "An error occurred.";

        } else {

            $lastInsertedId = $conn->insert_id;

            $output["status"] = "success";
            $output["lastInsertedId"] = $lastInsertedId;

        }

    }
    
    echo json_encode($output);
    $conn->close();

}


?>