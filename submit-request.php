<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cast numeric values to integer for type safety
    $sender_id   = (int)$_POST['sender_id'];
    $receiver_id = (int)$_POST['receiver_id'];
    $item_ids    = $_POST['item_ids']; // remains a string
    $location_id = (int)$_POST['location_id'];
    $home_id     = (int)$_POST['home_id'];

    // Build the data array for insertion
    $data = [
        "sender_id"   => $sender_id,
        "receiver_id" => $receiver_id,
        "item_ids"    => $item_ids,
        "location_id" => $location_id,
        "home_id"     => $home_id
    ];

    // Supabase endpoint URL (replace YOUR_SUPABASE_REF with your project reference)
    $url = "https://akvyhsmobalbqfcjupdq.supabase.co/rest/v1/requests";

    // Initialize cURL for Supabase API call
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFrdnloc21vYmFsYnFmY2p1cGRxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTE4OTc4MzksImV4cCI6MjA2NzQ3MzgzOX0.aYKPcM2sPZLsVmQLOvsI454RSVlIzNMK24sv_QHHErQ",                     // Replace with your Supabase API key
        "Authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFrdnloc21vYmFsYnFmY2p1cGRxIiwicm9zZSI6ImFub24iLCJpYXQiOjE3NTE4OTc4MzksImV4cCI6MjA2NzQ3MzgzOX0.aYKPcM2sPZLsVmQLOvsI454RSVlIzNMK24sv_QHHErQ",       // Replace with your Supabase API key
        "Content-Type: application/json",
        "Prefer: return=representation"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    // Supabase expects an array of rows for insertion
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([$data]));

    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        $decoded = json_decode($response, true);
        if (isset($decoded['error'])) {
            echo "Error: " . $decoded['error']['message'];
        } else {
            echo "Request submitted successfully.";
        }
    }
    curl_close($ch);
} else {
    echo "Invalid request method.";
}
?>