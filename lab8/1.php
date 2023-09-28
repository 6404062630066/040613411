<?php include "db.php"; ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>

    <table border="1">
        <tr>
            <th>รหัสสินค้า</td>
            <th>ชื่อสินค้า</td>
            <th>รายละเอียด</td>
            <th>ราคา</td>
        </tr>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM product");
        $stmt->execute();

        while ($row = $stmt->fetch()) {
        ?>
            <tr>
                <td><?= $row["pid"] ?></td>
                <td><?= $row["pname"] ?></td>
                <td><?= $row["pdetail"] ?></td>
                <td><?= $row["price"] ?> </td>
            </tr>




        <?php } ?>
    </table>

</body>

</html>