<?php
$keyword = $_GET["keyword"];

try {
    $dbh = new PDO('mysql:host=localhost;dbname=blueshop', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM member WHERE username LIKE :keyword";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
    $stmt->execute();
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>
<table border="1">
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><img src="img/<?php echo $row["username"] ?>.jpg" width="100"></td>

            <td><a href="productDetail.php?pid=<?php echo $row["username"] ?>"><?php echo $row["name"] ?></a></td>

            <td><?php echo $row["address"] ?></td>
            <td><?php echo $row["mobile"] ?> </td>
            <td><?php echo $row["email"] ?> </td>
        </tr>
    <?php endwhile; ?>