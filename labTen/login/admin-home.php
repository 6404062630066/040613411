<?php session_start();
include "./connect.php";

if (empty($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("location: login-form.php");
}
$stmt_items = $pdo->prepare("SELECT p.pname, i.quantity 
                             FROM product p 
                             LEFT JOIN (
                                SELECT pid, SUM(quantity) AS quantity 
                                FROM item 
                                GROUP BY pid
                             ) i ON p.pid = i.pid");
$stmt_items->execute();
$items_left = [];

while ($row = $stmt_items->fetch()) {
    $items_left[$row["pname"]] = $row["quantity"];
}
?>

<html>

<body>
    <table border="1">
        <tr>
            <th>username</th>
            <th>total_orders</th>
            <th>details</th>
        </tr>
        <?php $stmt = $pdo->prepare("SELECT username, COUNT(ord_id) as total_orders FROM orders GROUP BY username");
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['total_orders'] . "</td>";
            echo "<td><a href='order_detail.php?username=" . $row['username'] . "'>Details</a></td>";
            echo "</tr>";
            echo "</br>";
        }

        ?>
    </table>
    <h2>Items Left:</h2>
    <table border="1">
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($items_left as $item_name => $quantity) { ?>
            <tr>
                <td><?= $item_name ?></td>
                <td><?= $quantity ?></td>
            </tr>
        <?php } ?>
    </table>
    <h1>สวัสดี <?= $_SESSION["fullname"] ?></h1>
    หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
</body>

</html>