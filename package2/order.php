<?php
include "./config/db_conn.php";
include "./config/orderClass.php";

$orders = order::getOrder($conn);
$order = new order();

if(isset($_POST["check_in"])){
    $order->id_order = $_POST["id"];
    $order->status = "check_in";
    $order->updateStatus($conn);
    header("Location: order.php");
}
if(isset($_POST["check_out"])){
    $order->id_order = $_POST["id"];
    $order->status = "check_out";
    $order->updateStatus($conn);
    header("Location: order.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/list.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>name</th>
            <th>check in</th>
            <th>check out</th>
            <th>email</th>
            <th>phone number</th>
            <th>status</th>
            <th>Action</th>
        </tr>
        <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo $order["nama_tamu"] ?></td>
                <td><?php echo $order["check_in"] ?></td>
                <td><?php echo $order["check_out"] ?></td>
                <td><?php echo $order["email"] ?></td>
                <td><?php echo $order["no_handphone"] ?></td>
                <td><?php echo $order["status"]?></td>
                <td><form action="order.php" method="post">
                    <input type="hidden" name="id" class="id" value="<?php echo $order["id_order"]; ?>">
                    <?php if($order["status"] === "booked"): ?>
                        <button type="submit" name="check_in">check in</button>

                        <?php elseif($order["status"] === "check_in"): ?>
                            <button type="submit" name="check_out">check out</button>

                            <?php elseif($order["status"] === "check_out"): ?>
                                <h3>check out</h3>
                            <?php endif; ?>
                </form></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>