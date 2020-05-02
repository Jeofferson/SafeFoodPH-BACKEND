<?php


require_once "init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $address = $_POST["address"];
    
    $sql = "SELECT * FROM user WHERE username = '$username'";
    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
    
        $output["status"] = "failed";
        $output["errorMessage"] = "Username already exists.";


    } else {

        $sql = "INSERT INTO user (username, password, first_name, last_name, display_picture, address) VALUES ('$username', '$password', '$firstName', '$lastName', '', '$address')";

        if (!mysqli_query($conn, $sql)) {
    
            $output["status"] = "failed";
            $output["errorMessage"] = "An error occurred.";

        } else {

            $lastInsertedId = mysqli_insert_id($conn);

            $output["status"] = "success";
            $output["lastInsertedId"] = $lastInsertedId;


        }

    }
    
    echo json_encode($output);
    mysqli_close($conn);

}


?>