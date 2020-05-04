<?php


require_once "../init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userId = $_POST["userId"];
    $querier = $_POST["querier"]

    $sql = "
        SELECT
            o.order_id,
            b.user_id AS buyer_id,
            b.display_picture AS buyer_display_picture,
            b.first_name AS buyer_first_name,
            b.last_name AS buyer_last_name,
            p.product_id,
            p.display_picture AS product_display_picture,
            p.product_name,
            p.price,
            o.quantity,
            o.payment_method,
            o.additional_message
        FROM order o
        JOIN user b
            ON o.buyer_id = b.user_id
        WHERE o.buyer_id = '$userId'
        ORDER BY o.order_id DESC
    ";
    
    $result = $conn->query($sql);

    $output["orders"] = array();

    while ($row = $result->fetch_assoc()) {

        array_push($output["orders"], $row);

    }
    
    echo json_encode($output);
    $conn->close();

}


?>