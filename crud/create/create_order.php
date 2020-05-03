<?php


require_once "../init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $productId = $_POST["productId"];
    $buyerId = $_POST["buyerId"];
    $sellerId = $_POST["sellerId"];
    $quantity = $_POST["quantity"];
    $paymentMethod = $_POST["paymentMethod"];
    $additionalMessage = $_POST["additionalMessage"];
    $isConfirmed = 0;
    $isDelivered = 0;

    $sql = "
        INSERT INTO
        `order` (product_id, buyer_id, seller_id, quantity, payment_method, additional_message, is_confirmed, is_delivered)
        VALUES ('$productId', '$buyerId', '$sellerId', '$quantity', '$paymentMethod', '$additionalMessage', '$isConfirmed', '$isDelivered')
    ";

    if ($conn->query($sql) === FALSE) {

        $output["status"] = "failed";
        $output["errorMessage"] = "An error occurred.";

    } else {

        $lastInsertedId = $conn->insert_id;

        $output["status"] = "success";
        $output["lastInsertedId"] = $lastInsertedId;

    }
    
    echo json_encode($output);
    $conn->close();

}


?>