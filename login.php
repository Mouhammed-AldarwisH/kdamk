<?php
header('Content-Type: application/json');

$valid_house = "test_house"; // اسم البيت للاختبار
$houseName = $_POST['houseName'] ?? '';

if ($houseName === $valid_house) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

// لم يعد هناك حاجة لهذا الملف بعد نقل التحقق إلى جافاسكريبت
?>
