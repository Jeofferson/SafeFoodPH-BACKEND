<?php


require_once "../init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userId = $_POST["userId"];

	$sql = "
        SELECT *
        FROM user
        WHERE user_id = '$userId'
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