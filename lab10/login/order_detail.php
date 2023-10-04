<?php
session_start();
include "./connect.php";

if (empty($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("location: login-form.php");
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // สร้างคำสั่ง SQL เพื่อดึงรายการ Order ของลูกค้าคนนี้
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
} else {
    // ถ้าไม่มีข้อมูล username ที่ส่งมา ให้กลับไปหน้าหลักหรือจัดการแบบอื่น
    header("location: index.php");
}

?>

<html>

<body>
    <h1>รายการ Order ของลูกค้า: <?= $username ?></h1>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <!-- เพิ่มคอลัมน์อื่นๆ ตามที่คุณต้องการแสดง -->
        </tr>
        <?php
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['ord_id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['ord_date'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            // เพิ่มคอลัมน์อื่นๆ ตามที่คุณต้องการแสดง
            echo "</tr>";
        }
        ?>
    </table>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <!-- เพิ่มคอลัมน์อื่นๆ ตามที่คุณต้องการแสดง -->
        </tr>
        <?php
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['ord_id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['ord_date'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            // เพิ่มคอลัมน์อื่นๆ ตามที่คุณต้องการแสดง
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>