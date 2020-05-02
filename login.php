<?php


require_once "init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    // $password = sha1($_POST["password"]);
    $password = $_POST["password"];

	$sql = "
        SELECT *
        FROM user
        WHERE username = '$username' AND password = '$password'
    ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows <= 0) {
    
        $output["status"] = "failed";
        $output["errorMessage"] = "Invalid username or password.";
    
    } else {
    
        $row = $result->fetch_assoc();
    
        $output["status"] = "success";

        $output["userId"] = $row["user_id"];
        
        $output["username"] = $row["username"];
        $output["password"] = $row["password"];
        $output["firstName"] = $row["first_name"];
        $output["lastName"] = $row["last_name"];
        $output["displayPicture"] = $row["display_picture"];
        $output["city"] = $row["city"];
        $output["province"] = $row["province"];
    
    }
    
    echo json_encode($output);
    $conn->close();

}


?>