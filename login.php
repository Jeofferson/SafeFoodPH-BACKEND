<?php


require_once "init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    // $password = sha1($_POST["password"]);
    $password = $_POST["password"];

	$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) <= 0) {
    
        $output["status"] = "failed";
    
    } else {
    
        $row = mysqli_fetch_assoc($result);
    
        $output["status"] = "success";

        $output["userId"] = $row["user_id"];
        
        $output["username"] = $row["username"];
        $output["password"] = $row["password"];
        $output["firstName"] = $row["first_name"];
        $output["lastName"] = $row["last_name"];
        $output["displayPicture"] = $row["display_picture"];
        $output["address"] = $row["address"];
        $output["isLoggedIn"] = $row["is_logged_in"];
    
    }
    
    echo json_encode($output);
    mysqli_close($conn);

}


?>