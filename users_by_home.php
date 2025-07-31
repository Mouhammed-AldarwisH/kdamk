<?php
header('Content-Type: application/json');

if (!isset($_POST['houseId'])) {
    echo json_encode(['status' => 'error', 'message' => 'لم يتم إرسال معرف البيت']);
    exit;
}

$houseId = $_POST['houseId'];
$url = 'https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/users?home_id=eq.' . urlencode($houseId);

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
    $users = [];
    if (!empty($data)) {
        foreach ($data as $user) {
            $users[] = [
                'id' => $user['id'],
                'name' => $user['name']
            ];
        }
    }
    echo json_encode(['status' => 'success', 'users' => $users]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'خطأ في الاتصال']);
}
?>
