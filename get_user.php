<?php
header('Content-Type: application/json');

if (!isset($_POST['userId'])) {
    echo json_encode(['status' => 'error', 'message' => 'لم يتم إرسال معرف المستخدم']);
    exit;
}

$userId = $_POST['userId'];
$url = 'https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/users?id=eq.' . urlencode($userId);

$apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFrdnloc21vYmFsYnFmY2p1cGRxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTE4OTc4MzksImV4cCI6MjA2NzQ3MzgzOX0.aYKPcM2sPZLsVmQLOvsI454RSVlIzNMK24sv_QHHErQ';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'apikey: ' . $apiKey,
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    $data = json_decode($response, true);
    if (!empty($data)) {
        $user = [
            'id' => $data[0]['id'],
            'name' => $data[0]['name'],
            'role' => $data[0]['role']
        ];
        echo json_encode(['status' => 'success', 'user' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'المستخدم غير موجود']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'خطأ في الاتصال']);
}
?>
