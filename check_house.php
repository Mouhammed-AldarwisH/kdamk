<?php
// تحديد نوع البيانات المرسلة للعميل (JSON)
header('Content-Type: application/json');

// التحقق من وجود اسم البيت في الطلب
if (!isset($_POST['houseName'])) {
    echo json_encode(['status' => 'error', 'message' => 'لم يتم إدخال اسم البيت']);
    exit;
}

// الحصول على اسم البيت من الطلب
$houseName = $_POST['houseName'];
$houseName = trim($houseName); // إزالة المسافات من البداية والنهاية

// إعداد رابط الاستعلام من قاعدة البيانات
$url = 'https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/homes?name=eq.' . urlencode($houseName);

// مفتاح API للوصول إلى قاعدة البيانات
$apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFrdnloc21vYmFsYnFmY2p1cGRxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTE4OTc4MzksImV4cCI6MjA2NzQ3MzgzOX0.aYKPcM2sPZLsVmQLOvsI454RSVlIzNMK24sv_QHHErQ';

// بدء الاتصال باستخدام cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'apikey: ' . $apiKey,
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

// تنفيذ الطلب واستقبال الرد
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// التحقق من نجاح الاتصال
if ($httpCode === 200) {
    // تحويل الرد من JSON إلى مصفوفة
    $data = json_decode($response, true);

    // إذا تم العثور على بيانات للبيت
    if (!empty($data)) {
        // استخراج معرف البيت من أول عنصر
        $houseId = $data[0]['id'] ?? null;

        // إرسال رد نجاح مع معرف البيت
        echo json_encode([
            'status' => 'success',
            'houseId' => $houseId,
            'message' => 'البيت موجود!'
        ]);
    } else {
        // لم يتم العثور على البيت
        echo json_encode(['status' => 'error', 'message' => 'البيت غير موجود']);
    }
} else {
    // فشل الاتصال بقاعدة البيانات
    echo json_encode(['status' => 'error', 'message' => 'حدث خطأ في الاتصال']);
}
?>
