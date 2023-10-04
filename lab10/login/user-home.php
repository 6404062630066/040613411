<?php session_start();
include "./connect.php";
if (empty($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("location: login-form.php");
}
?>

<html>

<body>
    <table border="1">
        <tr>
            <th>ord_id</th>
            <th>username</th>
            <th>ord_date</th>
            <th>status</th>
        </tr>
        <?php $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = :username ");
        $stmt->bindParam(':username', $_SESSION['username']);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['ord_id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['ord_date'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
            echo "</br>";
        }

        ?>
    </table>

    <h1>สวัสดี <?= $_SESSION["fullname"] ?></h1>
    หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
</body>

</html>