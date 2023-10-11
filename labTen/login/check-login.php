<?php
include "connect.php";

session_start();

$stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->execute();
$row = $stmt->fetch();

// หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
if (!empty($row)) {
  $_SESSION["fullname"] = $row["name"];
  $_SESSION["role"] = $row["role"];
  $_SESSION["username"] = $row["username"];
  if ($_SESSION["role"] === 'user') {
    header("location: user-home.php");
  } else if ($_SESSION["role"] === 'admin') {
    header("location: admin-home.php");
  }
  echo "เข้าสู่ระบบสำเร็จ<br>";
  echo "<a href='user-home.php'>ไปยังหน้าหลักของผู้ใช้</a>";

  // กรณี username และ password ไม่ตรงกัน
} else {
  echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
  echo "<a href='login-form.php'>เข้าสู่ระบบอีกครัง</a>";
}
