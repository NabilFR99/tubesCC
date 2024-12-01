<?php

$noteTitle = $_POST['note-title'];
$noteContent = $_POST['note-content'];
$noteDate = $_POST['note-date'];
$noteCategory = $_POST['list'];

// Format tanggal jika perlu
$noteDate = date('Y-m-d', strtotime($noteDate));

$curl = curl_init('https://teknik-2484.capsulecrm.com/api/v2/parties');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer Wc4/15DxiGnc4+1G/xEbeqtTtOC0dSt9ds7wMrqytvCv6dc2BwzFw1hg7USxvF6D',
    'Content-Type: application/json'
]);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
    'party' => [
        'type' => 'organisation',  // Tipe: organisation/person
        'name' => $noteTitle,
        'about' => $noteContent,
        'fields' => [
            [
                'definition' => ['id' => 873526], // Field ID untuk tanggal
                'value' => $noteDate,
            ],
            [
                'definition' => ['id' => 873527], // Field ID untuk status
                'value' => in_array($noteCategory, ['Tugas', 'Ujian', 'Presentasi']) ? $noteCategory : 'Tugas',
            ],
        ],
    ],
]));

$response = curl_exec($curl);
curl_close($curl);

echo 'Response from CRM: ' . $response;
?>
