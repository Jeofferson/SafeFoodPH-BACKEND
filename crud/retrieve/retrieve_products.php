<?php


require_once "../init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category = $_POST["category"];
    $filter = $_POST["filter"];

    $sql = "
        SELECT
            p.product_id,
            p.seller_id,
            u.first_name,
            u.last_name,
            u.display_picture AS user_display_picture,
            u.city,
            u.province,
            p.product_name,
            p.display_picture AS product_display_picture,
            p.category,
            p.price,
            p.quantity,
            p.description,
            p.payment_method
        FROM product p
        JOIN user u
            ON p.seller_id = u.user_id
        ORDER BY p.product_id DESC
    ";
    
    $result = $conn->query($sql);

    $output["products"] = array();

    while ($row = $result->fetch_assoc()) {

        array_push($output["products"], $row);

    }
    
    echo json_encode($output);
    $conn->close();

}


?>