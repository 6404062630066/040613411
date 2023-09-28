<?php
include "db.php";
?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <div style="display:flex  ">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM member");
        $stmt->execute();
        $i = 3;
        while ($row = $stmt->fetch()) {
        ?>
            <div style="padding: 15px; text-align: center">
                <img src='mem/<?= $i ?>.jpg' width='100'><br>
                <?= $row["name"] ?><br>
                <?= $row["email"] ?><br>
                <?= $row["address"] ?><br>
                <br>
                <hr>
                <?php $i++; ?>
            </div>

        <?php } ?>

    </div>
</body>

</html>