<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // สร้างการเชื่อมต่อฐานข้อมูล
    $conn = new mysqli('db', 'admin', '1234', 'sample_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ใช้ Prepared Statement เพื่อลบข้อมูล
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // ตรวจสอบผลการลบ
    if ($stmt->affected_rows > 0) {
        echo "ลบสินค้าสำเร็จ!";
    } else {
        echo "ไม่พบสินค้าที่ต้องการลบ!";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>